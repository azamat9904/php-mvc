<?php

namespace ishop\core;

class Registry{
    use TSingleton;

    protected $properties = [];

    public function setProperty($k, $v){
        $this->properties[$k] = $v;
    }

    public function getProperty($k){
        if(isset($this->properties[$k])){
            return $this->properties[$k];
        }
        return false;
    }

    public function getProperties(){
        return $this->properties;
    }
}