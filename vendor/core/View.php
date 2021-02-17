<?php

namespace core;

class View
{
    private $var;
    private $path;

    public function __construct(){
            $this->path = __DIR__.DIRECTORY_SEPARATOR."views". DIRECTORY_SEPARATOR;
    }

    public function path($dirname){
        $dirname = __DIR__.DIRECTORY_SEPARATOR.$dirname;
        if(substr($dirname, -1) !== DIRECTORY_SEPARATOR){
            $dirname.=DIRECTORY_SEPARATOR;
        }
        if(!is_dir($dirname)){
            mkdir($dirname);
        }
        $this->path = $dirname;
    }

    public function display($view_name, $display = true){
        if($display){
            if(!strpos($view_name, 'parts/') && !strpos($view_name, 'cart')){
                include '../vendor/core/views/parts/header.php';
                include $this->path.$view_name.'.php';
                include '../vendor/core/views/parts/footer.php';
            }else{
                include $this->path.$view_name.'.php';
            }
        }else{
            include $this->path.$view_name.'.php';
        }
    }

    public function assign($key, $value){
        $this->var[$key] = $value;
    }
}