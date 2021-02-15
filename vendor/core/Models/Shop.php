<?php

namespace core\Models;

class Shop extends \core\Model{
    public function getProductByName($name){
        $db = $this->setInstance();
        $product = $db->table('products_en')->where(['name'], '%', [str_replace('_', ' ', strtolower($name))])->getSome()[0];
        return $product;
    }

    public function getSomeProducts($amount){
        $db = $this->setInstance();
        $products = $db->table('products_en')->from("*")->getSome($amount);
        return $products;
    }

    public function getProductsByFilters($columns, $values){
        $db = $this->setInstance();
        $products = $db->table('products_en')->where($columns, "%", $values)->getSome();
        return $products;
    }

    public function getFiletrs(){
        $db = $this->setInstance();
        $filters = $db->table('filters_en')->from('*')->getSome();
        return $filters;
    }
}