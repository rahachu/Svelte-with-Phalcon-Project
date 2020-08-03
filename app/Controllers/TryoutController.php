<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response\Cookies;
use App\Models\Tryout;
use App\Models\Subtest;
use App\Models\soal;

class TryoutController extends Controller
{

    public function saveQuestionAction()
    {
        $dataSoal = json_decode($this->request->getRawBody());
        #Save tryout
        $tryout = new Tryout();
        $tryout->idtryout = $dataSoal->idtryout;
        $tryout->name = $dataSoal->name;
        $tryout->publish_time = $dataSoal->publish_time;
        $tryout->tryout_price = $dataSoal->tryout_price;
        # if success lanjut subtest
        $succ = false;
        $rsltTryout = $tryout->save();
        if($rsltTryout == true){
            #save Subtest
            $idsubtest = 0;
            foreach ($dataSoal->subtest as $datasubtest){
                $subtest = new Subtest();
                $subtest->idsubtest = $idsubtest;
                $subtest->tryout_idtryout = $dataSoal->idtryout;
                $subtest->judul = $datasubtest->judul;
                $subtest->time_in_minute = $datasubtest->time;
    
                $rsltSubtest = $subtest->save();
                if($rsltSubtest == true){
                    foreach ($datasubtest->soal as $datasoal){
                        $soal = new Soal();
                        $soal->no = $datasoal->no;
                        $soal->subtest_idsubtest = $idsubtest;
                        $soal->subtest_tryout_idtryout = $dataSoal->idtryout;
                        $soal->question = $datasoal->question;
                        $soal->option_a = $datasoal->option_a;
                        $soal->option_b = $datasoal->option_b;
                        $soal->option_c = $datasoal->option_c;
                        $soal->option_d = $datasoal->option_d;
                        $soal->option_e = $datasoal->option_e;
                        $soal->key = $datasoal->key;
                        $soal->solution = $datasoal->solution;
                        $rsltSoal = $soal->save();
                        if($rsltSoal == true){
                            $succ = true;
                        }else{
                            $succ = false;
                            $this->response->setContent("Masalah di input Soal");
                        }
                        }
                }
                else{
                $succ = false;
                $this->response->setContent("Masalah di input subtest");
                }
                $idsubtest+=1;
            }
            
        }else{
            $succ = false;
            $this->response->setContent("Masalah di input Tryout");
        }


        if($succ == true){
            $this->response->setStatusCode(201,"Created");
        }else{
            $this->response->setStatusCode(409,"Conflict");
        }
        return $this->response->send();
    }
}

