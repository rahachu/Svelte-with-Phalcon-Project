<?php
declare(strict_types=1);

namespace App\Controllers;

Use App\Models\Tryout;
Use App\Models\Subtest;
Use App\Models\Soal;
Use App\Library\Exception;
use Phalcon\Mvc\Controller;

class TryoutController extends Controller
{

    public function getAllAction()
    {
        $tryout = Tryout::find(); //Mengambil seluruh data tryout dari model Tryout.php
        $subtest = Subtest::find(); //Mengambil seluruh data subtest dari model Subtest.php
        $soal = Soal::find();   //Mengambil seluruh data soal dari model Soal.php
        $tryout = [$tryout, $subtest, $soal];
        return json_encode($tryout);    //Mengembalikan data berupa json
    }

    public function getbyidAction($idtryout)
    {
        $conditions = ['idtryout'=>$idtryout];

        //Mengambil data tryout berdasarkan idtryout dari model Tryout.php
        $tryout = Tryout::findFirst([
            'conditions' => 'idtryout=:idtryout:',
            'bind' => $conditions,
        ]);

        //Mengambil data subtest berdasarkan idtryout dari model Subtest.php
        $subtest = Subtest::find([
            'conditions' => 'tryout_idtryout=:idtryout:',
            'bind' => $conditions,
        ]);

        //Mengambil data soal berdasarkan idtryout dari model Soal.php
        $soal = Soal::find([
            'conditions' => 'subtest_tryout_idtryout=:idtryout:',
            'bind' => $conditions,
        ]);
        
        $tryout = [$tryout,$subtest,$soal];

        return json_encode($tryout);
    }

}