<?php
namespace App\Models;

class Soal extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $no;

    /**
     *
     * @var integer
     */
    public $subtest_idsubtest;

    /**
     *
     * @var integer
     */
    public $subtest_tryout_idtryout;

    /**
     *
     * @var string
     */
    public $question;

    /**
     *
     * @var string
     */
    public $option_a;

    /**
     *
     * @var string
     */
    public $option_b;

    /**
     *
     * @var string
     */
    public $option_c;

    /**
     *
     * @var string
     */
    public $option_d;

    /**
     *
     * @var string
     */
    public $option_e;

    /**
     *
     * @var string
     */
    public $key;

    /**
     *
     * @var string
     */
    public $solution;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema('pateron');
        $this->setSource("soal");

        $this->belongsTo('subtest_idsubtest', 'Subtest', 'idsubtest', ['alias' => 'Subtest']);
        $this->belongsTo('subtest_tryout_idtryout', Tryout::class, 'idtryout', ['alias' => 'tryout']);
        
        $this->hasMany('no', 'App\Models\SiswaHasSoal', 'soal_no', ['alias' => 'SiswaHasSoal']);
        $this->belongsTo('subtest_idsubtest', 'Subtest', 'idsubtest', ['alias' => 'Subtest']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'soal';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Soal[]|Soal|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Soal|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
