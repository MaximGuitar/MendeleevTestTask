<?php
    use Placestart\TemplateEngine;
    function tpl($name, $params = []){
        return TemplateEngine::render($name, $params);
    }