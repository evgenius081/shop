<?php

$loader = require($_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php');
$loader->addPsr4('core\\', __DIR__ .'/');

$controller = new \core\Controller;    

$requestURI = $_SERVER['REQUEST_URI'];
if ($pos = strpos($requestURI, '?')) {
    $requestURI = substr($requestURI, 0, $pos);
}
if (substr($requestURI, -1) !== '/') {
    $requestURI .= '/';
}

session_start();
error_reporting(E_ERROR | E_PARSE);

$routes = include __DIR__ . '/config/routes.php';

if (isset($routes[$requestURI])) {
    $route = $routes[$requestURI];
    if (is_callable($route)) {
        call_user_func($route);
    } else if (is_string($route) && strpos($route, '@')) {
        $results = explode('@', $route);
        $class = 'core\\controller\\' . $results[0];
        if (class_exists($class)) {
            if (method_exists($class, $results[1])) {
                call_user_func([new $class, $results[1]]);
                exit();
            }
            header('Location: /404');
        }else {
            trigger_error('');
        }
    }
} else {
    foreach ($routes as $url => $route) {
        if (strpos($url, '{')) {
            $a = preg_replace(['~\{i\}~', '~\{s\}~'], ['([0-9]+)','([a-zA-Z0-9_.-]+)'], $url);
            if (preg_match('~'.$a.'~', $requestURI, $matches)) {
                array_shift($matches);
                if (is_callable($route)) {
                    call_user_func($route,$matches);
                } else if (is_string($route) && strpos($route, '@')) {
                    $results = explode('@', $route);
                    $class = 'core\\controller\\' . $results[0];
                    if (class_exists($class)) {
                        if (method_exists($class, $results[1])) {
                            call_user_func([new $class, $results[1]],$matches);
                            exit();
                        }
                    }
                    header('Location: /404');
                } else {
                    trigger_error('');
                }
            }
        }
    }
    if ($requestURI !== '/404/') {  
        header('Location: /404');
    }
    include __DIR__ . '/views/404.php';
}