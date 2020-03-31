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
        $sql = "SELECT * from $this->table WHERE email = ? and password = ?";
        $stmt = $this->connectDb->prepare($sql);
        $stmt->execute([$this->email, $this->password]);
        $results = $stmt->fetchAll();
        var_dump($results);
        return $results;
    }

}