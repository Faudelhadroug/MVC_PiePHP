<?php

spl_autoload_register('autoLoad');

function autoLoad($class)
{   

    $namespace = substr((substr($class, 0, -strpos(strrev($class), '\\'))), 0, -1);
    $class = substr(substr($class, strpos($class, '\\')), 1); // Pour récuperer seulement le nom du fichier sans namespace
    $classpath = $class.'.php';
    $arrayPath = 
    [
        'Core',
        'src',
        'src/Model',
        'src/Controller',
    ];
    for ($i=0; $i < count($arrayPath); $i++) 
    { 
        if (file_exists($arrayPath[$i].DIRECTORY_SEPARATOR.$classpath))
        { 
            $classpath = $arrayPath[$i].DIRECTORY_SEPARATOR.$classpath;
            require_once $classpath;
            return;
        }
    }

}