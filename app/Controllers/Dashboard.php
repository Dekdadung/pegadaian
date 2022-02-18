<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\SaldoModel;
use App\Models\PembayaranModel;
use App\Models\CabangModel;
use App\Models\PendapatanModel;
use App\Models\HistoriModel;

class Dashboard extends BaseController
{
    protected $PegadaianModel;
    protected $SaldoModel;
    protected $PembayaranModel;
    protected $CabangModel;
    protected $PendapatanModel;
    protected $HistoriModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->SaldoModel = new SaldoModel();
        $this->PembayaranModel = new PembayaranModel();
        $this->CabangModel = new CabangModel();
        $this->PendapatanModel = new PendapatanModel();
        $this->HistoriModel = new HistoriModel();
        helper('currency');
    }

    public function index()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $saldo = (!empty($this->SaldoModel->getSisa($kode_cabang)[0]['sisa_kas']) ? $this->SaldoModel->getSisa($kode_cabang)[0]['sisa_kas'] : '0');
        $saldo = ($kode_cabang == 'FG00') ? 0 : $saldo;
        $data_gadai = $this->PegadaianModel->getDataGadai($kode_cabang, 'hariIni');
        $histori_tebus = $this->HistoriModel->HistoriTebus($kode_cabang, 'penebusan', 'now');
        $histori_perpanjangan = $this->HistoriModel->HistoriPerpanjangan($kode_cabang, 'perpanjangan', 'now');
        $histori_denda = $this->HistoriModel->HistoriDenda($kode_cabang, 'denda', 'now');
        $jatuh_tempo = $this->PegadaianModel->sortDate($kode_cabang);
        $masuk_lelang = $this->PegadaianModel->sortDateLelang($kode_cabang);
        $list_jatuh_tempo = $this->PegadaianModel->selectJatuhTempo($kode_cabang);
        // dd($list_jatuh_tempo);
        // die;
        // $new_data_gadai = array();
        foreach ($data_gadai as $key) {
            $cek_ = '';
            // SELECT * FROM `pinjamangadai` WHERE tgl_jatuh_tempo >= date(NOW()) && tgl_jatuh_tempo <= date(NOW()) + 1
            // $cek_ = $key->tgl_jatuh_tempo == date('Y-m-d') ? 'mark' : 'none';

            $hari_esok = date('Y-m-d', strtotime("+1 day"));
            if ($key->tgl_jatuh_tempo == date('Y-m-d') && $key->status_bayar != 'Lunas') {
                $cek_ = 'danger text-white';
            } elseif ($key->tgl_jatuh_tempo == $hari_esok && $key->status_bayar != 'Lunas') {
                $cek_ = 'warning text-white';
            } elseif ($key->status_bayar == 'Lunas') {
                $cek_ = 'success text-white';
            } else {
                $cek_ = 'default';
            }
            $key->jatuh_tempo_now = $cek_;
        }
        $data = [
            'title' => 'Dashboard',
            'home' => $data_gadai,
            'historiD' => $histori_denda,
            'historiP' => $histori_perpanjangan,
            'historiT' => $histori_tebus,
            'saldo' => $saldo,
            'cabang' => $this->CabangModel->findAll(),
            'kode_cabang_sekarang' => $kode_cabang,
            'jTempo' => $jatuh_tempo,
            'masuk_lelang' => $masuk_lelang,
            'list_jatuh_tempo' => $list_jatuh_tempo,
            // 'sisa_saldo' => $this->SaldoModel->getTotalSaldo()[0]['jumlah_kas'],
            'totalpinjam' => $this->PegadaianModel->getTotalPinjaman($kode_cabang)[0]['jumlah_pinjaman'],
            'totaldapat' => $this->PendapatanModel->getTotalPendapatan($kode_cabang)[0]['total_pendapatan'],
            'totalDapatBulanIni' => $this->PendapatanModel->getTotalPendapatanBulan($kode_cabang)[0]['total_pendapatan']
        ];
        return view('Dashboard/homepage', $data);
    }
}