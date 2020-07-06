<?php

namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Security;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class User extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $iduser;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $token;

    /**
     *
     * @var string
     */
    public $email_verified_at;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add('email', new Uniqueness([
            "message" => "Email telah terdaftar",
        ]));

        $validator->add('username', new Uniqueness([
            "message" => "Username telah terdaftar",
        ]));

        return $this->validate($validator);
    }

    public function beforeCreate()
    {
        
        $this->token = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24)));
    }

    public function afterCreate()
    {
        // Setelah model dibuat ngapain??
        $this->getDi()->getMail()->send([$this->email=>$this->username], 
            "Konfirmasi email anda, Pateron Academy", 'confirmation', [
            'confirmUrl' => '/confirm/' . $this->token . '/' . $this->username,
        ]);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("pateron");
        $this->setSource("user");
        $this->hasMany('iduser', 'App\Models\Mentor', 'iduser', ['alias' => 'Mentor']);
        $this->hasMany('iduser', 'App\Models\Siswa', 'iduser', ['alias' => 'Siswa']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return User[]|User|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return User|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
