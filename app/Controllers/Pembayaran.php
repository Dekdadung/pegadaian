<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\NasabahModel;
use App\Models\CabangModel;
use App\Models\SaldoModel;
use App\Models\PembayaranModel;

class Pembayaran extends BaseController
{
    protected $PegadaianModel;
    protected $PembayaranModel;
    protected $NasabahModel;
    protected $CabangModel;
    protected $SaldoModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->NasabahModel = new NasabahModel();
        $this->CabangModel = new CabangModel();
        $this->SaldoModel = new SaldoModel();
        $this->PembayaranModel = new PembayaranModel();
        helper('currency');
    }

    public function createBayar($kode_pinjaman)
    {
        $data_gadai = $this->PegadaianModel->find($kode_pinjaman);
        $data = [
            'gadai' =>  $data_gadai,
            'nasabah' => $this->NasabahModel->findAll(),
            'cabang' => $this->CabangModel->findAll(),
            'saldo' => $this->SaldoModel->findAll(),
            'title' => 'Form Bayar',
            'validation' => \Config\Services::validation()
        ];
        return view('pegadaian/formbayar', $data);
    }

    public function saveBayar()
    {
        $this->PembayaranModel->save([
            'kode_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
            'tgl_bayar' => $this->request->getVar('tgl_bayar'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);
        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datagadai');
    }

    // public function delete($kode_pinjaman)
    // {
    //     $this->PegadaianModel->delete($kode_pinjaman);
    //     session()->setFlashdata('Pesan', 'Data Berhasil Dihapus');
    //     return redirect()->to('/datagadai');
    // }
}