<?php

namespace App\Controllers;

use App\Models\NasabahModel;
use App\Models\CabangModel;

class Nasabah extends BaseController
{
    protected $NasabahModel;
    protected $CabangModel;
    public function __construct()
    {
        $this->NasabahModel = new NasabahModel();
        $this->CabangModel = new CabangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data nasabah',
            'nasabah' => $this->NasabahModel->getDataNasabah()
        ];
        return view('nasabah/datanasabah', $data);
    }

    public function create()
    {
        $data = [
            'nasabah' => $this->NasabahModel->findAll(),
            'cabang' => $this->CabangModel->findAll(),
            'title' => 'Form Data nasabah',
            'validation' => \Config\Services::validation()
        ];
        return view('nasabah/formnasabah', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama' => [
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
            'no_telp' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'kode_cabang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->NasabahModel->save([
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datanasabah');
    }

    public function edit($id_nasabah)
    {
        $data = [
            'nasabah'  => $this->NasabahModel->find($id_nasabah),
            'cabang' => $this->CabangModel->findAll(),
            'title' => 'Form Data nasabah',
            'validation' => \Config\Services::validation()
        ];

        return view('nasabah/edit', $data);
    }

    public function update($id_nasabah)
    {
        if (!$this->validate([
            'nama' => [
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
            'no_telp' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'kode_cabang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->NasabahModel->update($id_nasabah, [
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Diubah');
        return redirect()->to('/datanasabah');
    }

    public function delete($id_nasabah)
    {
        $data = ['nasabah' => $this->NasabahModel->find($id_nasabah)];
        $this->NasabahModel->delete($id_nasabah);
        session()->setFlashdata('Pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/datanasabah');
    }
}