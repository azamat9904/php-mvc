<?php

namespace ishop\base;

class View{
    protected $route;
    protected $controller;
    protected $model;
    protected $view;
    protected $prefix;
    protected $data;
    protected $layout;
    protected $meta;
    
    public function __construct($route, $layout = "", $view = "", $meta){
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;

        if($this->layout === false){
            $this->layout = false;
        }else{
            $this->layout = !empty($layout) ? $layout : LAYOUT;
        }
    }

    public function render($data){
        if(\is_array($data)) extract($data);

        $viewPath = APP . '/views/' . $this->prefix . $this->controller . '/' . $this->view . '.php';

        if(\file_exists($viewPath)){
            ob_start();
            require_once $viewPath;
            $content = \ob_get_clean();
        }else{
            throw new Exception("Файл {$viewPath} не найден", 404);
        }

        if($this->layout !== false){
            $layoutPath = APP . '/views/layouts/' . $this->layout . '.php';
            if(\file_exists($layoutPath)){
                require_once $layoutPath;
            }else{
                throw new Exception("Layout {$layoutPath} не найден", 404);
            }
        }
    }

    public function getMeta(){
        $output = "<title>". $this->meta['title']."</title>" . PHP_EOL;
        $output .= "<meta name='description' content='".$this->meta['description']."'>" . PHP_EOL;
        $output .= "<meta name='keywords' content='".$this->meta['keywords']."'>" . PHP_EOL;
        return $output;
    }
}