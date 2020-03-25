<?php
echo '<pre>'.print_r($_POST).'</pre>';
echo '<pre>'.print_r($_GET).'</pre>';
echo '<pre>'.print_r($_SERVER).'</pre>';

define('BASE_URI', str_replace('\\', '/', substr (__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

$app = new Core\Core();
$app->run();


// echo "<br>";
// echo "<br>";
// echo $_SERVER['REQUEST_URI'];
// echo "<br>";
// echo '<br>';
// $baseLinkCount = strlen('/github/MVC_PiePHP/');
// $virginLink = ucfirst(substr($_SERVER['REQUEST_URI'], $baseLinkCount));
// $nbParamLink = substr_count($virginLink, '/');
// echo $virginLink;
// echo '<br>';
// if ($nbParamLink == 0)
// {
//     $controller = substr($virginLink, strpos($virginLink, '/'));
//     if ($controller == '')
//     {
//         $controller = 'App';
//     }
// }
// else
// {
//     $controller = substr($virginLink, 0, strpos($virginLink, '/'));
// }
// echo 'Controller = '.$controller;

// echo '<br>';
// echo strpos($virginLink, '/');
// echo '<br>';
// if ($nbParamLink <= 1)
// {

//     if($nbParamLink == 1)
//     {
//         $action = substr(substr($virginLink, strpos($virginLink, '/')), 1);
//         if ($action == '')
//         {
//             $action = 'index';
//         }
//     }
//     else
//     {
//         $action = 'index';
//     }
//     echo 'Action = '.$action;
// }
// echo '<br>';
// $controller = 'Controller\\'.$controller.'Controller';
// if (class_exists($controller))
// {
// 	$object = new $controller();
// }
// else
// {
//     echo '404';
// 	//throw new Exception('The class '. $controller .' does not exist.');
// }