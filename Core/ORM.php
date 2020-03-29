<?php

namespace Core;

class ORM extends \Core\Database
{
    public function create($table, $fields)
    {
        $column = '';
        $values = '';
        $inValues = '';
        foreach($fields as $key => $value)
        {
            $column .= "$key";
            $values .= "$value";  
            $inValues .= "?"; 
            if (array_key_last($fields) !== $key)
                $column .= ', ';
            if (end($fields) !== $value)
            {
                $values .= ', ';
                $inValues .= ", ";
            }
                
                
        }
        $values = explode(',', $values);
       
        $sql = "INSERT INTO $table ($column) VALUES ($inValues)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($values);

    }
    public function read($table, $id)
    {

    }
    public function update($table, $id, $fields)
    {

    }
    public function delete($table, $id)
    {

    }
    public function find($table, $params = array(
        'WHERE' => '1',
        'ORDER BY' => 'id ASC',
        'LIMIT' => ''
    ))
    {

    }
}