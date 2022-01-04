<?php

namespace App\Controllers;

use App\Models\NasabahModel;

class Nasabah extends BaseController
{
    protected $NasabahModel;
    public function __construct()
    {
        $this->NasabahModel = new NasabahModel();
    }

    public function index()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('nasabah/datanasabah');
    }

    public function create()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('nasabah/formnasabah');
    }
}