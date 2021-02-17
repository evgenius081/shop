<?php

namespace core;

class Controller
{
    protected $view;

    public function __construct(){
        $this->view = new View();
    }

    final public function view($view_name, $params = [], $display = true){
        $this->view->assign('view_name', $view_name);
        foreach($params as $key=>$value){
            $this->view->assign($key, $value);
        }
        if(!$display){
            return $this->buffer($view_name, $params, $display);
        }else{
            $this->view->display($view_name);
        }
    }

    public function buffer($view_name, $params){
        ob_start();
        if(isset($params['0'])){
            foreach($params['0'] as $element){
                $this->view->assign('0', $element);
                $this->view->display($view_name, false);
            }
        }else if(isset($params['pages_number'])){
            $this->view->display($view_name, false);
        }
        $text = ob_get_contents();
        ob_end_clean();
        return $text;
    }

    public function __destruct()
   {
      exit();
   }
}