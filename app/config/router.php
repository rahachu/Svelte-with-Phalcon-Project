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
$router->addPost('/tryout/siswa/answer', 'tryout::saveSiswaAnswer');
$router->add('/tryout/siswa/listanswer/{siswa_iduser}/{soal_subtest_tryout_idtryout}/{soal_subtest_idsubtest}', 'tryout::getSiswaAnswer');
$router->notFound(
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);
$router->handle($_SERVER['REQUEST_URI']);

return $router;