<?php

namespace app\controllers;
use ishop\base\Controller;

class MainController extends Controller{

    public function indexAction(){
        $this->setMeta('Главная страница', 'Описание', 'Ключевые слова');
        $this->getView();
    }
}