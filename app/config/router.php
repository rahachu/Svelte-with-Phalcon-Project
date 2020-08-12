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

$router->add('/tryout/data','tryout::getAll');
$router->add('/tryout/data/{idtryout}','tryout::getbyid');

$router->addPost('/tryout/create',['controller'=>'tryoutEditor','action'=>'createTryout']);
$router->addDelete('/tryout/create',['controller'=>'tryoutEditor','action'=>'deleteTryout']);
$router->addPost('/tryout/save',['controller'=>'tryoutEditor','action'=>'saveQuestion']);
$router->add('/tryout/datalist',['controller'=>'tryoutEditor','action'=>'tryoutList']);
$router->add('/tryout/fulldata/{idtryout}',['controller'=>'tryoutEditor','action'=>'fulldata']);
$router->addPost('/tryout/publish/{idtryout}',['controller'=>'tryoutEditor','action'=>'publish']);
$router->addPost('/tryout/unpublish/{idtryout}',['controller'=>'tryoutEditor','action'=>'unpublish']);

$router->notFound(
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);
$router->handle($_SERVER['REQUEST_URI']);

return $router;