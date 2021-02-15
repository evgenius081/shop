<?php

namespace core\Controller;

class Shop extends \core\Controller{

    public function index(){
        $shop = new \core\Models\Shop();
        $products = $shop->getSomeProducts(12);
        $chosenIDs = $this->getChosenProductsIDs();
        $cartIDs = $this->getCartProductsIDs();
        $text = $this->view('parts/prod', ['0' => $products, 'chosen_IDs' => $chosenIDs, 'cart_IDs' => $cartIDs], false);
        $this->view('shop', ['products' => $text]);
    }

    public function product($params){
        $shop = new \core\Models\Shop();
        $product = $shop->getProductByName($params[0]);
        $chosenIDs = $this->getChosenProductsIDs();
        $cartIDs = $this->getCartProductsIDs();
        if(isset($product)){
            $this->view('product', ['product' => $product, 'chosen_IDs' => $chosenIDs, 'cart_IDs' => $cartIDs]);
        }else{
            header('Location: /404');
        }
    }
    
    public function getChosenProductsIDs(){
        if(isset($_COOKIE['chosen'])){
            return json_decode($_COOKIE['chosen']);
        }
    }

    public function getCartProductsIDs(){
        if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){
            return json_decode($_SESSION['IDs']);
        }
    }

    public function ajaxFilters(){
        $shop = new \core\Models\Shop();
        $columns = [];
        $values = [];
        $arr = get_object_vars(json_decode($_GET['data']));
        foreach($arr as $key => $value){
            $key_changed = str_replace('-', '_', $key);
            array_push($columns, $key_changed);
            $ar = get_object_vars($value);
            if($key_changed != "price"){
                foreach($ar as $k => $val){
                    $values[$key_changed][] = str_replace('_', ' ', $k);
                }
            }else{
                if($ar['min-price']*1 < $ar['max-price'] * 1) {
                    $values['price'] = [$ar['min-price'], $ar['max-price']];
                }else{
                    $values['price'] = [$ar['max-price'], $ar['min-price']];
                }
                if($ar['discount'] == 'on'){
                    $values['price'][] = 'discount';
                }
            }
        }
        $products = $shop->getProductsByFilters($columns, $values);
        $chosenIDs = $this->getChosenProductsIDs();
        $cartIDs = $this->getCartProductsIDs();
        echo $this->view('parts/prod', ['0' => $products, 'chosen_IDs' => $chosenIDs, 'cart_IDs' => $cartIDs], false);
    }

    public function ajaxAddToChosen(){
        if(is_string($_GET['data'])){
            $cookie = [];
            if(isset($_COOKIE['chosen'])){
                $cookie = json_decode($_COOKIE['chosen']);
                if(!in_array($_GET['data'], $cookie)){
                    $cookie[] = $_GET['data'];
                    setcookie('chosen', json_encode($cookie), time()+3600*24*30, '/');
                    echo 'true';
                }else {
                    echo 'false';
                }
            }else{
                setcookie('chosen', json_encode([$_GET['data']]), time()+3600*24*30, '/');
                echo 'true';
            }
        }else{
            var_dump($_GET);
        }
    }

    public function ajaxRemoveFromChosen(){
        if(is_string($_GET['data']) && isset($_COOKIE['chosen'])){
            $cookie = json_decode($_COOKIE['chosen']);
            if(in_array($_GET['data'], $cookie)){
                array_splice($cookie, array_search($_GET['data'], $cookie), 1);
                setcookie('chosen', json_encode($cookie), time()+3600*24*30, '/');
                echo 'true';
            }else{
                echo 'false';
            }
        }else{
            echo 'false';
        }
    }

    public function ajaxAddToCart(){
        $productData = json_decode($_GET['data']);
        $productPrice = str_replace(' USD', '', $productData->price)*1;
        if(isset($_SESSION['cart']) && $_SESSION['cart'] == 'active'){
            $_SESSION['totalQuantity']++;
            $_SESSION['totalSum']+=$productPrice;
            $id = $productData->id;
            if(in_array($id, json_decode($_SESSION['IDs']))){
                $products = json_decode($_SESSION['products']);
                ++$products->$id->amount;
                $_SESSION['products'] = json_encode($products);
            }else{
                $productData->amount = 1;
                $ids = json_decode($_SESSION['IDs']);
                $ids[] = $id;
                $_SESSION['IDs'] = json_encode($ids);
                $products = json_decode($_SESSION['products']);
                $products->$id = $productData;
                $_SESSION['products'] = json_encode($products);
            }
        }else{
            $productData->amount = 1;
            $_SESSION['cart'] = 'active';
            $_SESSION['totalQuantity'] = 1;
            $_SESSION['totalSum'] = $productPrice;
            $_SESSION['products'] = json_encode([$productData->id => $productData]);
            $_SESSION['IDs'] = json_encode([$productData->id]);
        }
        echo 'true';
    }

    public function ajaxDeleteFromCart(){
        if($_SESSION['totalQuantity'] != 1){
            $id = $_GET['data']*1;
            $IDs = json_encode($_SESSION['IDs']);
            array_splice($IDs, array_search($id, $IDs), 1);
            $_SESSION['IDs'] = json_encode($IDs);
            $products = json_decode($_SESSION['products']);
            $price = str_replace(' USD', '', $products->$id->price);
            $amount = $products->$id->amount;
            $_SESSION['totalSum']-=$price*$amount;
            $_SESSION['totalQuantity']-=$amount;
            unset($products->$id);
            $_SESSION['products'] = json_encode($products);
            echo 'true/'.$price.'/'.$amount.'/'.$id;
        }else{
            unset($_SESSION['totalQuantity']);
            unset($_SESSION['totalSum']);
            unset($_SESSION['products']);
            unset($_SESSION['IDs']);
            unset($_SESSION['cart']);
            echo 'clear';
        }

    }
    
    public function openCart(){
        if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){
            $text = $this->view('parts/cart', ['added' => true, 'totalSum' => $_SESSION['totalSum'], 'totalQuantity' => $_SESSION['totalQuantity'], 'products' => (array)json_decode($_SESSION['products']), 'IDs' => json_decode($_SESSION['IDs'])]);
        }else{
            $text = $this->view('parts/cart', ['added' => false]);
        }
        echo $text;
    }

    public function clearCart(){
        unset($_SESSION['totalQuantity']);
        unset($_SESSION['totalSum']);
        unset($_SESSION['products']);
        unset($_SESSION['IDs']);
        unset($_SESSION['cart']);
        echo 'true';
    }
}

?>