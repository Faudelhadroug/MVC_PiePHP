<?php

namespace Core;

class ORM extends \Core\Database
{
    protected function executeAndReturn($sql, $value, $value2) 
    {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$value, $value2]);
        $results = $stmt->fetchAll();
        return $results;
    }
    
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
        $sql = "SELECT MAX(id) as 'id' FROM $table";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results[0]['id'];
    }
    public function read($table, $id)
    {
        $sql = "SELECT * from $table WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $results = $stmt->fetchAll();
        return $results[0];

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