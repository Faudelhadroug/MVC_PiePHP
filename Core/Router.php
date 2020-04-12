<?php

namespace Core;

class Router
{
    private static $routes;
    public static function connect($url, $route)
    {
        self::$routes[$url] = $route;
    }
    public static function get($url)
    {
        $verifURLS = explode('/', $url);
        // echo '<pre>';
        // var_dump($verifURLS);
        // echo '</pre>';
        $patternID = '/^\d+$|^[?]{1}$/' ;// '/^\d+$/';

        if(isset($verifURLS[1]) == 'delete' && isset($verifURLS[2]) && preg_match($patternID, $verifURLS[2]) == true)
        {
            $url = '/delete/{id}';
            $id = $verifURLS[2];
            if ($id == '?')
                $id = 42;
            return ['route' => self::$routes[$url], 'id' => $id];
        }
        if(isset($verifURLS[1]) == 'user' && isset($verifURLS[2]) == 'details' && isset($verifURLS[3]) && preg_match($patternID, $verifURLS[3]) == true)
        {
            $url = '/user/details/{id}';
            $id = $verifURLS[3];
            if ($id == '?')
                $id = 42;
            return ['route' => self::$routes[$url], 'id' => $id];
        }
        return array_key_exists($url, self::$routes) ? self::$routes[$url] : null;
        // retourne un tableau associatif contenant
        // - le controller à instancier
        // - la methode du controller à appeler
    }
}