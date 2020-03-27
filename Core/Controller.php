<?php

namespace Core;

class Controller
{
    public static $_render;
    protected function render($view, $scope = [])
    {
        extract($scope);
        $f = implode(DIRECTORY_SEPARATOR,  str_replace('\\', '', [dirname(__DIR__), 'src', 'View', str_replace('Controller', '', basename(get_class($this))), $view])) . '.php'; //[dirname(__DIR__), 'src', 'View', str_replace('Controller', '', basename(get_class($this))), $view]). '.php';
        // str_replace('\\', '', [dirname(__DIR__), 'src', 'View', str_replace('Controller', '', basename(get_class($this))), $view])
        //var_dump(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
        var_dump($f);
        if (file_exists($f))
        {
            var_dump($f);
            ob_start();
            include($f);
            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            return self::$_render = ob_get_clean();
        }
        //echo $view;
    }
}