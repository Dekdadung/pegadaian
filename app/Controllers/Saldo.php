<?php

namespace App\Controllers;

use App\Models\SaldoModel;
use App\Models\CabangModel;

class Saldo extends BaseController
{
    protected $SaldoModel;
    protected $CabangModel;
    public function __construct()
    {
        $this->SaldoModel = new SaldoModel();
        $this->CabangModel = new CabangModel();
        helper('currency');
    }

    public function index()
    {
        $kode_cabang = @$_GET['kode_cabang'];
        $saldo = (!empty($this->SaldoModel->getSisa($kode_cabang)[0]['sisa_kas']) ? $this->SaldoModel->getSisa($kode_cabang)[0]['sisa_kas'] : '0');
        $data = [
            'title' => 'Data Keuangan',
            'validation' => \Config\Services::validation(),
            'saldo' => $saldo,
            'tgl' => $this->SaldoModel->getSisa($kode_cabang)[0]['tgl_masuk'],
            'cabang' => $this->CabangModel->findAll(),
            'kode_cabang_sekarang' => $kode_cabang
        ];
        return view('saldo/saldo', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'jumlah_kas' => [
                'rules' => 'required|numeric',
                'errors'    => [
                    'required'  => 'Data Harus Diisi',
                    'numeric' => 'Hanya boleh berisi angka'
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }
        $kode_cabang = $this->request->getVar('kode_cabang');
        $jumlah_kas = $this->request->getVar('jumlah_kas');
        $get_sisa_kas =  $this->SaldoModel->getSisa($kode_cabang);
        if (!empty($this->SaldoModel->getSisa($kode_cabang))) {
            $sisa_kas = $get_sisa_kas[0]['sisa_kas'];
        } else {
            $sisa_kas = 0;
        }
        $total_kas = $sisa_kas + $jumlah_kas;
        $this->SaldoModel->save([
            'jumlah_kas' => $jumlah_kas,
            'sisa_kas' => $total_kas,
            'keterangan' => $this->request->getVar('keterangan'),
            'kode_cabang' => $this->request->getVar('kode_cabang')
            // 'jenis' => $this->request->getVar('jenis')
        ]);


        session()->setFlashdata('Pesan', 'Saldo Berhasil Ditambahkan');
        return redirect()->to('/saldo');
    }
}