<?php

namespace App\Controllers;

use App\Models\SaldoModel;

class Saldo extends BaseController
{
    protected $SaldoModel;
    public function __construct()
    {
        $this->SaldoModel = new SaldoModel();
        helper('currency');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Gadai',
            'saldo' => $this->SaldoModel->getSisa()
        ];
        return view('saldo/saldo', $data);
    }

    public function save()
    {
        $jumlah_kas = $this->request->getVar('jumlah_kas');
        // $sisa_kas = $this->request->getVar('sisa_kas');
        $get_sisa_kas =  $this->SaldoModel->getSisa();
        // $cek_kas = (!empty($this->SaldoModel->getSisa()) ? )
        if (!empty($this->SaldoModel->getSisa())) {
            $sisa_kas = $get_sisa_kas[0]['sisa_kas'];
        } else {
            $sisa_kas = 0;
        }
        echo $sisa_kas;
        var_dump($sisa_kas);
        die;
        $total_kas = $sisa_kas + $jumlah_kas;
        $this->SaldoModel->save([
            'jumlah_kas' => $jumlah_kas,
            'sisa_kas' => $total_kas,
            // 'keterangan' => $this->request->getVar('keterangan'),
            // 'kode_cabang' => $this->request->getVar('kode_cabang'),
            // 'jenis' => $this->request->getVar('jenis')
        ]);

        session()->setFlashdata('Pesan', 'Saldo Berhasil Ditambahkan');
        return redirect()->to('/saldo');
    }
}