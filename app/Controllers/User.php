<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CabangModel;

class User extends BaseController
{
    protected $UserModel;
    protected $CabangModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->CabangModel = new CabangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data User',
            'user' => $this->UserModel->findAll(),
            'cabang' => $this->CabangModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('User/datauser', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Data User',
            'cabang' => $this->CabangModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('User/formuser', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_user' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->UserModel->save([
            'nama_user' => $this->request->getVar('nama_user'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'cabang' => $this->request->getVar('cabang'),
            'level' => $this->request->getVar('level')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datauser');
    }

    public function edit($id_user)
    {
        $data = [
            'user'  => $this->UserModel->find($id_user),
            'cabang' => $this->CabangModel->findAll(),
            'title' => 'Form Data User',
            'validation' => \Config\Services::validation()
        ];

        return view('User/edit', $data);
    }

    public function update($id_user)
    {
        if (!$this->validate([
            'nama_user' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->UserModel->update($id_user, [
            'nama_user' => $this->request->getVar('nama_user'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'user' => $this->request->getVar('user'),
            'level' => $this->request->getVar('level')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Diubah');
        return redirect()->to('/datauser');
    }

    public function delete($id_user)
    {
        $this->UserModel->delete($id_user);
        $data = [
            'status'  => 'Berhasil Dihapus',
            'status_text' => 'Data Berhasil Dihapus',
            'status_icon' => 'success'
        ];
        return $this->response->setJSON($data);
    }
}
