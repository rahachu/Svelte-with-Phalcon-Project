<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Siswa;
use App\Models\Product;
use App\Models\SiswaBuyProduct;

class PaymentController extends Controller
{

    public function getListProductAction()
    {
        //nampilin produk yang dijual ke dashboard siswa
    }
    public function postPaymentAction()
    {
        //menyimpan bukti pembayaran dari siswa ke database
    }
    public function getListValidationAction()
    {
        //menampilkan siswa yang butuh divalidasi pembayarannya
    }
    public function postValidationAction()
    {
        //mengupdate tabel siswa_buy_product validation = true, admin = idadmin
    }
}

