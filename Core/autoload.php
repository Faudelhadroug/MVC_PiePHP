<?php

spl_autoload_register('autoLoad');

function autoLoad($class)
{   
    $class = substr(substr($class, strpos($class, '\\')), 1); // Pour récuperer seulement le nom du fichier sans namespace
    $classpath = $class.'.php';
    $arrayPath = [
        'Core',
        'src/Model',
        'src/Controller',
        'src/View',
    ];
    for ($i=0; $i < count($arrayPath); $i++) 
    { 
        if (file_exists($arrayPath[$i].DIRECTORY_SEPARATOR.$classpath))
        { 
            $classpath = $arrayPath[$i].DIRECTORY_SEPARATOR.$classpath;
            include $classpath;
            return;
        }
    }

}