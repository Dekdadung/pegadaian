<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Dompdf\Dompdf;
use App\Models\PegadaianModel;


class Export extends Controller
{
    protected $PegadaianModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        helper('currency');
    }

    public function index()
    {
        // $cek_cabang_user = session('kode_cabang');
        // $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        // $data_gadai = $this->PegadaianModel->getDataGadai($kode_cabang);
        // // $jatuh_tempo = $this->PegadaianModel->sortDate($kode_cabang);
        // $data = [
        //     'title' => 'Data Gadai',
        //     'gadai' => $data_gadai
        //     // 'jTempo' => $jatuh_tempo
        // ];
        return view('layout/pdf');
    }

    public function generate()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $data_gadai = $this->PegadaianModel->getDataGadai($kode_cabang);
        // $jatuh_tempo = $this->PegadaianModel->sortDate($kode_cabang);
        $data = [
            'gadai' => $data_gadai
            // 'jTempo' => $jatuh_tempo
        ];
        // dd($data_gadai);
        // die;
        ini_set("memory_limit", "44M");

        $filename = date('y-m-d-H-i-s') . '-qadr-labs-report';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('layout/pdf', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');


        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}