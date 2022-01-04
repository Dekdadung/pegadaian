<?php

namespace App\Controllers;

use App\Models\CabangModel;

class Cabang extends BaseController
{
    protected $CabangModel;
    public function __construct()
    {
        $this->CabangModel = new CabangModel();
    }

    public function index()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('cabang/datacabang');
    }

    public function create()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('cabang/formcabang');
    }
}