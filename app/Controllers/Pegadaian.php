<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\NasabahModel;
use App\Models\CabangModel;
use App\Models\SaldoModel;
use App\Models\PembayaranModel;
use App\Models\PendapatanModel;
use App\Models\AturanModel;

class Pegadaian extends BaseController
{
    protected $PegadaianModel;
    protected $NasabahModel;
    protected $CabangModel;
    protected $SaldoModel;
    protected $cabang;
    protected $telp;
    protected $PembayaranModel;
    protected $PendapatanModel;
    protected $AturananModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->NasabahModel = new NasabahModel();
        $this->CabangModel = new CabangModel();
        $this->SaldoModel = new SaldoModel();
        $this->PembayaranModel = new PembayaranModel();
        $this->PendapatanModel = new PendapatanModel();
        $this->AturanModel = new AturanModel();
        helper('currency');
    }

    public function index()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $data_gadai = $this->PegadaianModel->getDataGadai($kode_cabang);
        // $jatuh_tempo = $this->PegadaianModel->sortDate($kode_cabang);
        $data = [
            'title' => 'Data Gadai',
            'gadai' => $data_gadai
            // 'jTempo' => $jatuh_tempo
        ];
        return view('pegadaian/datagadai', $data);
    }

    public function create()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $data_nasabah = $this->NasabahModel->getDataNasabah($kode_cabang);
        // $kode_cabang = @$_GET['kode_cabang'];
        $kode_pinjaman = 'Pilih Cabang terlebih dahulu';
        if (!empty($kode_cabang)) {
            $this->cabang = $kode_cabang;
            $kode_pinjaman = $this->PegadaianModel->create_kode_pinjaman($this->cabang);
        }
        $this->cabang = $kode_cabang;

        $data = [
            'gadai' => $this->PegadaianModel->findAll(),
            'nasabah' => $data_nasabah,
            'cabang' => $this->CabangModel->findAll(),
            'saldo' => $this->SaldoModel->findAll(),
            'aturan' => $this->AturanModel->findAll(),
            'kode_cabang' => $kode_cabang,
            // 'telpNasabah' => $telp_nasabah,
            // 'title' => 'Form Data Gadai',
            'kode_pinjaman' => $kode_pinjaman,
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
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'kode_cabang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'no_telp' => [
                'rules' => 'required|numeric|max_length[15]|min_length[10]',
                'errors'    => [
                    'required'  => 'Data Harus Diisi',
                    'numeric'  => 'Data Hanya Berisi Angka',
                    'max_length'  => 'Data Isi maximal 15 angka',
                    'min_length'  => 'Data Isi minimal 10 angka',
                ]
            ],
            'jenis_barang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'seri' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'kelengkapan' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors'    => [
                    'required'  => 'Data Harus Diisi',
                    'numeric'  => 'Data Hanya Berisi Angka'
                ]
            ],
            'kondisi' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'tgl_gadai' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'tgl_jatuh_tempo' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'tgl_lelang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'jumlah_pinjaman' => [
                'rules' => 'required|alpha_numeric_punct|min_length[6]|max_length[30]',
                'errors'    => [
                    'required'  => 'Data Harus Diisi',
                    'alpha_numeric_punct'  => 'Data Hanya Berisi Angka',
                    'min_length'  => 'Pinjaman minimal Rp.100.000',
                    'max_length'  => 'Pinjaman maksimal Rp.9.999.999.999'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $jumlah_pinjaman = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_pinjaman'));
        $bungaP = $this->request->getVar('bungaP') / 100;
        $bunga = intval($jumlah_pinjaman) * $bungaP;
        $data = [
            'kode_pinjaman' => $this->request->getVar('kode_pinjaman'),
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
            'jumlah_pinjaman' =>  $jumlah_pinjaman,
            'bunga' => intval($bunga),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'status_bayar' => 'Belum Lunas'
        ];
        $this->PegadaianModel->simpan($data);

        $kode_cabang = $this->request->getVar('kode_cabang');
        $get_sisa_kas =  $this->SaldoModel->getSisa($kode_cabang);
        if (!empty($this->SaldoModel->getSisa($kode_cabang))) {
            $sisa_kas = $get_sisa_kas[0]['sisa_kas'];
        } else {
            $sisa_kas = 0;
        }
        $total_kas = $sisa_kas - intval($jumlah_pinjaman);
        $this->SaldoModel->save([
            'jumlah_kas' => $jumlah_pinjaman,
            'sisa_kas' => $total_kas,
            'keterangan' => 'Transaksi Pegadaian Baru',
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'jenis' => 'keluar'
        ]);

        $this->PendapatanModel->save([
            'jumlah_untung' => $bunga,
            'kd_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'jenis' => 'Bunga'
        ]);
        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datagadai');
    }

    public function create2($kode_pinjaman)
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        // $kode_cabang = @$_GET['kode_cabang'];
        // $kode_pinjaman = 'Pilih Cabang terlebih dahulu';
        // if (!empty($kode_cabang)) {
        //     $this->cabang = $kode_cabang;
        //     $kode_pinjaman = $this->PegadaianModel->create_kode_pinjaman($this->cabang);
        // }
        // $this->cabang = $kode_cabang;

        // $id_nasabah = @$_GET['id_nasabah'];
        // $telp_nasabah = 'Pilih Nasabah';
        // if (!empty($id_nasabah)) {
        //     $this->telp = $id_nasabah;
        //     $telp_nasabah = $this->PegadaianModel->getTelp($this->telp);
        // }
        // $this->telp = $id_nasabah;


        $data = [
            'gadai' => $this->PegadaianModel->find($kode_pinjaman),
            'nasabah' => $this->NasabahModel->findAll(),
            'cabang' => $this->CabangModel->findAll(),
            'saldo' => $this->SaldoModel->findAll(),
            'kode_cabang' => $kode_cabang,
            // 'telpNasabah' => $telp_nasabah,
            // 'title' => 'Form Data Gadai',
            // 'kode_pinjaman' => $kode_pinjaman,
            'validation' => \Config\Services::validation()
        ];
        return view('pegadaian/formdenda', $data);
    }

    public function save2()
    {


        $jumlah_pinjaman = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_pinjaman'));
        $dendaP = $this->request->getVar('dendaP') / 100;
        $denda = intval($jumlah_pinjaman) * $dendaP;
        $this->PendapatanModel->save([
            'jumlah_untung' => $denda,
            'kd_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'jenis' => 'Denda'
        ]);

        $this->PegadaianModel->update($this->request->getVar('kode_pinjaman'), [
            'tgl_lelang' => $this->request->getVar('tgl_lelang')
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
            'aturan' => $this->AturanModel->findAll(),
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
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'no_telp' => [
                'rules' => 'required|numeric|max_length[15]|min_length[10]',
                'errors'    => [
                    'required'  => 'Data Harus Diisi',
                    'numeric'  => 'Data Hanya Berisi Angka',
                    'max_length'  => 'Data Isi maximal 15 angka',
                    'min_length'  => 'Data Isi minimal 10 angka',
                ]
            ],
            'jenis_barang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'seri' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'kelengkapan' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors'    => [
                    'required'  => 'Data Harus Diisi',
                    'numeric'  => 'Data Hanya Berisi Angka'
                ]
            ],
            'kondisi' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'tgl_gadai' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'tgl_jatuh_tempo' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'tgl_lelang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => 'Data Harus Diisi'
                ]
            ],
            'jumlah_pinjaman' => [
                'rules' => 'required|alpha_numeric_punct|min_length[6]|max_length[30]',
                'errors'    => [
                    'required'  => 'Data Harus Diisi',
                    'alpha_numeric_punct'  => 'Data Hanya Berisi Angka',
                    'min_length'  => 'Pinjaman minimal Rp.100.000',
                    'max_length'  => 'Pinjaman maksimal Rp.9.999.999.999'
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $jumlah_pinjaman = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_pinjaman'));
        $bungaP = $this->request->getVar('bungaP') / 100;
        $bunga = intval($jumlah_pinjaman) * $bungaP;
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
            'jumlah_pinjaman' => $jumlah_pinjaman,
            'bunga' => $bunga,
            'status_bayar' => 'Belum Lunas'
        ]);

        $kode_cabang = $this->request->getVar('kode_cabang');
        $get_sisa_kas =  $this->SaldoModel->getSisa($kode_cabang);
        if (!empty($this->SaldoModel->getSisa($kode_cabang))) {
            $sisa_kas = $get_sisa_kas[0]['sisa_kas'];
        } else {
            $sisa_kas = 0;
        }
        $total_kas = $sisa_kas - $jumlah_pinjaman;
        $this->SaldoModel->update($kode_cabang, [
            'jumlah_kas' => $jumlah_pinjaman,
            'sisa_kas' => $total_kas,
            'keterangan' => 'Transaksi Pegadaian Baru',
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'jenis' => 'keluar',
        ]);
        var_dump($total_kas);
        die;
        session()->setFlashdata('Pesan', 'Data Berhasil Diubah');
        return redirect()->to('/datagadai');
    }

    public function delete($kode_pinjaman)
    {
        $this->PegadaianModel->delete($kode_pinjaman);
        session()->setFlashdata('Pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/datagadai');
    }
}