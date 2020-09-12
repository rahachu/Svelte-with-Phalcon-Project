<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
Use App\Models\Tryout;
Use App\Models\Subtest;
Use App\Models\Soal;
use App\Models\SiswaHasTryout;
Use App\Models\SiswaHasSoal;

class AdminTryoutController extends ControllerAdmin
{

    public function getListTryoutAction(){
        $tryouts = Tryout::find([
            'conditions' => 'publish_time IS NOT NULL'
        ]);
        $result = array();
        foreach($tryouts as $tryout){
            array_push($result,[
                'idtryout' => $tryout->idtryout,
                'name' =>$tryout->name
            ]);
        }
        $this->response->setStatusCode(200,'OK');
        $this->response->setJsonContent($result);
        return !$this->response->isSent() && $this->response->send();
    }
    private function countScore($result){
        $score = 0;
        foreach($result as $rslt){
            $socre += $rslt;
        }
        return $score;
    }
    public function getResponseScore($idtryout){
        
    }
}

