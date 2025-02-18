<?php
namespace App\Models;

class PaymentMethod extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $type_payment_method;

    /**
     *
     * @var string
     */
    public $description;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema($this->config->database->dbname);
        $this->setSource("payment_method");
        $this->hasMany('type_payment_method', 'App\Models\Buktipembayaran', 'payment_method', ['alias' => 'Buktipembayaran']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'payment_method';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PaymentMethod[]|PaymentMethod|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PaymentMethod|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
