<?php

namespace App\Controllers;

use App\Models\LaporanModel;

class Laporan extends BaseController
{
    protected $LaporanModel;
    public function __construct()
    {
        $this->LaporanModel = new LaporanModel();
    }

    public function index()
    {
        // $pengepul = $this->jsampahModel->findAll();
        $data = [
            'title' => 'Laporan',
        ];
        return view('laporan/datalaporan', $data);
    }

    public function create()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('laporan/formlaporan');
    }
}