<?php
echo '<pre>'.print_r($_POST).'</pre>';
echo '<pre>'.print_r($_GET).'</pre>';
echo '<pre>'.print_r($_SERVER).'</pre>';

define('BASE_URI', str_replace('\\', '/', substr (__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

$app = new Core\Core();
$app->run();