<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\SaldoModel;
use App\Models\PembayaranModel;
use App\Models\CabangModel;
use App\Models\PendapatanModel;

class Dashboard extends BaseController
{
    protected $PegadaianModel;
    protected $SaldoModel;
    protected $PembayaranModel;
    protected $CabangModel;
    protected $PendapatanModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->SaldoModel = new SaldoModel();
        $this->PembayaranModel = new PembayaranModel();
        $this->CabangModel = new CabangModel();
        $this->PendapatanModel = new PendapatanModel();
        helper('currency');
    }

    public function index()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $saldo = (!empty($this->SaldoModel->getSisa($kode_cabang)[0]['sisa_kas']) ? $this->SaldoModel->getSisa($kode_cabang)[0]['sisa_kas'] : '0');
        $data_gadai = $this->PegadaianModel->getDataGadai($kode_cabang);
        $jatuh_tempo = $this->PegadaianModel->sortDate($kode_cabang);
        // dd($saldo);
        // die;
        $data = [
            'title' => 'Dashboard',
            'home' => $data_gadai,
            'saldo' => $saldo,
            'cabang' => $this->CabangModel->findAll(),
            'kode_cabang_sekarang' => $kode_cabang,
            'jTempo' => $jatuh_tempo,
            // 'sisa_saldo' => $this->SaldoModel->getTotalSaldo()[0]['jumlah_kas'],
            'totalpinjam' => $this->PegadaianModel->getTotalPinjaman()[0]['jumlah_pinjaman'],
            'totaldapat' => $this->PendapatanModel->getTotalPendapatan()[0]['jumlah_untung']
        ];
        return view('dashboard/homepage', $data);
    }
}