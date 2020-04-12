<?php

namespace Model;

class UserModel extends \Core\Entity
{
    public $relations = [
        "has_many" => [array("table" => "article", "key" => "user_id")],
        "has_one" => [array("table" => "promo", "key" => "promo_id")],
        "many_to_many" => [array("table1" => "user", "table2" => "color")]
    ];
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