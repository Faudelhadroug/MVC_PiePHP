<?php

namespace Model;

class UserModel extends \Core\Database
{
    private $email;
    private $password;
    private $connexionDb;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->connectDb = $this->connect();
    }
    // public function getEmail()
    // {
    //     return $this->email;
    // }
    // public function getPassword()
    // {
    //     return $this->password;
    // }
    private function executeAndReturn($sql, $value, $value2) 
    {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$value, $value2]);
        $results = $stmt->fetchAll();
        return $results;
    }
    public function create($email, $password)
    {
        $this->save();
        $sql = "SELECT id from users WHERE email = ? and password = ?";
        return $this->executeAndReturn($sql, $this->email, $this->password);
    }
    public function read()
    {

    }
    public function update()
    {

    }
    public function delete()
    {

    }
    public function read_all()
    {

    }
    public function save()
    {
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $this->connectDb->prepare($sql);
        $stmt->execute([$this->email, $this->password]);
    }

    public function connexion()
    {
        $sql = "SELECT * from users WHERE email = ? and password = ?";
        return $this->executeAndReturn($sql, $this->email, $this->password);
    }

}