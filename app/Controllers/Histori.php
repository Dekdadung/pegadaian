<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\NasabahModel;
use App\Models\CabangModel;
use App\Models\SaldoModel;
use App\Models\PembayaranModel;
use App\Models\PendapatanModel;
use App\Models\AturanModel;
use App\Models\BarangModel;
use App\Models\LelangModel;
use App\Models\PerpanjanganModel;
use App\Models\HistoriModel;
// use App\Libraries\PHPExcel;
use PHPExcel;
use PHPExcel_IOFactory;

class Histori extends BaseController
{
    protected $PegadaianModel;
    protected $NasabahModel;
    protected $CabangModel;
    protected $SaldoModel;
    protected $cabang;
    protected $telp;
    protected $PembayaranModel;
    protected $PendapatanModel;
    protected $AturanModel;
    protected $PerpanjanganModel;
    protected $LelangModel;
    protected $BarangModel;
    protected $HistoriModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->NasabahModel = new NasabahModel();
        $this->CabangModel = new CabangModel();
        $this->SaldoModel = new SaldoModel();
        $this->PembayaranModel = new PembayaranModel();
        $this->PendapatanModel = new PendapatanModel();
        $this->AturanModel = new AturanModel();
        $this->BarangModel = new BarangModel();
        $this->LelangModel = new LelangModel();
        $this->PerpanjanganModel = new PerpanjanganModel();
        $this->HistoriModel = new HistoriModel();
        helper('currency');
    }


    public function HistoriTebus()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $histori_tebus = $this->HistoriModel->AllHistoriTebus($kode_cabang, 'penebusan');

        // $jatuh_tempo = $this->PegadaianModel->sortDate($kode_cabang);
        $data = [
            'title' => 'Data Histori',
            'historiT' => $histori_tebus,
            // 'jTempo' => $jatuh_tempo
        ];
        return view('Histori/historiPenebusan', $data);
    }
    public function HistoriPerpanjangan()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $histori_perpanjangan = $this->HistoriModel->AllHistoriPerpanjangan($kode_cabang, 'perpanjangan');

        // $jatuh_tempo = $this->PegadaianModel->sortDate($kode_cabang);
        $data = [
            'title' => 'Data Histori',
            'historiP' => $histori_perpanjangan,
            // 'jTempo' => $jatuh_tempo
        ];
        return view('Histori/historiPerpanjangan', $data);
    }
    public function HistoriDenda()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $histori_denda = $this->HistoriModel->AllHistoriDenda($kode_cabang, 'denda');

        // $jatuh_tempo = $this->PegadaianModel->sortDate($kode_cabang);
        $data = [
            'title' => 'Data Histori',
            'historiD' => $histori_denda,
            // 'jTempo' => $jatuh_tempo
        ];
        return view('Histori/historiDenda', $data);
    }
}