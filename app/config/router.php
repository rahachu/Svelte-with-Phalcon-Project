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

$router->add('/tryout/data','tryout::getAll'); //untuk keamanan dimatikan yaa
$router->add('/tryout/data/{idtryout}','tryout::getbyid');
$router->addPost('/tryout/siswa/answer', 'tryout::saveSiswaAnswer');
$router->add('/tryout/siswa/listanswer/{siswa_iduser}/{soal_subtest_tryout_idtryout}/{soal_subtest_idsubtest}', 'tryout::getSiswaAnswer');

// API Dashboard siswa
$router->addGet('/dashboard/list',['controller' => 'dashboardSiswa', 'action'=>'dashboardSiswa']);
$router->addGet('/dashboard/tryoutsaya',['controller'=>'dashboardSiswa','action'=>'getSiswaHasTryout']);
$router->addGet('/siswa/mytryout/{idtryout}',['controller'=>'dashboardSiswa','action'=>'getScore']);

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

//Admin Tryout API
$router->addGet('/admin/daftartryout',['controller'=>'adminTryout','action'=>'getListTryout']);
$router->addGet('/admin/daftartryout/formal/{idtryout}/\?page=([a-zA-Z0-9\_\-]+)',['controller'=>'adminTryout','action'=>'formalScoreSiswa']);
$router->addGet('/admin/daftartryout/irt/{idtryout}/\?page=([a-zA-Z0-9\_\-]+)',['controller'=>'adminTryout','action'=>'irtScoreSiswa']);
$router->addPost('/admin/daftartryout/postscoreformal/{idtryout}',['controller'=>'adminTryout','action'=>'postFormalScore']);
$router->addPost('/admin/daftartryout/postscoreirt/{idtryout}',['controller'=>'adminTryout','action'=>'postIrtScore']);
$router->addPost('/admin/tryout/{idtryout}',['controller'=>'adminTryout','action'=>'postResponseValue']);
$router->add('/admin/tryout/{idtryout}/{idsubtest}',['controller'=>'adminTryout','action'=>'countResponseValue']);

//Assesment API
$router->addGet('/siswa/mytryout/{idtryout}',['controller'=>'assesment','action'=>'getScore']);
//Default route pass to svelte
$router->notFound(
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);
$router->handle($_SERVER['REQUEST_URI']);

return $router;