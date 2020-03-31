<?php

namespace Core;

class Entity
{
    //private $connexionDb;
    
    public function __construct($params)
    {
        $class = get_class($this); // il faut rajouter le s
        $table = explode('\\', $class);
        $table = strtolower(substr($table[1], 0, -strlen($table[0]))) . 's';
        if (array_key_exists('id', $params))
        {
            $fields = $params;
            $params = ORM::read($table, $params['id']);
            if ($params !== null)
                foreach ($params as $key => $value)
                {
                    $this->$key = $value;
                }
            unset($fields['id']);
        }
        else
        {
            foreach ($params as $key => $value)
            {
                $this->$key = $value;
            }
            $fields = $params;
        }
        $this->fields = $fields;
        $this->params = $params;
        $this->class = $class;
        $this->table = $table;
    }
    public function create()
    {
       $id = ORM::create($this->table, $this->fields);
       return $id;
    }
    public function read()
    {
        if (!isset($this->id))
            return 'error ID';
        $results = ORM::read($this->table, $this->id);
        return $results;
    }
    public function update()
    {
        if (!isset($this->id))
            return false;
        $update = ORM::update($this->table, $this->id, $this->fields);
        return $update;
    }
    public function delete()
    {
        if (!isset($this->id))
            return false;
        $delete = ORM::delete($this->table, $this->id);
        return $delete;
        
    }
    public function find($table, $params = array(
        'WHERE' => '1',
        'ORDER BY' => 'id ASC',
        'LIMIT' => ''
    ))
    {

    }
}