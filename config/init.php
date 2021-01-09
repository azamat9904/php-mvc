<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("CACHE", ROOT . '/tmp/cache');
define("WWW", ROOT . '/public');
define("CONFIG", ROOT . '/config');
define("ISHOP", ROOT . '/ishop');
define("CORE", ISHOP . '/core');
define("BASE", ISHOP . '/base');
define("LAYOUT", 'default');
define("APP", ROOT . '/app');

$url = null;

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";   
else  
    $url = "http://";   

$url.= $_SERVER['HTTP_HOST'];   

define("PATH", $url);
define("ADMIN", PATH . '/admin');

require_once ROOT . '/vendor/autoload.php';