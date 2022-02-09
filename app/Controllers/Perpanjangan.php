<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\PerpanjanganModel;
use App\Models\PendapatanModel;

class Perpanjangan extends BaseController
{
    protected $PegadaianModel;
    protected $PendapatanModel;
    protected $PerpanjanganModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->PerpanjanganModel = new PerpanjanganModel();
        $this->PendapatanModel = new PendapatanModel();
    }

    public function createPerpanjang($kode_pinjaman)
    {
        $data_perpanjangan = $this->PerpanjanganModel->get_jatuh_tempo($kode_pinjaman);
        $data_gadai = $this->PegadaianModel->find($kode_pinjaman);
        $data = [
            'gadai' =>  $data_gadai,
            'perpanjangan' => $this->PerpanjanganModel->findAll(),
            'perpanjang_ini' => (count($data_perpanjangan) > 0 ? $data_perpanjangan[0]['tgl_perpanjangan'] : $data_gadai['tgl_jatuh_tempo']),
            'title' => 'Form Perpanjangan',
            'validation' => \Config\Services::validation()
        ];
        return view('Pegadaian/formperpanjang', $data);
    }

    public function savePerpanjang()
    {
        $kode_pinjaman = $this->request->getVar('kode_pinjaman');
        $this->PerpanjanganModel->save([
            'kode_pinjaman' => $kode_pinjaman,
            'tgl_perpanjangan' => $this->request->getVar('tgl_perpanjangan')
        ]);

        $this->PegadaianModel->update($kode_pinjaman, [
            'tgl_jatuh_tempo' => $this->request->getVar('tgl_perpanjangan'),
            'tgl_lelang' => $this->request->getVar('tgl_lelang'),
        ]);

        $bunga = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('bunga'));
        $this->PendapatanModel->save([
            'jumlah_untung' => $bunga,
            'kd_pinjaman' => $kode_pinjaman,
            'jenis' => 'bunga'
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datagadai');
    }
}
