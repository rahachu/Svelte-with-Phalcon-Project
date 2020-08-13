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
$router->addGet('/dashboard/list',['controller' => 'dashboardSiswa', 'action'=>'dashboardSiswa']);
$router->addGet('/dashboard/tryoutsaya',['controller'=>'dashboardSiswa','action'=>'getSiswaHasTryout']);

//Tryout editor API
$router->addPost('/tryout/create',['controller'=>'tryoutEditor','action'=>'createTryout']);
$router->addDelete('/tryout/create',['controller'=>'tryoutEditor','action'=>'deleteTryout']);
$router->addPost('/tryout/save',['controller'=>'tryoutEditor','action'=>'saveQuestion']);
$router->add('/tryout/datalist',['controller'=>'tryoutEditor','action'=>'tryoutList']);
$router->add('/tryout/fulldata/{idtryout}',['controller'=>'tryoutEditor','action'=>'fulldata']);
$router->addPost('/tryout/publish/{idtryout}',['controller'=>'tryoutEditor','action'=>'publish']);
$router->addPost('/tryout/unpublish/{idtryout}',['controller'=>'tryoutEditor','action'=>'unpublish']);

//Siswa Payment API 
$router->addPost('/dashboard/{idproduct}/{payment_method}',['controller' => 'siswaPayment', 'action'=>'postPayment']);
$router->addGet('/dashboard/payment/list',['controller'=>"siswaPayment", 'action'=>'getPaymentMethod']);
$router->addGet('/dashboard/product/data/{idproduct}',['controller'=>'siswaPayment','action'=>'product']);

//Admin Payment API
$router->addGet('/admin/validation/\?page=([a-zA-Z0-9\_\-]+)',['controller' => 'adminPayment','action'=> 'getListValidated']);
$router->addGet('/admin/unvalidation/\?page=([a-zA-Z0-9\_\-]+)',['controller' => 'adminPayment','action'=> 'getListUnvalidated']);
$router->addGet('/admin/data/image/{idimage}',['controller' => 'adminPayment','action' => 'Imagedata']);
$router->addPost('/admin/confirm/{idpembayaran}',['controller' => 'adminPayment','action'=> 'postValidation']);

//Default route pass to svelte
$router->notFound(
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);
$router->handle($_SERVER['REQUEST_URI']);

return $router;