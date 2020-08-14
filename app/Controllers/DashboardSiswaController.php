<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Tryout;
use App\Models\SiswaHasTryout;
use App\Models\Siswa;

class DashboardSiswaController extends ControllerSiswa
{

    private function getListProduct()
    {
        $idsiswa = $this->auth->getUser()['id'] || 1;
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

        return $tryout;
    }

    private function getProfileSiswa()
    {
        $idsiswa = $this->auth->getUser()['id'] || 1;
        $dataSiswa = Siswa::find(['conditions' => 'iduser = :idsiswa:',
                                'bind'=>['idsiswa'=>$idsiswa]]);
        return $dataSiswa;
    }
    private function getDataNiai()
    {
        return null;
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


}

