<?php 
namespace Placestart;

class TemplateEngine{
    private static $instance = null;

    private static function getInstance(){
        if (self::$instance) return self::$instance;

        $plates = new \League\Plates\Engine(PLATES_PATH);
        return self::$instance = $plates;
    }

    public static function render($name, $params = []){
        return self::getInstance()->render($name, $params);
    }
}