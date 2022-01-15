<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\PerpanjanganModel;

class Perpanjangan extends BaseController
{
    protected $PegadaianModel;
    protected $PerpanjanganModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->PerpanjanganModel = new PerpanjanganModel();
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
        return view('pegadaian/formperpanjang', $data);
    }

    public function savePerpanjang()
    {
        $this->PerpanjanganModel->save([
            'kode_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'tgl_perpanjangan' => $this->request->getVar('tgl_perpanjangan')
        ]);
        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datagadai');
    }
}