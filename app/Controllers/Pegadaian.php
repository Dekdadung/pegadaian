<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\NasabahModel;
use App\Models\CabangModel;

class Pegadaian extends BaseController
{
    protected $PegadaianModel;
    protected $NasabahModel;
    protected $CabangModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->NasabahModel = new NasabahModel();
        $this->CabangModel = new CabangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Gadai',
            'gadai' => $this->PegadaianModel->getDataGadai()
        ];
        return view('pegadaian/datagadai', $data);
    }

    public function create()
    {
        $data = [
            'gadai' => $this->PegadaianModel->findAll(),
            'nasabah' => $this->NasabahModel->findAll(),
            'cabang' => $this->CabangModel->findAll(),
            'title' => 'Form Data Gadai',
            'validation' => \Config\Services::validation()
        ];
        return view('pegadaian/formgadai', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'id_nasabah' => [
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
            'jenis_barang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'seri' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'kelengkapan' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'kondisi' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'tgl_gadai' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'tgl_jatuh_tempo' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'tgl_lelang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'jumlah_pinjaman' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'bunga' => [
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
            'status_bayar' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->PegadaianModel->save([
            'id_nasabah' => $this->request->getVar('id_nasabah'),
            'no_telp' => $this->request->getVar('no_telp'),
            'jenis_barang' => $this->request->getVar('jenis_barang'),
            'seri' => $this->request->getVar('seri'),
            'kelengkapan' => $this->request->getVar('kelengkapan'),
            'jumlah' => $this->request->getVar('jumlah'),
            'kondisi' => $this->request->getVar('kondisi'),
            'tgl_gadai' => $this->request->getVar('tgl_gadai'),
            'tgl_jatuh_tempo' => $this->request->getVar('tgl_jatuh_tempo'),
            'tgl_lelang' => $this->request->getVar('tgl_lelang'),
            'jumlah_pinjaman' => $this->request->getVar('jumlah_pinjaman'),
            'bunga' => $this->request->getVar('bunga'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'status_bayar' => $this->request->getVar('status_bayar')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datagadai');
    }

    public function edit($kode_pinjaman)
    {
        $data = [
            'gadai'  => $this->PegadaianModel->find($kode_pinjaman),
            'cabang' => $this->CabangModel->findAll(),
            'nasabah' => $this->NasabahModel->findAll(),
            'title' => 'Form Data Gadai',
            'validation' => \Config\Services::validation()
        ];

        return view('pegadaian/edit', $data);
    }

    public function update($kode_pinjaman)
    {
        if (!$this->validate([
            'id_nasabah' => [
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
            'jenis_barang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'seri' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'kelengkapan' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'kondisi' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'tgl_gadai' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'tgl_jatuh_tempo' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'tgl_lelang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'jumlah_pinjaman' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'bunga' => [
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
            'status_bayar' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->PegadaianModel->update($kode_pinjaman, [
            'id_nasabah' => $this->request->getVar('id_nasabah'),
            'no_telp' => $this->request->getVar('no_telp'),
            'jenis_barang' => $this->request->getVar('jenis_barang'),
            'seri' => $this->request->getVar('seri'),
            'kelengkapan' => $this->request->getVar('kelengkapan'),
            'jumlah' => $this->request->getVar('jumlah'),
            'kondisi' => $this->request->getVar('kondisi'),
            'tgl_gadai' => $this->request->getVar('tgl_gadai'),
            'tgl_jatuh_tempo' => $this->request->getVar('tgl_jatuh_tempo'),
            'tgl_lelang' => $this->request->getVar('tgl_lelang'),
            'jumlah_pinjaman' => $this->request->getVar('jumlah_pinjaman'),
            'bunga' => $this->request->getVar('bunga'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'status_bayar' => $this->request->getVar('status_bayar')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Diubah');
        return redirect()->to('/datagadai');
    }

    public function delete($kode_pinjaman)
    {
        $this->PegadaianModel->delete($kode_pinjaman);
        session()->setFlashdata('Pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/datanasabah');
    }
}