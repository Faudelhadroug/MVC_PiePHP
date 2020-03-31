<?php

namespace Core;

class Database
{
    private static $host = "localhost";
    private static $user = "root";
    private static $pwd = "";
    private static $dbName = "piephp";
    // public function __construct()
    // {
    //     $this->host = $host;
    //     $this->user = $user;
    //     $this->pwd = $pwd;
    //     $this->dbname = $dbname;

    // }
    public static function connect() 
    {
        $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbName;
        $pdo = new \PDO($dsn,  self::$user,  self::$pwd);
        //$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        //$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES,TRUE);
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        
        return $pdo;
    }
}