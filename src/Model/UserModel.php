<?php

namespace Model;

class UserModel extends \Core\Entity
{
    public $connectDb;
    public $relations = [
        "has_many" => [array("table" => "article", "key" => "user_id")],
        "has_one" => [array("table" => "promo", "key" => "promo_id")],
        "many_to_many" => [array("table1" => "user", "table2" => "color")]
    ];
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