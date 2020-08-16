<?php
namespace App\Models;
class SiswaHasTryout extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $siswa_iduser;

    /**
     *
     * @var integer
     */
    public $tryout_idtryout;

    /**
     *
     * @var string
     */
    public $confirm_time;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema($this->config->database->dbname);
        $this->setSource("siswa_has_tryout");
        $this->belongsTo('siswa_iduser', 'App\Models\Siswa', 'iduser', ['alias' => 'Siswa']);
        $this->belongsTo('tryout_idtryout', 'App\Models\Tryout', 'idtryout', ['alias' => 'Tryout']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'siswa_has_tryout';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SiswaHasTryout[]|SiswaHasTryout|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SiswaHasTryout|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
