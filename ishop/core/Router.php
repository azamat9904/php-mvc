<?php

namespace ishop\core;

class Router{

    protected static $routes = [];
    protected static $route = [];

    public static function getRoutes(){
        return self::$routes;
    }

    public static function getRoute(){
        return self::$route;
    }

    public static function dispatch($url){
        self::setRoutes();
        $route = self::deleteQueryString($url);
        if(self::matchRoute($route)){
            if(!empty(self::$route['prefix'])) self::$route['prefix'] .= "\\";
            $controller = "app\controllers\\" . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            if(class_exists($controller)){
                $controllerObject = new $controller(self::$route);
                $action = self::$route['action'] . 'Action';
                if(\method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                }else{
                    throw new Exception("Метод {$action} не найден", 404);
                }
            }else{
                throw new Exception("Контроллер {$controller} не найден", 404);
            }
        }else{
            throw new Exception("Маршрут не найден", 404);
        }
    }

    public static function matchRoute($route){
        foreach(self::$routes as $path => $params){
            if($path === $route){
                self::$route = $params;
                return true;
            }
        }
        return false;
    }

    public static function setRoutes(){
        $routes = require_once CONFIG . '/routes.php';
        if($routes){
            foreach($routes as $path => $params){
                self::$routes[$path] = $params;
            }
        }
    }

    public static function deleteQueryString($route){
        $url = explode("&", $route, 2);
        if(strpos($url[0], '=') === false){
            return $url[0];
        }else{
            return "";
        }
    }
}