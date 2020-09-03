<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\SiswaHasSoal;
use App\Models\Soal;
use App\Models\SiswaHasSubtest;
use App\Models\Subtest;

class AssesmentController extends ControllerSiswa
{
    private function countScore($result){
        $score = 0;
        foreach($result as $rslt){
            $score += $rslt;
        }
        return $score;
    }
    private function formalScore($idtryout,$idsubtest){
        $exsist = SiswaHasSubtest::findFirst([
            'conditions'=>'idsiswa_has_tryout = :idtryout: AND idsubtest = :idsubtest: AND idsiswa = :idsiswa:',
            'bind'=>[
                'idtryout' => $idtryout,
                'idsubtest'=>$idsubtest,
                'idsiswa'=>1 #$this->getUser()['id']
            ]
        ]);
        if($exsist){ //berarti udah ada di db
            $this->response->setStatusCode(200,'OK');
            return json_decode($exsist->result);
        }else{ // belom ada didb
            $answerKey = Soal::find([
                'conditions'=> 'subtest_idsubtest = :idsubtest: AND subtest_tryout_idtryout = :idtryout:',
                'bind' => [
                    'idsubtest'=>$idsubtest,
                    'idtryout'=>$idtryout
                ],
                'columns'=>'no,key'
            ]);
            $answer = SiswaHasSoal::find([
                'conditions' => 'siswa_iduser = :idsiswa: AND soal_subtest_idsubtest = :idsubtest: AND soal_subtest_tryout_idtryout = :idtryout:',
                'bind'=>[
                    'idsiswa' => 1,#$this->getUser()['id]
                    'idsubtest'=>$idsubtest,
                    'idtryout'=>$idtryout
                ],
                'columns' => 'soal_no,answer'
            ]);
            $result = array();
            foreach ($answer as $ans){
                foreach($answerKey as $key){
                    if($ans->soal_no == $key->no){
                        if($ans->answer == null){
                            $result[$ans->soal_no] = 0;
                        }else{
                            if($ans->answer == $key->key){
                                $result[$ans->soal_no]=4;
                            }else{
                                $result[$ans->soal_no]=-1;
                            }
                        }
                    }
                }
            }
            $saveResult = new SiswaHasSubtest();
            $saveResult->idsiswa_has_tryout = $idtryout;
            $saveResult->idsiswa = 1; #$this->getUser()['id'];
            $saveResult->idsubtest = $idsubtest;
            $saveResult->result = json_encode($result);
            if($saveResult->save()){
                $this->response->setStatusCode(201,'Created');
            }else{
                $this->response->setStatusCode(404,'Confilct');
            }
            return $result;
        }
    }
    private function responseScore($idsubtest,$idtryout,$answerKey,$answer){
        $score = 0;
        foreach($answer as $ans){
            foreach($answerKey as $skey){
                if($ans->soal_no == $skey->no){
                    if($ans->answer == $skey->key){
                        $score += $skey->response_value;
                    }
                }
            }
        }
        $this->response->setStatusCode(200,'OK');
        return $score;
        
    }
    private function cekExsist($idtryout){
        $cek = Soal::find([
            'conditions' => 'subtest_tryout_idtryout = :idtryout: AND response_value IS NOT NULL',
            'bind'=>[
                'idtryout' =>$idtryout
            ]
        ]);
        return count($cek) > 1;
    }
    public function getScoreAction($idtryout){
        $subtests = Subtest::find([
            'conditions'=>'tryout_idtryout = :idtryout:',
            'bind' =>[
                'idtryout'=>$idtryout
            ],
            'columns' => 'idsubtest,judul'
        ]);
        $result = array(
            'tipePenilaian' =>'',
            'scoreSubtest'=>array()
        );
        if(!$this->cekExsist($idtryout)){
            $result['tipePenilaian'] ='Pembobotan Nilai';
            foreach($subtests as $subtest){
                array_push($result['scoreSubtest'],array(
                    'judul' => $subtest->judul,
                    'score' => $this->countScore($this->formalScore($idtryout,$subtest->idsubtest))
                ));
            }
        }else{
            $result['tipePenilaian'] ='Response Nilai';
            foreach($subtests as $subtest){
                array_push($result['scoreSubtest'],array(
                    'judul' => $subtest->judul,
                    'score' =>  $this->responseScore($idtryout, $subtest->idsubtest,Soal::find([
                        'conditions'=> 'subtest_idsubtest = :idsubtest: AND subtest_tryout_idtryout = :idtryout:',
                        'bind' => [
                            'idsubtest'=>$subtest->idsubtest,
                            'idtryout'=>$idtryout
                        ]
                    ]),$answer = SiswaHasSoal::find([
                        'conditions' => 'siswa_iduser = :idsiswa: AND soal_subtest_idsubtest = :idsubtest: AND soal_subtest_tryout_idtryout = :idtryout:',
                        'bind'=>[
                            'idsiswa' => 1,#$this->getUser()['id]
                            'idsubtest'=>$subtest->idsubtest,
                            'idtryout'=>$idtryout
                        ]
                    ]))
                ));
            }
        }
        $this->response->setJsonContent($result);
        return !$this->response->isSent() && $this->response->send();
        
    }

}

