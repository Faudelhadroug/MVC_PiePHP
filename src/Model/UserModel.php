<?php

namespace Model;

class UserModel extends \Core\ORM
{
    private $email;
    private $password;
    private $connexionDb;

    public function __construct($email = '', $password = '') 
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

    public function createUser()
    {
        $id = $this->create('users', array(
            'email' => $this->email,
            'password' => $this->password
        ));
        return $id;
        //return var_dump($a);
    }
    public function readUser()
    {
        $read = $this->read('users', 1);
        return $read;
    }
    public function updateUser()
    {
        $update = $this->update('users', 1, array(
            'email' => 'choco@blackos.com',
            'password' => 'mamadou'
        ));
        return $update;
    }
    public function deleteUser()
    {
        $delete = $this->delete('users', 3);
        return $delete;
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
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$value, $value2]);
        $results = $stmt->fetchAll();
        return $results;
    }

}