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
        //Mengambil seluruh data tryout
        $tryouts = Tryout::find();
        $subtests = Subtest::find();
        $soals = Soal::find();

        //Mengubah data object menjadi array
        $tryouts = json_decode(json_encode($tryouts),true);
        $subtests = json_decode(json_encode($subtests),true);
        $soals = json_decode(json_encode($soals),true);

        //Inisiasi variabel array kosong
        $resp = [];  //Menampung object tryout
        $sub = [];  //Menampung object subtest berdasarkan idtryout
        $que = [];  //Menampung object soal berdasarkan idtryout dan idsubtest
        $hidden_key = [];


        foreach ($tryouts as $tryout){
            foreach ($subtests as $subtest){
                foreach($soals as $soal){
                    if ($soal["subtest_idsubtest"] == $subtest["idsubtest"] AND $soal["subtest_tryout_idtryout"] == $tryout["idtryout"]){
                        $hidden_key += array(
                            'no' => $soal['no'], 
                            "subtest_idsubtest" => $soal["subtest_idsubtest"], 
                            "subtest_tryout_idtryout" => $soal["subtest_tryout_idtryout"], 
                            "question" => $soal["question"], 
                            "option_a" => $soal["option_a"], 
                            "option_b" => $soal["option_b"],
                            "option_c" => $soal["option_c"],
                            "option_d" => $soal["option_d"],
                            "option_e" => $soal["option_e"]);
                        array_push($que, $hidden_key);    //Mengisi soal berdasarkan idtryot dan idsubtest
                    }
                    $hidden_key = [];

                }
                $subtest += array('soal'=>$que);    //Menambahkan property soal ke object subtest
                $que = [];
                if($subtest["tryout_idtryout"] == $tryout["idtryout"]){
                    array_push($sub,$subtest);  //Mengisi subtest berdasarkan idtryout
                }
            }
            $tryout += array('subtest'=>$sub);
            array_push($resp,$tryout);   //Menambahkan property subtest ke object tryout
            $sub = [];          
        };
        $this->response->setJsonContent($resp);
        return $this->response->setJsonContent($resp);   //Mengembalikan data berupa json
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
        $subtests = Subtest::find([
            'conditions' => 'tryout_idtryout=:idtryout:',
            'bind' => $conditions,
        ]);

        //Mengambil data soal berdasarkan idtryout dari model Soal.php
        $soals = Soal::find([
            'conditions' => 'subtest_tryout_idtryout=:idtryout:',
            'bind' => $conditions,
        ]);
        
        //Mengubah object menjadi array
        $tryout = json_decode(json_encode($tryout),true);
        $subtests = json_decode(json_encode($subtests),true);
        $soals = json_decode(json_encode($soals),true);

        //Inisiasi variabel penampung
        $que = [];
        $sub = [];
        $hidden_key = [];
        
        foreach ($subtests as $subtest){
            foreach($soals as $soal){
                if ($soal["subtest_idsubtest"] == $subtest["idsubtest"]){
                    $hidden_key += array(
                        'no' => $soal['no'], 
                        "subtest_idsubtest" => $soal["subtest_idsubtest"], 
                        "subtest_tryout_idtryout" => $soal["subtest_tryout_idtryout"], 
                        "question" => $soal["question"], 
                        "option_a" => $soal["option_a"], 
                        "option_b" => $soal["option_b"],
                        "option_c" => $soal["option_c"],
                        "option_d" => $soal["option_d"],
                        "option_e" => $soal["option_e"]);
                    array_push($que, $hidden_key);    //Mengisi soal berdasarkan idsubtest
                }
                $hidden_key = [];
            }
            $subtest += array('soal'=>$que);    //Menambahkan property soal ke object subtest
            $que = [];
            array_push($sub,$subtest);  //Mengisi subtest berdasarkan idsubtest
        }
        $tryout += array("subtest" => $sub); //Menambahkan property subtest ke object tryout
        $this->response->setJsonContent($tryout);
        return $this->response->setJsonContent($tryout);
    }

}