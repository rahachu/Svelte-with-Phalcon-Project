<?php

use Phalcon\Mvc\Router;

$router = new Router(false);

// Define your routes here
$router->setDi($di);
// $router->add('/','\index.html');
$router->addPost('/login',['controller'=>'dashboard','action'=>'login']);
$router->addPost('/register',['controller'=>'dashboard','action'=>'register']);
$router->add('/confirm/{code}/{username}',['controller'=>'email','action'=>'confirm']);
$router->add('/logout',"dashboard::logout");
$router->add('/auth','dashboard::auth');
$router->notFound(
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);
$router->handle($_SERVER['REQUEST_URI']);

return $router;