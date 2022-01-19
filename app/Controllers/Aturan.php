<?php

namespace App\Controllers;

use App\Models\AturanModel;

class Aturan extends BaseController
{
    protected $AturanModel;
    public function __construct()
    {
        $this->AturanModel = new AturanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Peraturan',
            'aturan' => $this->AturanModel->findAll()
        ];
        return view('aturan/dataaturan', $data);
    }

    public function create()
    {
        $data = [
            'aturan' => $this->AturanModel->findAll(),
            'title' => 'Form Data aturan',
            'validation' => \Config\Services::validation()
        ];
        return view('aturan/formaturan', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'bunga' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'denda' => [
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
            'bunga' => $this->request->getVar('bunga'),
            'denda' => $this->request->getVar('denda')
        ];

        $this->AturanModel->simpan($data);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/dataaturan');
    }

    public function edit($id_aturan)
    {
        $data = [
            'aturan'  => $this->AturanModel->find($id_aturan),
            'title' => 'Form Data aturan',
            'validation' => \Config\Services::validation()
        ];

        return view('aturan/edit', $data);
    }

    public function update($id_aturan)
    {
        if (!$this->validate([
            'bunga' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'denda' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->AturanModel->update($id_aturan, [
            'bunga' => $this->request->getVar('bunga'),
            'denda' => $this->request->getVar('denda')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Diubah');
        return redirect()->to('/dataaturan');
    }

    public function delete($id_aturan)
    {
        $this->AturanModel->delete($id_aturan);
        session()->setFlashdata('Pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/dataaturan');
    }
}