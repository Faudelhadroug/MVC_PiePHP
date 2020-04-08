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
               $idToSearch = substr($table, 0 , -1).'_id';
                for ($i = 0; $i !== count($this->relations['has_many']); $i++)
                {

                    $finds = \Core\ORM::find($this->relations['has_many'][$i]['table'].'s', $condition = array(
                        'WHERE' => ["$idToSearch" => $params['id']],
                        'ORDER BY' => 'id ASC',
                        'LIMIT' => '' 
                    ));
                    $nameTable = $this->relations['has_many'][$i]['table'].'s';

                    $relationsTable = [];
                    foreach($finds as $find)
                    {
                        $read = ORM::read($this->relations['has_many'][$i]['table'].'s', $find['id']);
                        array_push($relationsTable, $read);
                    }
                    $this->$nameTable = $relationsTable;
                }
    
            }
            if (isset($this->relations['has_one']))
            {
                $idToSearch = substr($table, 0 , -1).'_id';
                for ($i = 0; $i !== count($this->relations['has_many']); $i++)
                {
                    $keyToSearch = $this->relations['has_one'][$i]['key'];
                    $find = \Core\ORM::find($table, $condition = array(
                        'WHERE' => ['id' => $params['id']],
                        'ORDER BY' => 'id ASC',
                        'LIMIT' => '' 
                    ));
                    $find[$i][$keyToSearch];
                    $nameTable = $this->relations['has_one'][$i]['table'].'s';
                    $read = ORM::read($nameTable, $find[$i][$keyToSearch]);
                    $this->$nameTable = $read;
                }
                return;
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