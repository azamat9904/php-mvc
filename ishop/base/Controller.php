<?php

namespace ishop\base;

abstract class Controller{

    protected $route;
    protected $controller;
    protected $view;
    protected $model;
    protected $meta = ['title' => '', 'description' => '', 'keywords' => ''];
    protected $data = [];
    protected $prefix;
    protected $layout;

    public function __construct($route){
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }
    
    public function set($data = []){
        $this->data = $data;
    }

    public function setMeta($title = "", $description = "", $keywords = ""){
        $this->meta['title'] = $title;
        $this->meta['description'] = $description;
        $this->meta['keywords'] = $keywords;
    }

    public function getView(){
        $view = new View($this->route, $this->layout, $this->view, $this->meta);
        $view->render($this->data);
    }
}