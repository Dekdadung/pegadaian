<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Barang extends BaseController
{
    protected $BarangModel;

    public function __construct()
    {
        $this->BarangModel = new BarangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Barang',
            'barang' => $this->BarangModel->findAll()
        ];
        return view('barang/databarang', $data);
    }

    public function create()
    {
        $data = [
            'barang' => $this->BarangModel->findAll(),
            'title' => 'Form Data barang',
            'validation' => \Config\Services::validation()
        ];
        return view('barang/formbarang', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_barang' => [
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
            'nama_barang' => $this->request->getVar('nama_barang')
        ];

        $this->BarangModel->simpan($data);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/databarang');
    }

    public function edit($id_barang)
    {
        $data = [
            'barang'  => $this->BarangModel->find($id_barang),
            'title' => 'Form Data Barang',
            'validation' => \Config\Services::validation()
        ];

        return view('barang/edit', $data);
    }

    public function update($id_barang)
    {
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ]
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->BarangModel->update($id_barang, [
            'nama_barang' => $this->request->getVar('nama_barang')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Diubah');
        return redirect()->to('/databarang');
    }

    public function delete($id_barang = null)
    {
        $this->BarangModel->delete($id_barang);
        $data = [
            'status'  => 'Berhasil Dihapus',
            'status_text' => 'Data Berhasil Dihapus',
            'status_icon' => 'success'
        ];
        return $this->response->setJSON($data);
        // session()->setFlashdata('Pesan', 'Data Berhasil Dihapus');
        // return redirect()->to('/databarang');
    }
}