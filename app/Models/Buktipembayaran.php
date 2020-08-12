<?php

class Buktipembayaran extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idsiswa_buy_product;

    /**
     *
     * @var integer
     */
    public $iduser;

    /**
     *
     * @var integer
     */
    public $idproduct;

    /**
     *
     * @var string
     */
    public $buy_time;

    /**
     *
     * @var string
     */
    public $pyment_method;

    /**
     *
     * @var string
     */
    public $data;

    /**
     *
     * @var integer
     */
    public $validation;

    /**
     *
     * @var integer
     */
    public $idadmin;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("pateron");
        $this->setSource("buktipembayaran");
        $this->belongsTo('iduser', 'Siswa', 'iduser', ['alias' => 'Siswa']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'buktipembayaran';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Buktipembayaran[]|Buktipembayaran|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Buktipembayaran|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
