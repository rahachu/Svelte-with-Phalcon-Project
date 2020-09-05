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
        // redirect bakal dimatikan soalnya pake spa
        // if ($this->session->get('auth-identity')) {
        //     return $this->response->redirect('/dashboard')->send();
        // }
        
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
                    $contentResponse['userData']=$this->getUser();
                    $this->response->setStatusCode(200,"login berhasil");
                }
                else {
                    $contentResponse['error']="Email belum terkonfirmasi";
                    $this->response->setStatusCode(403,"Forbidden");
                }
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
        $identity = $this->session->get('auth-identity');

        if ($identity!=null) {
            $user = User::findFirst($identity["id"]);
            $siswa = $user->siswa;
            return count($siswa)!==0;
        }
        return false;
    }

    public function isMentor():bool
    {
        $identity = $this->session->get('auth-identity');

        if ($identity!=null) {
            $user = User::findFirst($identity["id"]);
            $mentor = $user->mentor;
            return count($mentor)!==0;
        }
        return false;
    }

    public function isAdmin():bool{
        $identity = $this->session->get('auth-identity');

        if ($identity!=null) {
            $user = User::findFirst($identity["id"]);
            $siswa = $user->siswa;
            $mentor = $user->mentor;
            return count($siswa)===count($mentor);
        }
        return false;
    }
}
