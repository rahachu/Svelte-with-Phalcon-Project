<?php
declare(strict_types=1);

namespace App\Controllers;

Use App\Models\User;
Use App\Models\Siswa;
Use App\Library\Exception;
use Phalcon\Mvc\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return json_encode(["Key" => $this->security->getTokenKey(),
        "Value" => $this->security->getToken()]);
    }

    public function loginAction()
    {
        if ($this->request->isPost()) {
            if ($this->security->checkToken() || !$this->config->secureCsrf) {
                return $this->auth->check($this->request->getPost());
            }
            else {
                throw new Exception("Token tidak valid");
            }
        }
    }

    public function authAction()
    {
        return $this->response->setJsonContent($this->auth->getUser());
    }

    public function logoutAction()
    {
        $this->auth->logout();
        $this->response->setStatusCode(200,"Keluar");
        return $this->response->redirect('/')->send();
    }

    public function registerAction()
    {
        if ($this->request->isPost()) {
            if ($this->security->checkToken() || !$this->config->secureCsrf) {
                $user = new User([
                    'email'=>$this->request->getPost('email'),
                    'username'=>$this->request->getPost('username'),
                    'password'=>$this->security->hash($this->request->getPost('password'))
                ]);
                $siswa = new Siswa($this->request->getPost());
                $user->siswa = $siswa;
                if ($user->save()) {
                    $this->response->setStatusCode(201,'Berhasil daftar');
                    $this->response->setContent("Jangan lupa verifikasi email");
                    return $this->response->send();
                }
                else {
                    $this->response->setStatusCode(403,"Forbidden");
                    $this->response->setJsonContent([
                        'csrfKey'=>$this->security->getTokenKey(),
                        'csrfToken'=>$this->security->getToken(),
                        'error'=>$user->getMessages()
                    ]);
                    return $this->response->send(); 
                }
            }
            else {
                throw new Exception("Token tidak valid");
            }
        }
    }

    public function ConfirmAction($code,$username)
    {
        //Konfirmasi email
        $user = User::findFirst([
            'conditions'=>'token=:code: AND username = :username:',
            'bind' => [
                'code'=>$code,
                'username'=>$username
            ]
        ]);
        
        if ($user and $user->email_verified_at === null) {
            $user->email_verified_at = new \Phalcon\Db\RawValue('CURRENT_TIMESTAMP()');
            $user->token = null;
            $user->save();
        }

        $this->response->redirect('/dashboard');

    }

    public function ResetAction($token,$username)
    {
        if ($this->request->isPost()) {
            $user = User::findFirst([
                'conditions'=>'token=:token: AND username=:username:',
                'bind'=>[
                    'token'=>$token,
                    'username'=>$username
                ]
            ]);

            if ($user) {
                $newPassword = $this->request->getPost('newPassword');
                $user->password = $this->security->hash($newPassword);
                $user->save();
            }
        }
    }
}

