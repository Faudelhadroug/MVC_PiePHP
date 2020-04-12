<?php

namespace Core;

class Database
{
    private static $host = "localhost";
    private static $user = "root";
    private static $pwd = "";
    private static $dbName = "piephp";
    private static $pdo;

    public static function connect() 
    {
      
        if (self::$pdo == null)
        {
            $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbName;
            self::$pdo = new \PDO($dsn,  self::$user,  self::$pwd);
            self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return self::$pdo;
    }
}