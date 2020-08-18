<?php

namespace App\Models;

class Tryout extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idtryout;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var integer
     */
    public $tryout_price;

    /**
     *
     * @var string
     */
    public $publish_time;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema($this->config->database->dbname);
        $this->setSource("tryout");
        $this->hasMany('idtryout', SiswaHasTryout::class, 'tryout_idtryout', ['alias' => 'SiswaHasTryout']);
        $this->hasMany('idtryout', Subtest::class, 'tryout_idtryout', ['alias' => 'subtest']);
        
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tryout';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Tryout[]|Tryout|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Tryout|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
