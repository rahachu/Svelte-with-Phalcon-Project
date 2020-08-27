<?php
namespace App\Models;
class SiswaHasSubtest extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idsiswa_has_tryout;

    /**
     *
     * @var integer
     */
    public $idsubtest;

    /**
     *
     * @var integer
     */
    public $idsiswa;

    /**
     *
     * @var string
     */
    public $result;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("pateron");
        $this->setSource("siswa_has_subtest");
        $this->belongsTo('idsiswa_has_tryout', 'SiswaHasTryout', 'tryout_idtryout', ['alias' => 'SiswaHasTryout']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'siswa_has_subtest';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SiswaHasSubtest[]|SiswaHasSubtest|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SiswaHasSubtest|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
