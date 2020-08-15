<?php
namespace App\Models;

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
     * @var string
     */
    public $productname;

    /**
     *
     * @var string
     */
    public $buy_time;

    /**
     *
     * @var integer
     */
    public $validation;

    /**
     *
     * @var string
     */
    public $admin;

    /**
     *
     * @var string
     */
    public $payment_method;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("pateron");
        $this->setSource("buktipembayaran");
        $this->hasMany('idsiswa_buy_product', 'App\Models\Imagedata', 'buktipembayaran_idsiswa_buy_product', ['alias' => 'imagedata']);
        $this->belongsTo('payment_method', 'App\Models\PaymentMethod', 'type_payment_method', ['alias' => 'PaymentMethod']);
        $this->belongsTo('iduser', 'App\Models\Siswa', 'iduser', ['alias' => 'Siswa']);
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
