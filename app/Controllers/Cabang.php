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
        $data = [
            'title' => 'Data cabang',
            'cabang' => $this->CabangModel->findAll()
        ];
        return view('cabang/datacabang', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Data cabang',
        ];
        return view('cabang/formcabang', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'kode_cabang' => [
                'rules' => 'required|is_unique[cabang.kode_cabang]',
                'errors'    => [
                    'required'  => '{field} Harus Diisi',
                    'is_unique' => '{field} Sudah Terdaftar'
                ]
            ],
            'nama_cabang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[10]|max_length[60]',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'kode_toko' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        // var_dump($this->request->getVar());
        // die;

        $data = [
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'nama_cabang' => $this->request->getVar('nama_cabang'),
            'alamat' => $this->request->getVar('alamat'),
            'kode_toko' => $this->request->getVar('kode_toko')
        ];

        $this->CabangModel->simpan($data);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datacabang');
    }

    public function edit($kode_cabang)
    {
        $data = [
            'cabang'  => $this->CabangModel->find($kode_cabang),
            'title' => 'Form Data cabang'
        ];

        return view('cabang/edit', $data);
    }

    public function update($kode_cabang)
    {
        if (!$this->validate([
            'kode_cabang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'nama_cabang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'kode_toko' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->CabangModel->update($kode_cabang, [
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'nama_cabang' => $this->request->getVar('nama_cabang'),
            'alamat' => $this->request->getVar('alamat'),
            'kode_toko' => $this->request->getVar('kode_toko')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Diubah');
        return redirect()->to('/datacabang');
    }

    public function delete($kode_cabang)
    {
        $this->CabangModel->delete($kode_cabang);
        session()->setFlashdata('Pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/datacabang');
    }
}