<?php

namespace core;


use \PDO;

class Model{

    private static $instance;
    private $db;
    private $table;
    private $placeholder;
    private $where;
    private $col = " * ";
    private $fields;


    public function __construct(){
        //$this->db = new PDO('mysql: host=localhost;dbname=blog-shop', 'root', '');
        $this->db = mysqli_connect("localhost", 'root', '', 'blog-shop');
        if(!$this->db){
            print("Error ".mysqli_connect_error());
        }
    }

    public function setInstance()
    {
        if(!self::$instance instanceof self){
            self::$instance = new Model();
        }
        return self::$instance;
    }

    public function query(string $sql, array $params = [])
    {
        $stm = mysqli_query($this->db, $sql);
        $result = mysqli_fetch_all($stm, MYSQLI_ASSOC);
        return $result;
    }

    public function table($table = null){
        if($table === null){
            $table = substr(get_class($this), strpos(get_class($this), '\\') +1);
        }else
            $table = strtolower($table);
        $this->table = $table;
        return $this;
    }

    public function from($col){
        $this->col = $col;
        return $this;
    }

    public function where($col, $char, $params, $or = ''){
        $this->where=' WHERE ';
        if($char == "="){
            foreach($col as $c => $value){
                if($c == count($col) - 1){
                    $this->where .= $value.$char.'"'.$params[$c]. '"';
                }else{
                    $this->where .= $value.$char.'"'.$params[$c];
                    if($or == ''){
                        $this->where .= '" AND ';
                    }else{
                        $this->where .= '" OR ';
                    }
                }
            }
        }else if($char == "%"){
            foreach($col as $c => $value){
                if($value == 'price'){
                    $this->where .= 'price BETWEEN '. $params['price'][0]*1 .' AND '. $params['price'][1]*1;
                    if($params['price'][2] == 'discount'){
                        $this->where .= ' AND old_price > 0 ';
                    }
                }else{
                    if(count(array_filter(array_keys($params), 'is_string')) > 0){
                        for($i = 0; $i< count($params[$value]); $i++) {
                            if($i == 0 && count($params[$value]) > 1){
                                $this->where .= '(';
                            }
                            if($i == count($params[$value]) - 1){
                                $this->where .= ' lower('.$value.') LIKE "%'.$params[$value][$i].'%" ';
                            }else{
                                $this->where .= ' lower('.$value.') LIKE "%'.$params[$value][$i].'%" OR ';
                            }
                            if($i == count($params[$value]) - 1 && count($params[$value]) > 1){
                                $this->where .= ') ';
                            }
                        }
                    }else{
                        $this->where .= 'lower('.$col[0].') LIKE "%'.$params[0].'%"';
                    }
                }
                if($c != count($col) - 1){
                    $this->where .= " AND ";
                }
            }
        }
        $this->placeholder[':'.$col] = $params;
        return $this;
    }

    public function getSome($amount = 0, $page = 0){
        $sql = 'SELECT '.$this->col.' FROM '. $this->table;
        if($this->where){
            $sql .=  $this->where;
        }
        if($amount){
            $sql .= " LIMIT ".$amount;
        }
        if($page){
            $sql .= " OFFSET ". (($page - 1) * $amount);
        }
        return $this->query($sql);
    }

    public function delete(){
        $sql = 'DELETE FROM '. $this->table;
        if($this->where){
            $sql .=  $this->where. ' ';
        }
        return $this->query($sql, $this->placeholder);
    }

    public function set($params){
        $sql = "INSERT INTO ".$this->table.' '.$this->col.' VALUES (';
        for($k = 0; $k < count($params); $k++){
            if($k == count($params) - 1){
                $sql .= $params[$k];
            }else if($k == 0 && $params[$k] == null){
                $sql .= 'NULL, "';
            }else{
                $sql .= $params[$k].'" , "';
            }
        }
        $sql .= '")';
        $stm = mysqli_query($this->db, $sql);
        return mysqli_insert_id($this->db);
    }

    public function getOne()
    {
        return $this->getSome()[0];
    }

}