<?php
declare(strict_types=1);

// Controller ini sebagai parent dari controller
// segala action yang hanya boleh dilakukan oleh mentor

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class ControllerMentor extends Controller
{
    public function initialize()
    {
        $user = $this->auth->getUser();
        if (!$user['login'] || !$user->mentor) {
            $this->response->redirect('/dashboard');
        }
    }
}
