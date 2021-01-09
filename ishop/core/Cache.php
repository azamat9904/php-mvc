<?php

namespace ishop\core;

class Cache{
    use TSingleton;

    public function set($key, $value, $seconds = 3600){
        $cachePath = CACHE . '/' . md5($key) . '.txt';
        $content['data'] = $value;
        $content['end_time'] = time() + $seconds;
        if(\file_put_contents($cachePath, serialize($content))){
            return true;
        }
        return false;
    }

    public function get($key){
        $cachePath =  CACHE . '/' . md5($key) . '.txt';
        if(\file_exists($cachePath)){
            $content = unserialize(\file_get_contents($cachePath));
            if($content['end_time'] >= time()){
                return $content['data'];
            }
            \unlink($cachePath);
        }
        return false;
    }

    public function delete($key){
        $cachePath = CACHE . '/' . md5($key) . '.txt';
        if(file_exists($cachePath)){
            \unlink($cachePath);
        }
    }
}