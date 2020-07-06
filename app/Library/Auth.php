<?php
declare(strict_types=1);

/**
 * Kelas ini untuk sistem authentication user
 * sehingga pengguna aplikasi dapat terkendali
 * merupakan shared service pada Phalcon Framework
 */

 namespace App\Library;

Use Phalcon\Di\Injectable;
Use App\Models\User;

class Auth extends Injectable
{
    public function check($dataLogin){
        if ($this->session->get('auth-identity')) {
            return $this->response->redirect('/dashboard')->send();
        }
        
        $user = User::findFirst(
            [
                'conditions' => 'email = :login: OR username = :login:',
                'bind'       => [
                    'login' => $dataLogin["login"],
                ],
            ]
        );

        $contentResponse = [
            'csrfKey'=>$this->security->getTokenKey(),
            'csrfToken'=>$this->security->getToken(),
            'userData' => $this->getUser()
        ];

        if (null !== $user) {
            $check = $this
                ->security
                ->checkHash($dataLogin['password'], $user->password);

            if (true === $check) {
                if ($user->token==null) {
                    $this->session->set('auth-identity', [
                        'id'      => $user->iduser,
                        'name'    => $user->username,
                    ]);
                }
                else {
                    $contentResponse['error']="Email belum terkonfirmasi";
                }
                $this->response->setStatusCode(200,"login berhasil");
                $this->response->setJsonContent($contentResponse);
                return $this->response->send();
            }
        } else {
            $this->security->hash((string)rand());
        }

        $contentResponse['error']="Kombinasi login dan password salah";

        $this->response->setStatusCode(404,"Forbidden");
        $this->response->setJsonContent($contentResponse);
        return $this->response->send();
        
    }

    public function getUser(){
        $identity = $this->session->get('auth-identity');

        if ($identity!=null) {
            $user = User::findFirst($identity["id"]);

            if ($user) {
                return ['id'=>$user->iduser,
                'username'=>$user->username,
                'siswa'=>$user->siswa,
                'mentor'=>$user->mentor,
                'login'=>true
                ];
            }
        }
        return ['login'=>false];
    }

    public function logout()
    {
        $this->session->remove('auth-identity');
    }

    public function isSiswa():bool
    {
        $user = getUser();
        return count($user->siswa)!==0;
    }

    public function isMentor():bool
    {
        $user = getUser();
        return count($user->mentor)!==0;
    }

    public function isAdmin():bool{
        return !isSiswa() && !isMentor();
    }
}
