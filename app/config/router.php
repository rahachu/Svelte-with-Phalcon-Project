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
$router->addPost('/tryout/create',['controller'=>'tryout','action'=>'createTryout']);
$router->addPost('/tryout/save',['controller'=>'tryout','action'=>'saveQuestion']);
$router->add('/tryout/datalist',['controller'=>'tryout','action'=>'tryoutList']);
$router->add('/tryout/fulldata',['controller'=>'tryout','action'=>'fulldata']);
$router->notFound(
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);
$router->handle($_SERVER['REQUEST_URI']);

return $router;