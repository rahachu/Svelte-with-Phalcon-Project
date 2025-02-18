<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Siswa;
use App\Models\PaymentMethod;
use App\Models\Buktipembayaran;
use App\Models\Imagedata;
use App\Models\SiswaHasTryout;
use App\Models\Tryout;
use Phalcon\Paginator\Adapter\NativeArray;

class AdminPaymentController extends ControllerAdmin
{

    public function getListValidatedAction()
    {
        if ($this->response->isSent()) {
            return $this->response;
        }
        //menampilkan siswa yang butuh divalidasi pembayarannya
        if($this->request->hasQuery('page')){
            $currentPage = $this->request->getQuery('page');
            $bukti = Buktipembayaran::find([
                'conditions' => 'validation = 1',
                'order' => 'buy_time DESC'
            ]);
            $dataVal = array();
            $i = 0;
            foreach($bukti as $cont){
                $dataImage = $cont->imagedata;
                $dataID = array();
                foreach ($dataImage as $img) {
                    array_push($dataID,$img->idimage);
                }
                $dataVal[$i] = [
                    'no'=>$i + 1,
                    'namasiswa' => $cont->siswa->fullname,
                    'produk'=>$cont->productname,
                    'bukti'=>$dataID,
                    'admin'=>$cont->admin,
                ];
                $i +=1;
            }

            $paginator = new NativeArray ([
                'data' => $dataVal,
                'limit' => 5,
                'page' => $currentPage
            ]
            );

            $this->response->setStatusCode(202,"Ok");
            $this->response->setJsonContent($paginator->paginate());
        }else{
            $this->response->setStatusCode(409,"Conflict");
            $this->response->setContent("gak onok query");
        }
        return $this->response->send();
    }
    public function getListUnvalidatedAction()
    {
        if ($this->response->isSent()) {
            return $this->response;
        }
               //menampilkan siswa yang butuh divalidasi pembayarannya
               if($this->request->hasQuery('page')){
                $currentPage = $this->request->getQuery('page');
                $bukti = Buktipembayaran::find([
                    'conditions' => 'validation = 0',
                    'order' => 'buy_time DESC'
                ]);
                $dataVal = array();
                $i = 0;
                foreach($bukti as $cont){
                    $dataImage = $cont->imagedata;
                    $dataID = array();
                    foreach ($dataImage as $img) {
                        array_push($dataID,$img->idimage);
                    }
                    $dataVal[$i] = [
                        'id'=>$cont->idsiswa_buy_product,
                        'namasiswa' => $cont->siswa->fullname,
                        'produk'=>$cont->productname,
                        'bukti'=>$dataID,
                    ];
                    $i +=1;
                }
    
                $paginator = new NativeArray ([
                    'data' => $dataVal,
                    'limit' => 50,
                    'page' => $currentPage
                ]
                );
    
                $this->response->setStatusCode(202,"Ok");
                $this->response->setJsonContent($paginator->paginate());
            }else{
                $this->response->setStatusCode(409,"Conflict");
                $this->response->setContent("gak onok query");
            }
            return $this->response->send();
    }
    public function ImagedataAction($idimage)
    {
        if ($this->response->isSent()) {
            return $this->response;
        }
        $image = Imagedata::findFirst($idimage);
        if ($image) {
            $this->response->setStatusCode(202,"Ok");
            $this->response->setContent($image->data);
        }
        else {
            $this->response->setStatusCode(404,"Not Found");
            $this->response->setContent("Data gambar tidak ditemukan");
        }
        return $this->response->send();
    }
    public function postValidationAction($idpembayaran)
    {
        if ($this->response->isSent()) {
            return $this->response;
        }
        //mengupdate tabel siswa_buy_product validation = true, admin = idadmin
        $bukti = Buktipembayaran::findFirst($idpembayaran);
        $siswahastryout = new SiswaHasTryout();
        $siswahastryout->siswa_iduser = $bukti->iduser;
        $siswahastryout->tryout = Tryout::find([
            "conditions"=>'name=:nama:',
            "bind"=>['nama'=>$bukti->productname]
        ])[0];
        if ($siswahastryout->save()) {
            $bukti->validation = 1;
            $bukti->admin = $this->auth->getUser()['username'];
        }
        $bukti->save();
        $this->response->setContent('kontol');
        $this->response->setStatusCode(201,"Created");
        return $this->response->send();
    }
}

