<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Tryout;
use App\Models\SiswaHasTryout;
use App\Models\Siswa;
use App\Models\SiswaHasSoal;
use App\Models\Soal;
use App\Models\SiswaHasSubtest;
use App\Models\Subtest;

class DashboardSiswaController extends ControllerSiswa
{

    private function getListProduct()
    {
        $idsiswa = $this->auth->getUser()['id'];
        $siswaTryout = array_map(function($v) {
            return $v['tryout_idtryout'];
        }, SiswaHasTryout::find(['conditions' => 'siswa_iduser = :idsiswa:',
            'bind' => ['idsiswa'=>$idsiswa],
            "hydration" => \Phalcon\Mvc\Model\Resultset::HYDRATE_OBJECTS])->toArray());
        $strSiswaTryout = implode(',',$siswaTryout);
        $tryout = Tryout::find([
            'conditions' => 'idtryout NOT IN (:strSiswaTryout:) AND publish_time IS NOT NULL',
            'bind' => ['strSiswaTryout'=>$strSiswaTryout],
        ]);

        return $tryout;
    }

    private function getProfileSiswa()
    {
        $idsiswa = $this->auth->getUser()['id'] || 1;
        $dataSiswa = Siswa::find(['conditions' => 'iduser = :idsiswa:',
                                'bind'=>['idsiswa'=>$idsiswa]]);
        return $dataSiswa;
    }
    private function getDataNiai()
    {
        return null;
    }
    public function dashboardSiswaAction()
    {
        if ($this->response->isSent()) {
            return $this->response;
        }
        $dataDashboard = [
            'product' => $this->getListProduct(),
        ];
        $this->response->setStatusCode(200,'OK');
        $this->response->setJsonContent($dataDashboard);
        return $this->response->send();
    }
    public function getSiswaHasTryoutAction(){
        if ($this->response->isSent()) {
            return $this->response;
        }
        $idsiswa =$this->auth->getUser()['id'];
        $tryoutSiswa = SiswaHasTryout::find([
            'conditions' => 'siswa_iduser = :idsiswa:',
            'bind' =>[
                'idsiswa' => $idsiswa
            ]
        ]);
        $data = array();
        foreach($tryoutSiswa as $tryouts){
            $to = $tryouts->tryout->toArray();
            $shs = SiswaHasSoal::find([
                'conditions' => 'siswa_iduser = :idsiswa: AND soal_subtest_tryout_idtryout = :idtryout:',
                'bind' =>[
                    'idsiswa' => $idsiswa,
                    'idtryout' => $to['idtryout']
                ]
            ]);
            $to['worked']=count($shs)!==0;
            array_push($data,$to);
        }
        $this->response->setJsonContent($data);
        $this->response->setStatusCode(200,'OK');
        return $this->response->send();
    }

    //scoring
    private function countScore($result){
        $score = 0;
        foreach($result as $key=>$rslt){
            if ($key!=='benar' && $key!=='salah' && $key!=='jumlahSoal') {
                $score += $rslt;
            }
        }
        return $score;
    }
    private function formalScore($idtryout,$idsubtest){
        $exsist = SiswaHasSubtest::findFirst([
            'conditions'=>'idsiswa_has_tryout = :idtryout: AND idsubtest = :idsubtest: AND idsiswa = :idsiswa:',
            'bind'=>[
                'idtryout' => $idtryout,
                'idsubtest'=>$idsubtest,
                'idsiswa'=>$this->auth->getUser()['id']
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
                    'idsiswa' => $this->auth->getUser()['id'],
                    'idsubtest'=>$idsubtest,
                    'idtryout'=>$idtryout
                ],
                'columns' => 'soal_no,answer'
            ]);
            $result = array();
            $benar = 0;
            $salah = 0;
            foreach ($answer as $ans){
                foreach($answerKey as $key){
                    if($ans->soal_no == $key->no){
                        if($ans->answer == null){
                            $result[$ans->soal_no] = 0;
                        }else{
                            if($ans->answer == $key->key){
                                $result[$ans->soal_no]=4;
                                $benar++;
                            }else{
                                $result[$ans->soal_no]=-1;
                                $salah++;
                            }
                        }
                    }
                }
            }
            $result['benar']=$benar;
            $result['salah']=$salah;
            $result['jumlahSoal']=count($answerKey);
            $saveResult = new SiswaHasSubtest();
            $saveResult->idsiswa_has_tryout = $idtryout;
            $saveResult->idsiswa = $this->auth->getUser()['id'];
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
    public function getScoreAction($idtryout){
        if ($this->response->isSent()) {
            return $this->response;
        }
        $subtests = Subtest::find([
            'conditions'=>'tryout_idtryout = :idtryout:',
            'bind' =>[
                'idtryout'=>$idtryout
            ],
            'columns' => 'idsubtest,judul'
        ]);
        $result = array();
        foreach($subtests as $subtest){
            $score = $this->formalScore($idtryout,$subtest->idsubtest);
            array_push($result,array(
                'judul' => $subtest->judul,
                'score' => $this->countScore($score),
                'benar' => $score->benar,
                'salah' => $score->salah,
                'jumlahSoal' => $score->jumlahSoal
            ));
        }
        $this->response->setJsonContent($result);
        return $this->response->send();
        
    }

}

