<?php
declare(strict_types=1);

namespace App\Controllers;

Use App\Models\Tryout;
Use App\Models\Subtest;
Use App\Models\Soal;
use App\Models\SiswaHasTryout;
Use App\Models\SiswaHasSoal;
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
        if ($this->response->isSent()) {
            return $this->response;
        }
        $sht = SiswaHasTryout::find([
            'conditions' => 'tryout_idtryout=:idtryout:',
            'bind' => ['idtryout'=>$idtryout],
        ]);
        if (count($sht)==0) {
            $this->response->setJsonContent("Tryout tidak tersedia");
            return $this->response->setStatusCode(404,"Not found");
        }
        $conditions = ['idtryout'=>$idtryout];

        //memeriksa apakah siswa telah mengerjakan tryout
        $sha = SiswaHasSoal::find([
            'conditions' => 'soal_subtest_tryout_idtryout=:idtryout: AND siswa_iduser=:iduser:',
            'bind' => ['idtryout'=>$idtryout,'iduser'=>$this->auth->getUser()['id']],
        ]);
        if (count($sha)!==0){
            $this->response->setJsonContent("Tryout sudah dikerjakan");
            return $this->response->setStatusCode(404,"Not found");
        }

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
    
    public function saveSiswaAnswerAction (){
        if ($this->response->isSent()) {
            return $this->response;
        }
        $postData = json_decode($this->request->getRawBody());
        $answer = new SiswaHasSoal();
        $answer->siswa_iduser = $this->auth->getUser()['id'];
        $answer->soal_no = $postData->soal_no;
        $answer->answer = $postData->answer;
        $answer->soal_subtest_idsubtest = $postData->soal_subtest_idsubtest;
        $answer->soal_subtest_tryout_idtryout = $postData->soal_subtest_tryout_idtryout;

        if ($answer->save()) {
            $this->response->setStatusCode(201,"Saved");
        } else{
            $this->response->setStatusCode(409,"Conflict");
        }

        return $this->response->send();
    }

    public function getSiswaAnswerAction ($siswa_iduser, $soal_subtest_tryout_idtryout,$soal_subtest_idsubtest) {
        if ($this->response->isSent()) {
            return $this->response;
        }
        $conditions = ['siswa_iduser'=>$siswa_iduser, 'soal_subtest_idsubtest' => $soal_subtest_idsubtest, 'soal_subtest_tryout_idtryout'=>$soal_subtest_tryout_idtryout];

        $soal = SiswaHasSoal::find(
            ['conditions' => 'siswa_iduser=:siswa_iduser: AND soal_subtest_idsubtest=:soal_subtest_idsubtest: AND soal_subtest_tryout_idtryout=:soal_subtest_tryout_idtryout:',
            'bind' => $conditions,]
        );
        $this->response->setJsonContent($soal);
        return $this->response->setJsonContent($soal);
    }

}