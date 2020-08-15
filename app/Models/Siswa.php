<?php
namespace App\Models;
class Siswa extends \Phalcon\Mvc\Model
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
    public $fullname;

    /**
     *
     * @var string
     */
    public $school;

    /**
     *
     * @var string
     */
    public $city;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("pateron");
        $this->setSource("siswa");
        $this->hasMany('iduser', 'App\Models\Buktipembayaran', 'iduser', ['alias' => 'Buktipembayaran']);
        $this->hasMany('iduser', 'App\Models\SiswaHasSoal', 'siswa_iduser', ['alias' => 'SiswaHasSoal']);
        $this->hasMany('iduser', 'App\Models\SiswaHasTryout', 'siswa_iduser', ['alias' => 'SiswaHasTryout']);
        $this->belongsTo('iduser', 'App\Models\User', 'iduser', ['alias' => 'User']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'siswa';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Siswa[]|Siswa|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Siswa|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
