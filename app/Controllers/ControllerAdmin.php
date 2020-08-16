<?php
declare(strict_types=1);

// Controller ini sebagai parent dari controller
// segala action yang hanya boleh dilakukan oleh admin

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class ControllerAdmin extends Controller
{
    public function initialize()
    {
        $user = $this->auth->getUser();
        if (!$user['login'] || !$this->auth->isAdmin()) {
            $this->response->setStatusCode(404,"Halaman tidak ditemukan");
            $this->response->setJsonContent(["error"=>"Something wrong"]);
            $this->response->send();
        }
    }
}
