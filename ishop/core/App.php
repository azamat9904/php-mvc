<?php

namespace ishop\core;

class App{

    public static $app;

    public function __construct(){
        $query = $_SERVER['QUERY_STRING'];
        session_start();
        new ErrorHandler();
        self::$app = Registry::instance();
        $this->getParams();
        Router::dispatch($query);
    }

    public function getParams(){
        $params = require_once CONFIG . '/params.php';
        if($params){
            foreach($params as $k => $v){
                self::$app->setProperty($k, $v);
            }
        }
    }
}