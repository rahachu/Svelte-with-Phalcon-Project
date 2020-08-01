<?php
declare(strict_types=1);

namespace App\Controllers;

Use App\Models\Tryout;
Use App\Models\Subtest;
Use App\Models\Soal;
Use App\Library\Exception;
use Phalcon\Mvc\Controller;

class TryoutController extends Controller
{

    public function getAllAction()
    {
        $tryout = Tryout::find();
        $subtest = Subtest::find();
        $soal = Soal::find();
        $tryout = [$tryout, $subtest, $soal];
        return json_encode($tryout);
    }

}