<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Tryout;
use App\Models\SiswaHasTryout;

class DashboardSiswaController extends ControllerSiswa
{

    public function getListProductAction()
    {
        $idsiswa = 1;//$this->auth->getUser()['iduser'] || 1;
        $siswaTryout = array_map(function($v) {
            return $v['siswa_iduser'];
        }, SiswaHasTryout::find(['conditions' => 'siswa_iduser = :idsiswa:',
            'bind' => ['idsiswa'=>$idsiswa],
            "hydration" => \Phalcon\Mvc\Model\Resultset::HYDRATE_OBJECTS])->toArray());
        $strSiswaTryout = implode(',',$siswaTryout);
        $tryout = Tryout::find([
            'conditions' => 'idtryout NOT IN (:strSiswaTryout:) AND publish_time IS NOT NULL',
            'bind' => ['strSiswaTryout'=>$strSiswaTryout],
        ]);

        $this->response->setJsonContent(json_encode($tryout));
        $this->response->setStatusCode(200,"OK");
        return $this->response->send();
    }

    public function getProfieSiswa(){
        $idsiswa = $this->auth->getUser()['iduser'];
        
    }

}

