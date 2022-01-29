<?php

namespace App\Controllers;

use App\Models\PegadaianModel;
use App\Models\NasabahModel;
use App\Models\CabangModel;
use App\Models\SaldoModel;
use App\Models\PembayaranModel;
use App\Models\PendapatanModel;
use App\Models\AturanModel;
use App\Models\BarangModel;
use App\Models\LelangModel;
use App\Models\PerpanjanganModel;

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
    protected $AturanModel;
    protected $PerpanjanganModel;
    protected $LelangModel;
    protected $BarangModel;

    public function __construct()
    {
        $this->PegadaianModel = new PegadaianModel();
        $this->NasabahModel = new NasabahModel();
        $this->CabangModel = new CabangModel();
        $this->SaldoModel = new SaldoModel();
        $this->PembayaranModel = new PembayaranModel();
        $this->PendapatanModel = new PendapatanModel();
        $this->AturanModel = new AturanModel();
        $this->BarangModel = new BarangModel();
        $this->LelangModel = new LelangModel();
        $this->PerpanjanganModel = new PerpanjanganModel();
        helper('currency');
    }

    public function index()
    {
        $semua_data_bulanan =  $this->PegadaianModel->get_month_olny();
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $data_gadai = $this->PegadaianModel->getDataGadai($kode_cabang);
        foreach ($data_gadai as $key) {
            $cek_ = '';
            // SELECT * FROM `pinjamangadai` WHERE tgl_jatuh_tempo >= date(NOW()) && tgl_jatuh_tempo <= date(NOW()) + 1
            // $cek_ = $key->tgl_jatuh_tempo == date('Y-m-d') ? 'mark' : 'none';

            $hari_esok = date('Y-m-d', strtotime("+1 day"));
            if ($key->tgl_jatuh_tempo == date('Y-m-d')) {
                $cek_ = 'danger text-white';
            } elseif ($key->tgl_jatuh_tempo == $hari_esok) {
                $cek_ = 'warning text-white';
            } else {
                $cek_ = 'default';
            }
            $key->jatuh_tempo_now = $cek_;
        }
        // $jatuh_tempo = $this->PegadaianModel->sortDate($kode_cabang);
        $data = [
            'title' => 'Data Gadai',
            'gadai' => $data_gadai,
            'semua_data_bulanan' => $semua_data_bulanan
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
        $saldo = (!empty($this->SaldoModel->getSisa($kode_cabang)[0]['sisa_kas']) ? $this->SaldoModel->getSisa($kode_cabang)[0]['sisa_kas'] : '0');
        $data = [
            'gadai' => $this->PegadaianModel->findAll(),
            'nasabah' => $data_nasabah,
            'cabang' => $this->CabangModel->findAll(),
            'saldo' => $this->SaldoModel->findAll(),
            'aturan' => $this->AturanModel->findAll(),
            'barang' => $this->BarangModel->findAll(),
            'kode_cabang' => $kode_cabang,
            'saldo_akhir' => $saldo,
            // 'telpNasabah' => $telp_nasabah,
            'title' => 'Form Data Gadai',
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
            'tgl_masuk' => date('Y-m-d'),
            'jenis' => 'Bunga'
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

        // $kode_cabang = $this->request->getVar('kode_cabang');
        // $get_sisa_kas =  $this->SaldoModel->getSisa($kode_cabang);
        // if (!empty($this->SaldoModel->getSisa($kode_cabang))) {
        //     $sisa_kas = $get_sisa_kas[0]['sisa_kas'];
        // } else {
        //     $sisa_kas = 0;
        // }
        // $total_kas = $sisa_kas - $jumlah_pinjaman;
        // $this->SaldoModel->update($kode_cabang, [
        //     'jumlah_kas' => $jumlah_pinjaman,
        //     'sisa_kas' => $total_kas,
        //     'keterangan' => 'Transaksi Pegadaian Baru',
        //     'kode_cabang' => $this->request->getVar('kode_cabang'),
        //     'jenis' => 'keluar',
        // ]);
        // var_dump($total_kas);
        // die;
        session()->setFlashdata('Pesan', 'Data Berhasil Diubah');
        return redirect()->to('/datagadai');
    }

    public function delete($kode_pinjaman)
    {
        $this->PegadaianModel->delete($kode_pinjaman);
        $data = [
            'status'  => 'Berhasil Dihapus',
            'status_text' => 'Data Berhasil Dihapus',
            'status_icon' => 'success'
        ];
        return $this->response->setJSON($data);
    }


    public function createDenda($kode_pinjaman)
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
            'title' => 'Form Denda',
            // 'kode_pinjaman' => $kode_pinjaman,
            'validation' => \Config\Services::validation()
        ];
        return view('pegadaian/formdenda', $data);
    }

    public function saveDenda()
    {
        $jumlah_pinjaman = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_pinjaman'));
        $dendaP = $this->request->getVar('dendaP') / 100;
        $bunga = $this->request->getVar('bunga');
        $denda = floatval($bunga) + (intval($jumlah_pinjaman) * $dendaP);
        $this->PendapatanModel->save([
            'jumlah_untung' => $denda,
            'kd_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'tgl_masuk' => date('Y-m-d'),
            'jenis' => 'denda'
        ]);

        $this->PegadaianModel->update($this->request->getVar('kode_pinjaman'), [
            'tgl_lelang' => $this->request->getVar('tgl_lelang'),
            'tgl_jatuh_tempo' => $this->request->getVar('tgl_jatuh_tempo')
        ]);


        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datagadai');
    }

    public function createBayar($kode_pinjaman)
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;

        $data = [
            'gadai' => $this->PegadaianModel->find($kode_pinjaman),
            'nasabah' => $this->NasabahModel->findAll(),
            'cabang' => $this->CabangModel->findAll(),
            'saldo' => $this->SaldoModel->findAll(),
            'kode_cabang' => $kode_cabang,
            // 'telpNasabah' => $telp_nasabah,
            'title' => 'Form Pembayaran',
            // 'kode_pinjaman' => $kode_pinjaman,
            'validation' => \Config\Services::validation()
        ];
        return view('pegadaian/formbayar', $data);
    }


    public function saveBayar()
    {
        $jumlah_bayar = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_bayar'));

        $this->PembayaranModel->save([
            'kode_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'jumlah_bayar' => $jumlah_bayar,
            'tgl_bayar' => $this->request->getVar('tgl_bayar'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        $kode_cabang = $this->request->getVar('kode_cabang');
        $get_sisa_kas =  $this->SaldoModel->getSisa($kode_cabang);
        if (!empty($this->SaldoModel->getSisa($kode_cabang))) {
            $sisa_kas = $get_sisa_kas[0]['sisa_kas'];
        } else {
            $sisa_kas = 0;
        }
        $total_kas = $sisa_kas + $jumlah_bayar;
        $this->SaldoModel->save([
            'jumlah_kas' => $jumlah_bayar,
            'sisa_kas' => $total_kas,
            'keterangan' => $this->request->getVar('keterangan'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'jenis' => 'pembayaran'
        ]);

        $this->PegadaianModel->update($this->request->getVar('kode_pinjaman'), [
            'status_bayar' => 'Lunas'
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datagadai');
    }

    public function TerLelang()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $data_lelang = $this->LelangModel->getDataLelang($kode_cabang);
        // $jatuh_tempo = $this->PelelanganModel->sortDate($kode_cabang);
        $data = [
            'title' => 'Data lelang',
            'lelang' => $data_lelang
            // 'jTempo' => $jatuh_tempo
        ];
        return view('lelang/terlelang', $data);
    }

    public function AkanLelang()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $data_gadai = $this->PegadaianModel->getDataLelang($kode_cabang, 'hariIni');

        $data = [
            'title' => 'Data Gadai',
            'gadai' => $data_gadai
        ];
        return view('lelang/datalelang', $data);
    }


    public function createLelang($kode_pinjaman)
    {
        $data = [
            'lelang' => $this->LelangModel->findAll(),
            'title' => 'Form Lelang',
            'gadai'  => $this->PegadaianModel->find($kode_pinjaman),
            'validation' => \Config\Services::validation()
        ];
        return view('lelang/formlelang', $data);
    }

    public function saveLelang()
    {
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'kode_pinjaman' => [
                'rules' => 'required',
                'errors'    => [
                    'required'  => '{field} Harus Diisi'
                ]
            ],
            'hasil_lelang' => [
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
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $jumlah_pinjaman = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_pinjaman'));
        $hasil_lelang = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('hasil_lelang'));
        $keuntungan = $hasil_lelang - $jumlah_pinjaman;
        if ($keuntungan <= 0) {
            $keuntungan = 0;
        } else {
            $keuntungan = $hasil_lelang - $jumlah_pinjaman;
        }

        $data = [
            'nama_barang' => $this->request->getVar('nama_barang'),
            'kode_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'hasil_lelang' => $hasil_lelang,
            'tgl_lelang' => $this->request->getVar('tgl_lelang'),
            'kodeCabang' => $this->request->getVar('kode_cabang')
        ];

        $this->LelangModel->simpan($data);

        $this->PendapatanModel->save([
            'jumlah_untung' => $keuntungan,
            'kd_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'tgl_masuk' => date('Y-m-d'),
            'jenis' => 'Lelang'
        ]);

        $kode_cabang = $this->request->getVar('kode_cabang');
        $get_sisa_kas =  $this->SaldoModel->getSisa($kode_cabang);
        if (!empty($this->SaldoModel->getSisa($kode_cabang))) {
            $sisa_kas = $get_sisa_kas[0]['sisa_kas'];
        } else {
            $sisa_kas = 0;
        }
        $total_kas = $sisa_kas + $jumlah_pinjaman;
        $this->SaldoModel->save([
            'jumlah_kas' => $jumlah_pinjaman,
            'sisa_kas' => $total_kas,
            'keterangan' => 'Lelang',
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'jenis' => 'lelang'
        ]);

        $this->PegadaianModel->update($this->request->getVar('kode_pinjaman'), [
            'status_bayar' => 'TERLELANG'
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/terlelang');
    }

    public function createPerpanjang($kode_pinjamann)
    {
        $data_perpanjangan = $this->PerpanjanganModel->get_jatuh_tempo($kode_pinjamann);
        $data_gadai = $this->PegadaianModel->find($kode_pinjamann);
        $data = [
            'gadai' =>  $data_gadai,
            'perpanjangan' => $this->PerpanjanganModel->findAll(),
            'perpanjang_ini' => (count($data_perpanjangan) > 0 ? $data_perpanjangan[0]['tgl_perpanjangan'] : $data_gadai['tgl_jatuh_tempo']),
            'title' => 'Form Perpanjangan',
            'validation' => \Config\Services::validation()
        ];
        return view('pegadaian/formperpanjang', $data);
    }

    public function savePerpanjang()
    {
        $kode_pinjamann = $this->request->getVar('kode_pinjaman');
        $this->PerpanjanganModel->save([
            'kode_pinjamann' => $kode_pinjamann,
            'tgl_perpanjangan' => $this->request->getVar('tgl_perpanjangan')
        ]);

        $this->PegadaianModel->update($kode_pinjamann, [
            'tgl_jatuh_tempo' => $this->request->getVar('tgl_perpanjangan'),
            'tgl_lelang' => $this->request->getVar('tgl_lelang'),
        ]);

        $bunga = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('bunga'));
        $this->PendapatanModel->save([
            'jumlah_untung' => $bunga,
            'kd_pinjaman' => $kode_pinjamann,
            'jenis' => 'bunga'
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/datagadai');
    }


    public function list()
    {
        helper('bulan');
        // echo $this->request->getGet('halo');
        $query = $this->request->getGet('sSearch');
        $start = $this->request->getGet('iDisplayStart');
        $length = $this->request->getGet('iDisplayLength');
        $keySearch = 'kode_pinjaman';
        // var_dump($query);
        // die;
        if (!empty($query)) {
            $extract = explode("_", $query);
            $query = $extract[0];
            $keySearch = $extract[1];
            if (count($extract) >= 3) {
                $keySearch = $extract[1] . '_' . $extract[2];
            }
        }
        // echo $this->PegadaianModel->count_filter('CB01');
        // die;
        $result['sEcho'] = intval($this->request->getGet('sEcho'));
        $result['iTotalRecords'] = $this->PegadaianModel->countAllResults();
        $result['iTotalDisplayRecords'] = $this->PegadaianModel->count_filter($query);
        if ($length == -1) $length = $result['iTotalDisplayRecords'];
        $data_gadai = $this->PegadaianModel->listDataGadai($start, $length, $query, $keySearch);
        $i = $start + 1;

        foreach ($data_gadai as $key) {
            $key->no = $i;
            $key->kodepinjaman = $key->kode_pinjaman;
            $key->tgl_gadai = bulan($key->tgl_gadai);
            $key->update_url = base_url() . '/pegadaian/edit/' . $key->kode_pinjaman;
            $key->delete_url = base_url() . '/pegadaian/delete/' . $key->kode_pinjaman;
            $key->pembayaran_url = base_url() . '/pegadaian/createBayar/' . $key->kode_pinjaman;
            $key->perpanjangan_url = base_url() . '/pegadaian/createPerpanjang/' . $key->kode_pinjaman;
            $key->denda_url = base_url() . '/pegadaian/createDenda/' . $key->kode_pinjaman;
            $key->lelang_url = base_url() . '/pegadaian/createLelang/' . $key->kode_pinjaman;

            $tgl_besok = date('Y-m-d', strtotime("+1 day"));
            $key->sudah_jatuh_tempo = ($key->tgl_jatuh_tempo < date('Y-m-d')) ? true : false;
            $key->jatuh_tempo_hari_ini = ($key->tgl_jatuh_tempo == date('Y-m-d')) ? true : false;
            $key->jatuh_tempo_besok = ($key->tgl_jatuh_tempo == $tgl_besok) ? true : false;
            $key->tgl_jatuh_tempo = bulan($key->tgl_jatuh_tempo);
            $key->tgl_lelang = bulan($key->tgl_lelang);
            $key->tgl_perpanjangan = (!empty($key->tgl_perpanjangan)) ? bulan($key->tgl_perpanjangan) : '-';
            $i++;
        }
        $result['aaData'] = $data_gadai;
        echo json_encode($result);
    }
}