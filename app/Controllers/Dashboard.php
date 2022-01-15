<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\SaldoModel;
use App\Models\PembayaranModel;
use App\Models\CabangModel;

class Dashboard extends BaseController
{
    protected $PegadaianModel;
    protected $SaldoModel;
    protected $PembayaranModel;
    protected $CabangModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->SaldoModel = new SaldoModel();
        $this->PembayaranModel = new PembayaranModel();
        $this->CabangModel = new CabangModel();
        helper('currency');
    }

    public function index()
    {
        $kode_cabang = @$_GET['kode_cabang'];
        $saldo = (!empty($this->SaldoModel->getSisa($kode_cabang)[0]['sisa_kas']) ? $this->SaldoModel->getSisa($kode_cabang)[0]['sisa_kas'] : '0');
        $data_gadai = $this->PegadaianModel->getDataGadai();
        $data = [
            'title' => 'Dashboard',
            'home' => $data_gadai,
            'saldo' => $saldo,
            'cabang' => $this->CabangModel->findAll(),
            'kode_cabang_sekarang' => $kode_cabang,
            // 'sisa_saldo' => $this->SaldoModel->getTotalSaldo()[0]['jumlah_kas'],
            'totalpinjam' => $this->PegadaianModel->getTotalPinjaman()[0]['jumlah_pinjaman'],
            'totaldapat' => $this->PembayaranModel->getTotalPendapatan()[0]['jumlah_bayar']
        ];
        return view('dashboard/homepage', $data);
    }
}