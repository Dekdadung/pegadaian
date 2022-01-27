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
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        if (!empty($kode_cabang)) {
            $this->cabang = $kode_cabang;
        }
        $this->cabang = $kode_cabang;
        $data_nasabah = $this->NasabahModel->getDataNasabah($kode_cabang);
        $data = [
            'title' => 'Data nasabah',
            'nasabah' => $data_nasabah,
            'cabang' => $this->CabangModel->findAll(),
            'kode_cabang' => $kode_cabang,
            'validation' => \Config\Services::validation()
        ];
        return view('nasabah/datanasabah', $data);
    }

    public function create()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        if (!empty($kode_cabang)) {
            $this->cabang = $kode_cabang;
        }
        $this->cabang = $kode_cabang;
        $data = [
            'nasabah' => $this->NasabahModel->findAll(),
            'cabang' => $this->CabangModel->findAll(),
            'title' => 'Form Data nasabah',
            'kode_cabang' => $kode_cabang,
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
            'alamat_nasabah' => [
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
            'nik' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $data = [
            'nama' => $this->request->getVar('nama'),
            'alamat_nasabah' => $this->request->getVar('alamat_nasabah'),
            'no_telp' => $this->request->getVar('no_telp'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'status' => $this->request->getVar('status'),
            'nik' => $this->request->getVar('nik')
        ];
        $this->NasabahModel->simpan($data);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datanasabah');
    }

    public function save2()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'alamat_nasabah' => [
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
            'nik' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $data = [
            'nama' => $this->request->getVar('nama'),
            'alamat_nasabah' => $this->request->getVar('alamat_nasabah'),
            'no_telp' => $this->request->getVar('no_telp'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'status' => $this->request->getVar('status'),
            'nik' => $this->request->getVar('nik')
        ];
        $this->NasabahModel->simpan($data);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/formgadai');
    }

    public function edit($id_nasabah)
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        if (!empty($kode_cabang)) {
            $this->cabang = $kode_cabang;
        }
        $this->cabang = $kode_cabang;
        $data = [
            'nasabah'  => $this->NasabahModel->find($id_nasabah),
            'cabang' => $this->CabangModel->findAll(),
            'title' => 'Form Data nasabah',
            'kode_cabang' => $kode_cabang,
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
            'alamat_nasabah' => [
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
            'nik' => [
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
            'alamat_nasabah' => $this->request->getVar('alamat_nasabah'),
            'no_telp' => $this->request->getVar('no_telp'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'status' => $this->request->getVar('status'),
            'nik' => $this->request->getVar('nik')
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