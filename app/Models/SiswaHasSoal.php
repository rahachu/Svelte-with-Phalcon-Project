<?php

class SiswaHasSoal extends \Phalcon\Mvc\Model
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
    public $soal_no;

    /**
     *
     * @var integer
     */
    public $soal_subtest_idsubtest;

    /**
     *
     * @var integer
     */
    public $soal_subtest_tryout_idtryout;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("pateron");
        $this->setSource("siswa_has_soal");
        $this->belongsTo('siswa_iduser', 'App\Models\Siswa', 'iduser', ['alias' => 'Siswa']);
        $this->belongsTo('soal_no', 'App\Models\Soal', 'no', ['alias' => 'Soal']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'siswa_has_soal';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SiswaHasSoal[]|SiswaHasSoal|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SiswaHasSoal|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
