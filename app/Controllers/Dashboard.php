<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    protected $DashboardModel;
    public function __construct()
    {
        $this->DashboardModel = new DashboardModel();
    }

    public function index()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('dashboard/homepage');
    }
}