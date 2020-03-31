<?php

namespace Core;

class ORM
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
        $stmt = \Core\Database::connect()->prepare($sql);
        $stmt->execute($values);
        $sql = "SELECT MAX(id) as 'id' FROM $table";

        $stmt = \Core\Database::connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        if(isset($results[0]['id']))
            return $results[0]['id'];
    }
    public function read($table, $id)
    {
        $sql = "SELECT * from $table WHERE id = ?";
        $stmt = \Core\Database::connect()->prepare($sql);
        $stmt->execute([$id]);
        $results = $stmt->fetchAll();
        if(isset($results[0]))
            return $results[0];

    }
    public function update($table, $id, $fields)
    {
        $setValue = '';
        foreach($fields as $key => $value)
        {
            $setValue .= "$key = '$value'";
            if (array_key_last($fields) !== $key)
                $setValue .= ",\n";       
        }
        $sql = "UPDATE $table SET $setValue  where id = ?";
        $stmt = \Core\Database::connect()->prepare($sql);
        $result = $stmt->execute([$id]);
        $result = $result == true ? true : false;
        return $result;
    }
    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = ?";
        $stmt = \Core\Database::connect()->prepare($sql);
        $result = $stmt->execute([$id]);
        $result = $result == true ? true : false;
        return $result;
    }
    public function find($table, $params = array(
        'WHERE' => '1',
        'ORDER BY' => 'id ASC',
        'LIMIT' => ''
    ))
    {

    }
}