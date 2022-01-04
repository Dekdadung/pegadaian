<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('user/datauser');
    }

    public function create()
    {
        // $pengepul = $this->jsampahModel->findAll();

        return view('user/formuser');
    }
}