<?php

use Phalcon\Mvc\Router;

$router = new Router(false);

// Define your routes here
$router->setDi($di);
// $router->add('/','\index.html');
$router->addPost('/login',['controller'=>'user','action'=>'login']);
$router->addPost('/register',['controller'=>'user','action'=>'register']);
$router->add('/confirm/{code}/{username}',['controller'=>'user','action'=>'confirm']);
$router->addPost('/reset/{token}/{username}',['controller'=>'user','action'=>'reset']);
$router->add('/logout',"user::logout");
$router->add('/auth','user::auth');

// API Dashboard siswa
$router->addGet('/dashboard/{idsiswa}',['controller' => 'dashboardSiswa', 'action'=>'getListProduct']);

$router->notFound(
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);
$router->handle($_SERVER['REQUEST_URI']);

return $router;