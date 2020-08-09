<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Siswa;
use App\Models\PaymentMethod;
use App\Models\Buktipembayaran;

class SiswaPaymentController extends ControllerSiswa
{

    
    // /dashboard/product/payment_method
    public function postPaymentAction($idproduct,$payment_method)
    {
        $dataBukti = new Buktipembayaran();
        $dataBukti->idproduct =$idproduct;
        $dataBukti->payment_method = $payment_method;
        $dataBukti->iduser = 1; //$this->auth->getUser()['iduser'];
        $dataBukti->data = json_encode($this->request->getRawBody());
        $dataBukti->buy_time = new \Phalcon\Db\RawValue('CURRENT_TIMESTAMP()');
        $dataBukti->validation = 1;
        if($dataBukti->save()){
            $this->response->setStatusCode(202,"Created");
            $this->response->setContent("Successfull Saving");
        }else{
            $this->response->setStatusCode(409,"Confilct");
            $this->response->setContent("Gagal Upload Bukti");

        }
        return $this->response->send();
    }
    // /dashboard/idproduct 
    public function getPaymentMethodAction($idproduct){
        $paymentMethod = PaymentMethod::find();
        $this->response->setJsonContent($paymentMethod);
        return $this->response->send();
    }
}

