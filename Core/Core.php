<?php

namespace Core;
//use Core\Router;

class Core
{
    public function __construct()
    {
        require_once('src/routes.php');
    }
    public function run()
    {
       // echo __CLASS__ . " [OK]" . PHP_EOL; 

        $baseLinkCountStatic = strlen('/github/MVC_PiePHP');
        $virginLinkStatic = ucfirst(substr($_SERVER['REQUEST_URI'], $baseLinkCountStatic));
       
        /* Routeur */
        
        if ($route = Router::get($virginLinkStatic) !== null)   // Routage statique
        {
            if(array_key_exists('route', Router::get($virginLinkStatic)) == true) // Routeur paramétrique
            {
                $class = Router::get($virginLinkStatic)['route']['controller'];
                $action = Router::get($virginLinkStatic)['route']['action'];
                $controller = 'Controller\\'.ucfirst(($class)).'Controller';
                $doAction = $action.'Action';
                $object = new $controller();
                if ($action == 'delete' || $action == 'details')
                {
                    $id = Router::get($virginLinkStatic)['id'];
                    $object->$doAction($id);
                }
            }
            else // Routeur statique
            {
                $class = Router::get($virginLinkStatic)['controller'];
                $action = Router::get($virginLinkStatic)['action'];
                $controller = 'Controller\\'.ucfirst(($class)).'Controller';
                $doAction = $action.'Action';
                $object = new $controller();
                $object->$doAction();
            }
            
            
        }
        else    // Routage dynamique
        {
            $pathParametrique = ['/delete/', '/user/details/'];
            $i = 0;
            $access = true;
            while ($i !== count($pathParametrique))
            {
                if ($virginLinkStatic == $pathParametrique[$i])
                    $access = null;
                $i++;
            }
            if ($access !== null)
                $routageDynamique = $this->Dynamique();
            else
                echo 'Erreur argument';
        }
    }
    private function Dynamique()
    {
        $baseLinkCount = strlen('/github/MVC_PiePHP/');
        $virginLink = ucfirst(substr($_SERVER['REQUEST_URI'], $baseLinkCount));
       
        $nbParamLink = substr_count($virginLink, '/');
        if ($nbParamLink == 0)
        {
            $class = substr($virginLink, strpos($virginLink, '/'));
            if ($class == '')
            {
                $class = 'App';
            }
        }
        else
        {
            $class = substr($virginLink, 0, strpos($virginLink, '/'));
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
        $doAction = $action.'Action';
        $controller = 'Controller\\'.$class.'Controller';
        if (class_exists($controller))
        {
            $object = new $controller();
            //var_dump(method_exists($object, $action));
            if (method_exists($object, $doAction))
            {
                
                $object->$doAction();
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