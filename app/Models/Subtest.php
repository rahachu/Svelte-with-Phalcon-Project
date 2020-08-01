<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class Subtest extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idsubtest;

    /**
     *
     * @var integer
     */
    public $tryout_idtryout;

    /**
     *
     * @var string
     */
    public $judul;

    /**
     *
     * @var integer
     */
    public $time_in_minute;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("pateron");
        $this->setSource("subtest");
        $this->hasMany('idsubtest', 'Soal', 'subtest_idsubtest', ['alias' => 'Soal']);
        $this->belongsTo('tryout_idtryout', 'Tryout', 'idtryout', ['alias' => 'Tryout']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'subtest';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Subtest[]|Subtest|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Subtest|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
