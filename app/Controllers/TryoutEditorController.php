<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response\Cookies;
use App\Models\Tryout;
use App\Models\Subtest;
use App\Models\soal;

class TryoutEditorController extends ControllerAdmin
{
    public function createTryoutAction()
    {
        # Membuat tryout baru kosong
        $postData = json_decode($this->request->getRawBody());
        $tryout = new Tryout();
        $tryout->name = $postData->name;
        $tryout->tryout_price = $postData->tryout_price;
        if ($tryout->save()) {
            # Jika sukses membuat
            $this->response->setStatusCode(201,"Created");
        }
        else {
            # Jika gagal membuat
            $this->response->setStatusCode(409,"Conflict");
        }
        return $this->response->send();
    }

    public function deleteTryoutAction()
    {
        # Menghapus suatu tryout
        $idtryout = json_decode($this->request->getRawBody())->idtryout;
        $tryout = Tryout::findFirst($idtryout);
        if ($tryout->delete()===false) {
            # bila gagal
            $this->response->setStatusCode(409,"Conflict");
        }
        else{
            $this->response->setStatusCode(201,"Deleted");
        }
        return $this->response->send();
    }

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
                $subtest->time_in_minute = $datasubtest->time_in_minute;
    
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

    public function tryoutListAction()
    {
        # memberikan daftar tryout
        $tryouts = Tryout::find();
        $this->response->setJsonContent($tryouts);
        return $this->response->send();
    }

    public function fulldataAction($idtryout)
    {
        # kembalikan data full tryout
        $tryout = Tryout::findFirst($idtryout);
        $subtest = $tryout->subtest;
        $resp = $tryout->toArray();
        $resp['subtest'] = $subtest->toArray();
        $i = 0;
        foreach ($subtest as $s) {
            # loading soal
            $soal = $s->soal;
            $resp['subtest'][$i]['soal']=$soal;
            $i++;
        }
        $this->response->setJsonContent($resp);
        return $this->response->send();
    }

    public function publishAction($idtryout)
    {
        # mempublish tryout
        $tryout = Tryout::findFirst($idtryout);
        $tryout->publish_time = new \Phalcon\Db\RawValue('CURRENT_TIMESTAMP()');
        $tryout->save();
    }

    public function unpublishAction($idtryout)
    {
        # mempublish tryout
        $tryout = Tryout::findFirst($idtryout);
        $tryout->publish_time = null;
        $tryout->save();
    }
}

