<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login Form'
        ];

        if (session('id_user')) {
            return redirect()->to(site_url('dashboard'));
        }
        return view('Login/login', $data);
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $level = $this->request->getVar('level');
        $data = $model->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);

            if ($verify_pass) {
                $sessData = [
                    'id_user'   => $data['id_user'],
                    'nama_user' => $data['nama_user'],
                    'username'  => $data['username'],
                    'level'     => $data['level'],
                    'kode_cabang' => $data['cabang'],
                    'logged_in' => TRUE
                ];

                $session->set($sessData);
                return redirect()->to('/homepage');
            } else {
                $session->setFlashdata('pesan', 'Password Anda Salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('pesan', 'Username Anda Tidak Ditemukan');
            return redirect()->to('/login');
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
