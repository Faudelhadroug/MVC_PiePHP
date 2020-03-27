<?php

namespace Model;

class UserModel extends \Core\Database
{
    private $email;
    private $password;

    private function executeAndReturn($sql, $value) 
    {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$value]);
        $results = $stmt->fetchAll();
        return $results;
    }

    public function save()
    {
        $sql = "UPDATE users SET email = ? AND password = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->email, $this->password]);
    }

}