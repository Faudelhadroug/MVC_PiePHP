<?php

namespace Core;

class Entity
{
    //private $connexionDb;
    public static $class;
    public function __construct($params = null)
    {
        new \Core\ORM();
        $connectDb = \Core\Database::connect();
        $class = get_class($this); 
        $table = explode('\\', $class);
        $table = strtolower(substr($table[1], 0, -strlen($table[0]))) . 's';
        
        if ($params !== null && array_key_exists('id', $params))
        {
            if (isset($this->relations['has_many']))
            {
               //var_dump($params['id']);
               //var_dump($table);
               $idToSearch = substr($table, 0 , -1).'_id';
                echo '<pre> Has many ';
                var_dump($this->relations['has_many'][0]['table']);
                echo '</pre>';
                $finds = \Core\ORM::find($this->relations['has_many'][0]['table'].'s', $condition = array(
                    'WHERE' => ["$idToSearch" => $params['id']],
                    'ORDER BY' => 'id ASC',
                    'LIMIT' => '' 
                ));
                $nameTable = $this->relations['has_many'][0]['table'].'s';
                //return var_dump($finds[0]);

                $relationsTable = [];
                foreach($finds as $find)
                {
                    //var_dump($find['id']);
                    $read = ORM::read($this->relations['has_many'][0]['table'].'s', $find['id']);
                    // echo '<pre>';
                    // var_dump($read);
                    // echo '</pre>';
                    array_push($relationsTable, $read);
                    //$this->$relationsTable = $read;
                    //echo "<br> $find <br>";
                }
                $this->$nameTable = $relationsTable;
          
                // echo '<pre>';
                // var_dump($this->articles);
                // echo '</pre>';
                return;
    
            }
            if (isset($this->relations['has_one']))
            {
                echo '<pre> Has one ';
                var_dump($this->relations['has_one']);
                echo '</pre>';
            }
            if (isset($this->relations['many_to_many']))
            {
                echo '<pre> Many to many ';
                var_dump($this->relations['many_to_many']);
                echo '</pre>';
            }
            $fields = $params;
            $params = ORM::read($table, $params['id']);
            if ($params !== null)
                foreach ($params as $key => $value)
                {
                    $key = str_replace(' ', '', $key);
                    $this->$key = $value;
                }
            unset($fields['id']);
            $this->fields = $fields;
            
        }
        else
        {
            if ( $params !== null)
            {
                foreach ($params as $key => $value)
                {
                    $key = str_replace(' ', '', $key);
                    $this->$key = $value;
                }
                $fields = $params;
                $this->fields = $fields;
            }

        }

        $this->connectDb = $connectDb;
        $this->params = $params;
        $this->$class = $class; 
        $this->table = $table;
        if ($params == null)
        {
            return;
        }
        
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
        $read = ORM::read($this->table, $this->id);
        return $read;
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
    public function read_all()
    {
        $readAll = ORM::read_all($this->table);
        return $readAll;
    }
}