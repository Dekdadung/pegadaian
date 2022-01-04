<?php

namespace App\Controllers;

use App\Models\PegadaianModel;

class Pegadaian extends BaseController
{
    protected $PegadaianModel;
    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
    }

    public function index()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('pegadaian/datagadai');
    }

    public function create()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('pegadaian/formgadai');
    }
}