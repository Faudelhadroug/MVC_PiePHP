<?php

namespace Core;

class Core
{
    public function run()
    {
        echo __CLASS__ . " [OK]" . PHP_EOL; 

        $baseLinkCount = strlen('/github/MVC_PiePHP/');
        $virginLink = ucfirst(substr($_SERVER['REQUEST_URI'], $baseLinkCount));
        $nbParamLink = substr_count($virginLink, '/');
        if ($nbParamLink == 0)
        {
            $controller = substr($virginLink, strpos($virginLink, '/'));
            if ($controller == '')
            {
                $controller = 'App';
            }
        }
        else
        {
            $controller = substr($virginLink, 0, strpos($virginLink, '/'));
        }
        if ($nbParamLink <= 1)
        {

            if($nbParamLink == 1)
            {
                $action = substr(substr($virginLink, strpos($virginLink, '/')), 1);
                if ($action == '')
                {
                    $action = 'index';
                }
            }
            else
            {
                $action = 'index';
            }
        }
        else
        {
            $action = substr(substr($virginLink, strpos($virginLink, '/')), 1);
            $action = substr($action, 0, (strpos($action = substr(substr($virginLink, strpos($virginLink, '/')), 1), '/')));
        }
        $action = $action.$controller;
        $controller = 'Controller\\'.$controller.'Controller';
        if (class_exists($controller))
        {
            $object = new $controller();
            //var_dump(method_exists($object, $action));
            if (method_exists($object, $action))
            {
                
                $object->$action();
            }
            else
            {
                echo '404'; 
            }
        }
        else
        {
            echo '404';
            //throw new Exception('The class '. $controller .' does not exist.');
        }
    }
}