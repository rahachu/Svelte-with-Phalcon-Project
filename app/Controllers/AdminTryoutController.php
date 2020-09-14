<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
Use App\Models\Tryout;
Use App\Models\Subtest;
Use App\Models\Soal;
use App\Models\SiswaHasTryout;
Use App\Models\SiswaHasSoal;
use Phalcon\Paginator\Adapter\NativeArray;

class AdminTryoutController extends ControllerAdmin
{
    public function countResponseValue($idtryout,$idsubtest){
        $soalKey = Soal::find([
            'conditions'=>'subtest_idsubtest = :idsubtest: AND subtest_tryout_idtryout = :idtryout:',
            'bind'=>[
                'idsubtest'=>$idsubtest,
                'idtryout' =>$idtryout
            ]
        ]);
        $result = array();
        $soalcek = [];
        foreach($soalKey as $key){
            $total = 0;
            $benar = 0;
            foreach($key->getSiswaHasSoal() as $siswaAnswer){
                if($siswaAnswer->soal_subtest_idsubtest == $key->subtest_idsubtest && $key->subtest_tryout_idtryout == $siswaAnswer->soal_subtest_tryout_idtryout){
                    if($siswaAnswer->answer != null && $key->key == $siswaAnswer->answer){
                        $benar+=1;
                    }
                    $total+=1;
                }
                $soalcek[$key->no] = [
                    'benar'=>$benar,
                    'total'=>$total
                ];
            }
            $bobot = 4 + (1-ceil(($benar == 0)?1:$benar/$total*4));
            array_push(
                $result,array(
                    'soal_no' => $key->no,
                    'bobot' => $bobot
                )
            );
        }
        return $result;
        // $this->response->setStatusCode(200,'OK');
        // $this->response->setJsonContent($result);
        // return !$this->response->isSent() && $this->response->send();
    }
    public function postResponseValueAction($idtryout){
        $subtests = Subtest::find([
            'conditions' => 'tryout_idtryout = :idtryout:',
            'bind' =>[
                'idtryout' => $idtryout
            ]
        ]);
        $error = array();
        $suc = true;
        foreach($subtests as $subtest){
            if($suc){
                $responseValue = $this->countResponseValue($idtryout,$subtest->idsubtest);
                foreach($responseValue as $value){
                    if($suc){
                        $soal = Soal::findFirst([
                            'conditions'=>'subtest_idsubtest = :idsubtest: AND subtest_tryout_idtryout = :idtryout: AND no = :soal_no: AND response_value IS NULL',
                            'bind'=>[
                                'idsubtest'=>$subtest->idsubtest,
                                'idtryout' =>$idtryout,
                                'soal_no' => $value['soal_no']
                            ]
                        ]);
                        if($soal){
                            $soal->response_value = $value['bobot'];
                            if(!$soal->save()){
                                $suc = false;
                            }
                        }
                    }else{
                        array_push($error,array(
                            'error' => 'error at push soal in subtest',
                            'soal' => $value->soal_no,
                            'loc' => $idsubtest
                        ));
                    }
                }
            }else{
                array_push($error,array(
                    'error' => 'error at push subtest',
                    'loc' => $idsubtest
                ));
            }
        }
        if($suc){
            $this->response->setStatusCode(200,'Created');
            $this->response->setJsonContent(array(
                'status' => 'anjay ngga ada eror',
                'pesan' => 'aman bos'
            ));   
        }else{
            $this->response->setStatusCode(402,'Conflict');
            $this->response->setJsonContent($error);
        }
        return !$this->response->isSent() && $this->response->send();

    }

    public function getListTryoutAction(){
        $tryouts = Tryout::find([
            'conditions' => 'publish_time IS NOT NULL'
        ]);
        $result = array();
        foreach($tryouts as $tryout){
            array_push($result,[
                'idtryout' => $tryout->idtryout,
                'name' =>$tryout->name
            ]);
        }
        $this->response->setStatusCode(200,'OK');
        $this->response->setJsonContent($result);
        return !$this->response->isSent() && $this->response->send();
    }
    public function formalScoreSiswaAction($idtryout){
        if($this->request->hasQuery('page')){
            $currentPage = $this->request->getQuery('page');
            $list = SiswaHasTryout::find([
                'conditions' =>'tryout_idtryout = :idtryout:',
                'bind' =>[
                    'idtryout' =>$idtryout
                ],
                'order' => 'formalscore DESC'
            ]);
            $daftar = array();
            foreach($list as $ls){
                array_push($daftar,[
                    'idsiswa' => $ls->siswa_iduser,
                    'nama' => $ls->siswa->fullname,
                    'sekolah'=> $ls->siswa->school,
                    'nilai' => $ls->formalscore
                ]);
            }
            $paginator = new NativeArray ([
                'data' => $daftar,
                'limit' => 100,
                'page' => $currentPage
            ]
            );
            $this->response->setStatusCode(200,'OK');
            $this->response->setJsonContent($paginator->paginate());
            return !$this->response->isSent() && $this->response->send();
        }
    }
    public function irtScoreSiswaAction($idtryout){
        if($this->request->hasQuery('page')){
            $currentPage = $this->request->getQuery('page');
            $list = SiswaHasTryout::find([
                'conditions' =>'tryout_idtryout = :idtryout:',
                'bind' =>[
                    'idtryout' =>$idtryout
                ],
                'order' => 'irtscore DESC'
            ]);
            $daftar = array();
            foreach($list as $ls){
                array_push($daftar,[
                    'idsiswa' => $ls->siswa_iduser,
                    'nama' => $ls->siswa->fullname,
                    'sekolah'=> $ls->siswa->school,
                    'nilai' => $ls->irtscore
                ]);
            }
            $paginator = new NativeArray ([
                'data' => $daftar,
                'limit' => 100,
                'page' => $currentPage
            ]
            );
            $this->response->setStatusCode(200,'OK');
            $this->response->setJsonContent($paginator->paginate());
            return !$this->response->isSent() && $this->response->send();
        }
    }
    public function postFormalScoreAction($idtryout){
        $dataSiswa = SiswaHasTryout::find([
            'conditions' => 'tryout_idtryout = :idtryout:',
            'bind' => [
                'idtryout' => $idtryout
            ]
        ]);
        $succ = true;
        foreach($dataSiswa as $siswa){
            $fullscore = 0;
            if($succ){
                $tryout = Tryout::findFirst([
                    'conditions' =>'idtryout = :id:',
                    'bind' => ['id' => $idtryout]
                ]);
                foreach($tryout->getRelated('subtest') as $subtest){
                    $jawaban =  SiswaHasSoal::find([
                        'conditions' => 'siswa_iduser = :idsiswa: AND soal_subtest_idsubtest = :idsubtest: AND soal_subtest_tryout_idtryout = :idtryout:',
                        'bind'=>[
                            'idsiswa' => $siswa->siswa_iduser,#$this->getUser()['id]
                            'idsubtest'=>$subtest->idsubtest,
                            'idtryout'=>$idtryout
                        ]
                    ]);
                    $score = 0;
                    foreach($jawaban as $ans){
                        if($ans->answer == null){
                            $score += 0;
                        }else{
                            if($ans->answer == $ans->soal->key){
                                $score+=4;
                            }else{
                                $score -=1;
                            }
                        }
                    }
                    $fullscore +=$score;
                }
            }else{
            break;
            }
            $siswa->formalscore = $fullscore;
            if(!$siswa->save()){
                $succ = false;
            }
        }
        if($succ){
            $this->response->setStatusCode(202,'Created');
            $this->response->setContent('aman boss');
        }else{
            $this->response->setStatusCode(409,'Conflict');
        }
        return !$this->response->isSent() && $this->response->send();
    }
    public function postIrtScoreAction($idtryout){
        $dataSiswa = SiswaHasTryout::find([
            'conditions' => 'tryout_idtryout = :idtryout:',
            'bind' => [
                'idtryout' => $idtryout
            ]
        ]);
        $succ = true;
        foreach($dataSiswa as $siswa){
            $fullscore = 0;
            if($succ){
                $tryout = Tryout::findFirst([
                    'conditions' =>'idtryout = :id:',
                    'bind' => ['id' => $idtryout]
                ]);
                foreach($tryout->getRelated('subtest') as $subtest){
                    $jawaban =  SiswaHasSoal::find([
                        'conditions' => 'siswa_iduser = :idsiswa: AND soal_subtest_idsubtest = :idsubtest: AND soal_subtest_tryout_idtryout = :idtryout:',
                        'bind'=>[
                            'idsiswa' => $siswa->siswa_iduser,
                            'idsubtest'=>$subtest->idsubtest,
                            'idtryout'=>$idtryout
                        ]
                    ]);
                    $score = 0;
                    foreach($jawaban as $ans){
                        if($ans->answer == $ans->soal->key){
                            $score+=$ans->soal->response_value;;
                        }else{
                            $score+=0;
                        }
                    }
                    $fullscore +=$score;
                }
            }else{
            break;
            }
            $siswa->irtscore = $fullscore;
            if(!$siswa->save()){
                $succ = false;
            }
        }
        if($succ){
            $this->response->setStatusCode(202,'Created');
            $this->response->setContent('aman boss');
        }else{
            $this->response->setStatusCode(409,'Conflict');
        }
        return !$this->response->isSent() && $this->response->send();
    }
}

