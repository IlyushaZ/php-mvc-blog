<?php

use Application\Core\Router;

spl_autoload_register(function($class){
    $path = str_replace('\\', '/', $class.'.php');
    if(file_exists($path)) {
        require $path;
    }
});

date_default_timezone_set('Europe/Moscow');

session_start();

$router = new Router();
$router->run();
