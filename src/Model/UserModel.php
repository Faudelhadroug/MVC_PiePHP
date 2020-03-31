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
        $this->fields =
        [ 
            'WHERE' => ['email' => $this->email],
            'AND',
            ['password' => $this->password],
            'ORDER BY' => 'id ASC',
            'LIMIT' => ''];
        $result = $this->find();
        return $result;
    }

}