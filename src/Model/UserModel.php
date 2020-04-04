<?php

namespace Model;

class UserModel extends \Core\Entity
{
    public $connectDb;
    private static $relations;
   
    public function find()
    {
        // if(isset($this->id))
        //     var_dump($this->id);
        $find = \Core\ORM::find($this->table, $condition = array(
            'WHERE' => ['id' => '1'],
            'ORDER BY' => 'id ASC',
            'LIMIT' => '' 
        ));
        return $find;
    }
    public function connexion()
    { 
        $result = \Core\ORM::find($this->table, $condition = array(
            'WHERE' => ['email' => $this->email],
            'AND',
            ['password' => $this->password],
            'ORDER BY' => 'id ASC',
            'LIMIT' => ''
        ));
        return $result;
    }

}