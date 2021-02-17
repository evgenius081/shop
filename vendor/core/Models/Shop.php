<?php

namespace core\Models;

class Shop extends \core\Model{
    public function getProductByName($name){
        $db = $this->setInstance();
        $product = $db->table('products_en')->where(['name'], '%', [str_replace('_', ' ', strtolower($name))])->getSome()[0];
        return $product;
    }

    public function getMiniProductsByName($name){
        $db = $this->setInstance();
        $products = $db->table('products_en')->from('name, image, price')->where(['name'], '%', [str_replace('_', ' ', strtolower($name))])->getSome(5);
        return $products;
    }

    public function getProductsByName($name){
        $db = $this->setInstance();
        $products = $db->table('products_en')->where(['name'], '%', [str_replace('_', ' ', strtolower($name))])->getSome();
        return $products;
    }

    public function getProductsBySearchWithFilters($name, $order = '', $amount){
        $db = $this->setInstance();
        if($order!=''){
            $params = ['name'=>[str_replace('_', ' ', strtolower($name))], 'order' => [$order]];
        }else{
            $params = ['name'=>[str_replace('_', ' ', strtolower($name))]];
        }
        $products = $db->table('products_en')->where(['name', 'sort'], '%', $params)->getSome($amount);
        return $products;
    }

    public function getSomeProducts($amount, $page= 0){
        $db = $this->setInstance();
        $products = $db->table('products_en')->from("*")->getSome($amount, $page);
        return $products;
    }

    public function getProductsByFilters($columns, $values){
        $db = $this->setInstance();
        $products = $db->table('products_en')->where($columns, "%", $values)->getSome($values['limit'][0], isset($values['number']['0'])?$values['number']['0']:$values['current'][0]);
        return $products;
    }

    public function getFiletrs(){
        $db = $this->setInstance();
        $filters = $db->table('filters_en')->from('*')->getSome();
        return $filters;
    }
}