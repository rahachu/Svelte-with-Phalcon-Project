<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Siswa;
use App\Models\PaymentMethod;
use App\Models\Buktipembayaran;
use App\Models\Tryout;
use App\Models\Imagedata;
Use App\Library\Exception;

class SiswaPaymentController extends ControllerSiswa
{

    
    // /dashboard/product/payment_method
    public function postPaymentAction($idproduct,$payment_method)
    {
        $dataBukti = new Buktipembayaran();
        $productname = Tryout::findFirst($idproduct);
        $dataBukti->productname =$productname->name;
        $dataBukti->payment_method = $payment_method;
        $dataBukti->iduser = $this->auth->getUser()['id'];
        $dataBukti->buy_time = new \Phalcon\Db\RawValue('CURRENT_TIMESTAMP()');
        $dataBukti->validation = 0;
        $imgs = $this->request->getPost('data');
        if($dataBukti->save()){
            foreach ($imgs as $img) {
                $image = new Imagedata(['data'=>$img]);
                // $dataBukti->imagedata = $image;
                $image->buktipembayaran = $dataBukti;
                $image->save();
            }
            $this->response->setStatusCode(202,"Created");
            $this->response->setContent("Successfull Saving");
        }else{
            $this->response->setStatusCode(409,"Confilct");
            $this->response->setContent("Gagal Upload Bukti");

        }
        return $this->response->send();
    }
    // /dashboard/idproduct 
    public function getPaymentMethodAction(){
        $paymentMethod = PaymentMethod::find();
        $this->response->setStatusCode(200,"Ok mamang");
        $this->response->setJsonContent($paymentMethod);
        return $this->response->send();
    }
    // /dashboard/product/data
    public function productAction($idproduct)
    {
        $to = Tryout::findFirst($idproduct);
        $result = [
            "idtryout"=>$idproduct,
            "name"=>$to->name,
            "price"=>$to->tryout_price
        ];
        $this->response->setStatusCode(200,"Ok mamang");
        $this->response->setJsonContent($result);
        return $this->response->send();
    }
}

