<?php

namespace App\Controllers;

use App\Models\SaldoModel;

class Saldo extends BaseController
{
    protected $SaldoModel;
    public function __construct()
    {
        $this->SaldoModel = new SaldoModel();
    }

    public function index()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('saldo/saldo');
    }
}