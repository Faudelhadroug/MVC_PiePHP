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

        //var_dump($url);
        return array_key_exists($url, self::$routes) ? self::$routes[$url] : null;
        // retourne un tableau associatif contenant
        // - le controller à instancier
        // - la methode du controller à appeler
    }
}