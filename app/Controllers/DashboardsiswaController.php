<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Library\Exception;
use Phalcon\Http\Request\File;
use Phalcon\Image\Adapter\Gd;
use Phalcon\Mvc\Controller;
use App\Models\Tryout;
use App\Models\SiswaHasTryout;
use App\Models\Siswa;
use App\Models\SiswaHasSoal;
use App\Models\Soal;
use App\Models\SiswaHasSubtest;
use App\Models\Subtest;
use App\Models\Buktipembayaran;
use Phalcon\Validation;

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
            'conditions' => (count($siswaTryout)==0?'':'idtryout NOT IN ('.$strSiswaTryout.') AND ').'publish_time IS NOT NULL',
            
        ])->toArray();
        foreach ($tryout as $key => $value) {
            $tryout[$key]['buyed']=count(Buktipembayaran::find([
                'conditions'=> 'iduser = :idsiswa: AND productname = :pname:',
                'bind' => ['idsiswa'=>$idsiswa,'pname'=>$value['name']],
            ]))!=0;
        }

        return $tryout;
    }

    private function getProfileSiswa()
    {
        $idsiswa = $this->auth->getUser()['id'] || 1;
        $dataSiswa = Siswa::findFirst(['conditions' => 'iduser = :idsiswa:',
                                'bind'=>['idsiswa'=>$idsiswa]]);
        return $dataSiswa;
    }
    private function getDataNiai()
    {
        return null;
    }

    public function updateProfileAction()
    {
        $upload = new File($_FILES['photo']);
        // validate request
        $validation = new Validation();
        $validation->add('photo', new Validation\Validator\File([
            "maxSize"      => "1M",
            "messageSize"  => ":field exceeds the max filesize (:max)",
            "allowedTypes" => [
                "image/png",
                "image/jpeg",
                "image/jpg"
            ],
            "maxResolution" => "500x500",
            "messageType" => "Allowed file types are :types",
        ]));
        $validation->add([
            'fullname',
            'school',
            'city',
            'phone'
        ], new Validation\Validator\StringLength([
            'max' => [
                'fullname' => 45,
                'school' => 45,
                'city' => 45,
                'phone' => 45
            ],
            'messageMaximum' => 'Field :field terlalu panjang (max :max karakter)'
        ]));
        $messages = $validation->validate($_FILES);
        if (count($messages)) {
            $this->response->setStatusCode(400);
            $this->response->setJsonContent($messages);
        }
        /*$siswa = Siswa::findFirst([
            'conditions' => 'iduser = :idsiswa:',
            'bind' =>[
                'idsiswa' => $siswa_iduser
            ]
        ]);*/
        $siswa = $this->getProfileSiswa();

        // Apakah siswa nya ada?
        if ($siswa === false) {
            // Jika siswa tidak ada
            $this->response->setStatusCode(404, 'Siswa tidak ditemukan');
            $this->response->setJsonContent('');
        } else {
            // Jika siswa ditemukan
            $upload_dir = __DIR__.'/../../public/upload/';
            if (!is_dir($upload_dir)) { // jika folder upload gaada
                mkdir($upload_dir, 0755);
            }
            $siswa_photo_name = sprintf('siswa_profil_%d_%d.%s', $siswa->iduser, time(), $upload->getExtension());
            $upload->moveTo($upload_dir.$siswa_photo_name);

            // Update profil siswa
            $siswa->fullname = $this->request->getPost('fullname');
            $siswa->school = $this->request->getPost('school');
            $siswa->city = $this->request->getPost('city');
            $siswa->phone = $this->request->getPost('phone');
            $siswa->photo = $siswa_photo_name;
            $siswa->save();
            $this->response->setStatusCode(200, 'updated');
            $this->response->setJsonContent('Siswa berhasil diupdate');
        }
        return $this->response;
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
            return json_decode($exsist->result,true);
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
                'benar' => $score['benar'],
                'salah' => $score['salah'],
                'jumlahSoal' => $score['jumlahSoal']
            ));
        }
        $this->response->setJsonContent($result);
        return $this->response->send();
        
    }

}

