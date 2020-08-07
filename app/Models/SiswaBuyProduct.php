<?php

class SiswaBuyProduct extends \Phalcon\Mvc\Model
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
    public $proof_of_pyment1;

    /**
     *
     * @var string
     */
    public $proof_of_payment2;

    /**
     *
     * @var string
     */
    public $proof_of_payment3;

    /**
     *
     * @var string
     */
    public $proof_of_payment4;

    /**
     *
     * @var string
     */
    public $proof_of_payment5;

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
        $this->setSource("siswa_buy_product");
        $this->belongsTo('iduser', 'Siswa', 'iduser', ['alias' => 'Siswa']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'siswa_buy_product';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SiswaBuyProduct[]|SiswaBuyProduct|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SiswaBuyProduct|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
