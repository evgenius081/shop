<?php

namespace core\Controller;

class Main extends \core\Controller
{
    public function index()
    {
        echo __CLASS__ . ' - ' . __METHOD__;
    }

    public function about(){
        $this->view('about');
    }

    public function contacts(){
        $this->view('contacts');
    }
}