<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\SiswaHasSoal;
use App\Models\Soal;
use App\Models\SiswaHasSubtest;
use App\Models\Subtest;

class AdminAssesmentController extends ControllerAdmin
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

    
}

