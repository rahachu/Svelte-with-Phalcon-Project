<?php
declare(strict_types=1);

namespace App\Controllers;

Use App\Models\User;
Use App\Models\Siswa;
Use App\Library\Exception;
use Phalcon\Http\Request\File;
use Phalcon\Mvc\Controller;
use Phalcon\Validation;

class UserController extends Controller
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
                $uploaded_image = $_FILES['photo'];
                $siswa_photo_name = null;
                $user = new User([
                    'email'=>$this->request->getPost('email'),
                    'username'=>$this->request->getPost('username'),
                    'password'=>$this->security->hash($this->request->getPost('password'))
                ]);
                $siswa = new Siswa([
                    'fullname' => $this->request->getPost('fullname'),
                    'school' => $this->request->getPost('school'),
                    'city' => $this->request->getPost('city'),
                    'phone' => $this->request->getPost('phone')
                ]);
                $user->siswa = $siswa;
                $user->save();
                if (empty($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
                    // jika foto tidak diupload
                    $siswa_photo_name = 'user.png';
                } else {
                    $imageFile = new File($uploaded_image);
                    $upload_dir = __DIR__.'/../../public/upload/';
                    if (!is_dir($upload_dir)) { // jika folder upload gaada
                        mkdir($upload_dir, 0755);
                    }
                    $siswa_photo_name = sprintf('siswa_profil_%d_%d.%s', $siswa->iduser, time(), $imageFile->getExtension());
                    $imageFile->moveTo($upload_dir.$siswa_photo_name);
                }

                $siswa->photo = $siswa_photo_name;

                if ($siswa->save()) {
                    $this->response->setStatusCode(201,'Berhasil daftar');
                    $this->response->setJsonContent([
                        'csrfKey'=>$this->security->getTokenKey(),
                        'csrfToken'=>$this->security->getToken(),
                        'message'=>"Jangan lupa verifikasi yaa..."
                    ]);
                    return $this->response->send();
                }
                else {
                    $error = [];
                    foreach ($user->getMessages() as $messages) {
                        $error[] = $messages->getMessage();
                    }
                    $this->response->setStatusCode(403,"Forbidden");
                    $this->response->setJsonContent([
                        'csrfKey'=>$this->security->getTokenKey(),
                        'csrfToken'=>$this->security->getToken(),
                        'error'=>$error
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

        $this->response->redirect('/accounts/login');

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

