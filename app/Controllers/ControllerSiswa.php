<?php
declare(strict_types=1);

// Controller ini sebagai parent dari controller
// segala action yang hanya boleh dilakukan oleh siswa

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class ControllerSiswa extends Controller
{
    public function initialize()
    {
        // $user = $this->auth->getUser();
        // if (!$user->siswa) {
        //     $this->response->redirect('/dashboard');
        // }
    }
}
