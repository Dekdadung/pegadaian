<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\SaldoModel;

class Dashboard extends BaseController
{
    protected $PegadaianModel;
    protected $SaldoModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->SaldoModel = new SaldoModel();
        helper('currency');
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'home' => $this->PegadaianModel->getDataGadai()
        ];
        return view('dashboard/homepage', $data);
    }
}