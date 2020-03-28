<?php

namespace Model;

class UserModel extends \Core\Database
{
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    // public function getEmail()
    // {
    //     return $this->email;
    // }
    // public function getPassword()
    // {
    //     return $this->password;
    // }
    private function executeAndReturn($sql, $value) 
    {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$value]);
        $results = $stmt->fetchAll();
        return $results;
    }

    public function save()
    {
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->email, $this->password]);
    }

}