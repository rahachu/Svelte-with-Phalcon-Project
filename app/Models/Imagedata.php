<?php
namespace App\Models;

class Imagedata extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idimage;

    /**
     *
     * @var string
     */
    public $data;

    /**
     *
     * @var integer
     */
    public $buktipembayaran_idsiswa_buy_product;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("pateron");
        $this->setSource("imagedata");
        $this->belongsTo('buktipembayaran_idsiswa_buy_product', 'App\Models\Buktipembayaran', 'idsiswa_buy_product', ['alias' => 'buktipembayaran']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'imagedata';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Imagedata[]|Imagedata|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Imagedata|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
