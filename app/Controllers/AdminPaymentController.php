<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Siswa;
use App\Models\PaymentMethod;
use App\Models\Buktipembayaran;
use App\Models\Imagedata;
use Phalcon\Paginator\Adapter\NativeArray;

class AdminPaymentController extends ControllerAdmin
{

    public function getListValidatedAction()
    {
        //menampilkan siswa yang butuh divalidasi pembayarannya
        if($this->request->hasQuery('page')){
            $currentPage = $this->request->getQuery('page');
            $bukti = Buktipembayaran::find('validation = 1');
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
                    'bukti'=>$dataID
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
        return !$this->response->isSent() && $this->response->send();
    }
    public function getListUnvalidatedAction()
    {
               //menampilkan siswa yang butuh divalidasi pembayarannya
               if($this->request->hasQuery('page')){
                $currentPage = $this->request->getQuery('page');
                $bukti = Buktipembayaran::find('validation = 0');
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
                        'bukti'=>$dataID
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
            return !$this->response->isSent() && $this->response->send();
    }
    public function ImagedataAction($idimage)
    {
        $image = Imagedata::findFirst($idimage);
        if ($image) {
            $this->response->setStatusCode(202,"Ok");
            $this->response->setContent($image->data);
        }
        else {
            $this->response->setStatusCode(404,"Not Found");
            $this->response->setContent("Data gambar tidak ditemukan");
        }
        return !$this->response->isSent() && $this->response->send();
    }
    public function postValidationAction($idpembayaran)
    {
        //mengupdate tabel siswa_buy_product validation = true, admin = idadmin
        $bukti = Buktipembayaran::findFirst($idpembayaran);
        $bukti->validation = 1;
        $bukti->idadmin = 1; //
        $bukti->save();
        $this->response->setContent('kontol');
        return $this->response->send();
    }
}

