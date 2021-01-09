<?php

namespace ishop\core;

class ErrorHandler{

    public function __construct(){
        if(DEBUG){
            \error_reporting(E_ALL);
        }else{
            \error_reporting(0);
        }
        \set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e){
        $this->writelogs($e->getMessage(), $e->getLine(), $e->getFile(), $e->getCode());
        $this->displayLogs($e->getMessage(), $e->getLine(), $e->getFile(), $e->getCode());
    }

    protected function writeLogs($message = "", $line = "", $file = "", $code = ""){
        error_log("Дата[".date("Y:m:d H:i:s")."] текст ошибки: {$message}, Строка ошибки: {$line}, Файл ошибки: {$file}, Код ошибки: {$code}\n=================================\n", 3, ROOT . '/tmp/errors.log');
    }

    protected function displayLogs($message = "", $line = "", $file = "", $code = 404){
        if(!DEBUG && $code === 404){
            require_once WWW . '/errors/404.php';
            die();
        }

        if(DEBUG){
            require_once WWW . '/errors/dev.php';
        }else{
            require_once WWW . '/errors/prod.php';
        }
    }
}