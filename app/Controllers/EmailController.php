<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;

class EmailController extends ControllerBase
{
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
        
        if ($user) {
            $user->email_verified_at = new \Phalcon\Db\RawValue('CURRENT_TIMESTAMP()');
            $user->token = null;
            $user->save();
        }

        $this->response->redirect('/dashboard');

    }
}
