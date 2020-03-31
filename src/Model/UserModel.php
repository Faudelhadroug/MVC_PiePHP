<?php

namespace Model;

class UserModel extends \Core\Entity
{
    public $connectDb;
    public function __construct($params) 
    {
        parent::__construct($params);
        $connectDb = \Core\Database::connect();

        $this->connectDb = $connectDb;
    }
    

    public function connexion()
    { 
        $sql = "SELECT * from $this->table WHERE email = ?";
        $stmt = $this->connectDb->prepare($sql);
        $stmt->execute([$this->email]);
        $results = $stmt->fetchAll();
        var_dump($results);
        return $results;
    }

}