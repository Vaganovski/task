<?php

spl_autoload_register(function($classname) {
    $folder = dirname(__DIR__);
    $file = $folder.'/'.str_replace('\\', '/', $classname).'.php';
    if (is_readable($file)) {
        require $file;
    }
});

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router(); 
        
$router->add('login', ['controller' => 'Users', 'action' => 'index']);
$router->add('auth', ['controller' => 'Users', 'action' => 'login']);
$router->add('logout', ['controller' => 'Users', 'action' => 'logout']);
$router->add('', ['controller' => 'Account', 'action' => 'index']);
$router->add('withdraw', ['controller' => 'Account', 'action' => 'withdraw']);

$router->dispatch($_SERVER['QUERY_STRING']);


