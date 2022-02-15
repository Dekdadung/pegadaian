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
use App\Models\HistoriModel;
// use App\Libraries\PHPExcel;
use PHPExcel;
use PHPExcel_IOFactory;

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
    protected $HistoriModel;

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
        $this->HistoriModel = new HistoriModel();
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
        return view('Pegadaian/datagadai', $data);
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

        return view('Pegadaian/formgadai', $data);
    }

    public function save()
    {
        // $data = $this->request->getPost();
        // var_dump($data);
        // die;

        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $data_nasabah = $this->NasabahModel->getDataNasabah($kode_cabang);
        $this->cabang = $kode_cabang;
        $kode_pinjaman = $this->PegadaianModel->create_kode_pinjaman($this->cabang);

        $jumlah_pinjaman = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_pinjaman'));
        $bungaP = $this->request->getVar('bungaP') / 100;
        $bunga = intval($jumlah_pinjaman) * $bungaP;
        $data = [
            'kode_pinjaman' => $kode_pinjaman,
            'id_nasabah' => $this->request->getVar('id_nasabah'),
            'jenis_barang' => $this->request->getVar('jenis_barang'),
            'seri' => $this->request->getVar('seri'),
            'kelengkapan' => $this->request->getVar('kelengkapan'),
            'password' => $this->request->getVar('password'),
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
            'keterangan' => 'Transaksi Pegadaian Baru dengan kode ' . $this->request->getVar('kode_pinjaman'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'jenis' => 'keluar'
        ]);

        $this->PendapatanModel->save([
            'jumlah_untung' => $bunga,
            'kd_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'tgl_masuk' => date('Y-m-d'),
            'jenis' => 'Bunga'
        ]);
        $data = [
            'status'  => 'Berhasil',
            'status_text' => 'Data Berhasil Disimpan',
            'status_icon' => 'success',
            'print_url' => base_url('Pegadaian/cetaknota/' . $kode_pinjaman),
            'redirect_url' => base_url('datagadai')
        ];
        return $this->response->setJSON($data);
        // session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        // return redirect()->to('/datagadai');
    }

    public function edit($kode_pinjaman)
    {
        $data = [
            'gadai'  => $this->PegadaianModel->find($kode_pinjaman),
            'cabang' => $this->CabangModel->findAll(),
            'nasabah' => $this->NasabahModel->findAll(),
            'barang' => $this->BarangModel->findAll(),
            'aturan' => $this->AturanModel->findAll(),
            'title' => 'Form Data Gadai',
            'validation' => \Config\Services::validation()
        ];

        return view('Pegadaian/edit', $data);
    }

    public function update($kode_pinjaman)
    {
        if (!$this->validate([
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
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // $jumlah_pinjaman = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_pinjaman'));
        // $bungaP = $this->request->getVar('bungaP') / 100;
        // $bunga = intval($jumlah_pinjaman) * $bungaP;
        $this->PegadaianModel->update($kode_pinjaman, [
            // 'id_nasabah' => $this->request->getVar('id_nasabah'),
            'jenis_barang' => $this->request->getVar('jenis_barang'),
            'seri' => $this->request->getVar('seri'),
            'kelengkapan' => $this->request->getVar('kelengkapan'),
            'password' => $this->request->getVar('password'),
            'jumlah' => $this->request->getVar('jumlah'),
            'kondisi' => $this->request->getVar('kondisi'),
            // 'tgl_gadai' => $this->request->getVar('tgl_gadai'),
            // 'tgl_jatuh_tempo' => $this->request->getVar('tgl_jatuh_tempo'),
            // 'tgl_lelang' => $this->request->getVar('tgl_lelang'),
            // 'jumlah_pinjaman' => $jumlah_pinjaman,
            // 'bunga' => $bunga,
            // 'status_bayar' => 'Belum Lunas'
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
        $jumlah_pinjaman = $this->PegadaianModel->cek_peminjaman($kode_pinjaman);
        if (!empty($jumlah_pinjaman) && !empty($kode_pinjaman)) {
            //restore saldo kembali bertambah sesuai jumlah yg dipinjam sebelumnya.
            // $kode_cabang = $this->request->getVar('kode_cabang');
            $cek_cabang_user = session('kode_cabang');
            $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
            $get_sisa_kas =  $this->SaldoModel->getSisa($kode_cabang);
            if (!empty($this->SaldoModel->getSisa($kode_cabang))) {
                $sisa_kas = $get_sisa_kas[0]['sisa_kas'];
            } else {
                $sisa_kas = 0;
            }
            $total_kas = $sisa_kas + intval($jumlah_pinjaman);
            $update_saldo = $this->SaldoModel->save([
                'jumlah_kas' => $jumlah_pinjaman,
                'sisa_kas' => $total_kas,
                'keterangan' => 'Pembatalan Transaksi ' . $kode_pinjaman . '. Dana Sudah dikembalikan ke saldo',
                'kode_cabang' => $kode_cabang,
                'jenis' => 'pembatalan'
            ]);

            // hapus data pendapatn
            $delete = $this->PendapatanModel->Pendapatan_batal($kode_pinjaman);
            $hapus_pinjaman = $this->PegadaianModel->delete($kode_pinjaman);

            if ($delete == true && $hapus_pinjaman == true && $update_saldo == true) {
                $data = [
                    'status'  => 'Berhasil Dihapus',
                    'status_text' => 'Data Berhasil Dihapus',
                    'status_icon' => 'success'
                ];
            }
            return $this->response->setJSON($data);
        }
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
        return view('Pegadaian/formdenda', $data);
    }

    public function saveDenda()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;

        $data = [
            'status'  => 'Gagal',
            'status_text' => 'Gagal Update, terjadi Kesalahan!',
            'status_icon' => 'warning',
            'redirect_url' => base_url('datalelang')
        ];
        $jumlah_pinjaman = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_pinjaman'));
        $dendaP = $this->request->getVar('dendaP') / 100;
        $bunga = $this->request->getVar('bunga');
        $denda = floatval($bunga) + (intval($jumlah_pinjaman) * $dendaP);
        $save_pendapatan = $this->PendapatanModel->save([
            'jumlah_untung' => $denda,
            'kd_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'tgl_masuk' => date('Y-m-d'),
            'jenis' => 'denda',
            'keterangan' => $this->request->getVar('keterangan'),
        ]);
        $update_tgl = $this->PegadaianModel->update($this->request->getVar('kode_pinjaman'), [
            'tgl_lelang' => $this->request->getVar('tgl_lelang'),
            'tgl_jatuh_tempo' => $this->request->getVar('tgl_jatuh_tempo')
        ]);
        $simpan_histori = $this->HistoriModel->save([
            'kode_pinjaman_gadai' => $this->request->getVar('kode_pinjaman'),
            'kode_cb' => $kode_cabang,
            'tanggal' => date('Y-m-d'),
            'dana' => $denda,
            'jenis' => 'denda',
            'keterangan' => 'Keuntungan Denda'
        ]);

        if ($save_pendapatan == true && $update_tgl == true && $simpan_histori == true) {
            $data = [
                'status'  => 'Berhasil',
                'status_text' => 'Pinjaman telah diAktifkan kembali',
                'status_icon' => 'success',
                'redirect_url' => base_url('datalelang')
            ];
        }
        return $this->response->setJSON($data);
        // session()->setFlashdata('Pesan', 'Pinjaman telah diAktifkan kembali');
        // return redirect()->to('/datagadai');
    }

    public function createTebus($kode_pinjaman)
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
            'title' => 'Form Penebusan Lelang',
            // 'kode_pinjaman' => $kode_pinjaman,
            'validation' => \Config\Services::validation()
        ];
        return view('Lelang/formtebus', $data);
    }

    public function saveTebus()
    {
        $data = [
            'status'  => 'Gagal',
            'status_text' => 'Gagal Update, terjadi Kesalahan!',
            'status_icon' => 'warning',
            'redirect_url' => base_url('datalelang')
        ];
        $jumlah_bayar = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_bayar'));
        $dendaP = $this->request->getVar('dendaP') / 100;
        $save_pembayaran = $this->PembayaranModel->save([
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
        $update_saldo = $this->SaldoModel->save([
            'jumlah_kas' => $jumlah_bayar,
            'sisa_kas' => $total_kas,
            'keterangan' => $this->request->getVar('keterangan'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'jenis' => 'pembayaran'
        ]);
        $update_status_bayar = $this->PegadaianModel->update($this->request->getVar('kode_pinjaman'), [
            'status_bayar' => 'Lunas'
        ]);
        $untung = $jumlah_bayar * $dendaP;
        $insert_pendapatan = $this->PendapatanModel->save([
            'jumlah_untung' => $untung,
            'kd_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'tgl_masuk' => date('Y-m-d'),
            'jenis' => 'denda',
            'keterangan' => $this->request->getVar('keterangan'),
        ]);
        $simpan_histori = $this->HistoriModel->save([
            'kode_pinjaman_gadai' => $this->request->getVar('kode_pinjaman'),
            'kode_cb' => $kode_cabang,
            'tanggal' => date('Y-m-d'),
            'dana' => $jumlah_bayar,
            'jenis' => 'penebusan',
            'keterangan' => 'Jumlah Pinjaman'
        ]);
        $simpan_histori2 = $this->HistoriModel->save([
            'kode_pinjaman_gadai' => $this->request->getVar('kode_pinjaman'),
            'kode_cb' => $kode_cabang,
            'tanggal' => date('Y-m-d'),
            'dana' => $untung,
            'jenis' => 'denda',
            'keterangan' => 'Keuntungan Tebus'
        ]);
        if ($save_pembayaran == true && $update_saldo == true && $update_status_bayar == true && $simpan_histori == true && $simpan_histori2 == true && $insert_pendapatan == true) {
            $data = [
                'status'  => 'Berhasil',
                'status_text' => 'Barang Berhasil Ditebus!',
                'status_icon' => 'success',
                'redirect_url' => base_url('datalelang')
            ];
        }
        return $this->response->setJSON($data);

        // session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        // return redirect()->to('/datagadai');
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
        return view('Pegadaian/formbayar', $data);
    }


    public function saveBayar()
    {
        $data = [
            'status'  => 'Gagal',
            'status_text' => 'Gagal Update, terjadi Kesalahan!',
            'status_icon' => 'warning',
            'redirect_url' => base_url('datagadai')
        ];
        $jumlah_bayar = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('jumlah_bayar'));

        $simpan_pembayaran = $this->PembayaranModel->save([
            'kode_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'jumlah_bayar' => $jumlah_bayar,
            'tgl_bayar' => $this->request->getVar('tgl_bayar'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        $kode_cabang = $this->request->getVar('kode_cabang');

        $simpan_histori = $this->HistoriModel->save([
            'kode_pinjaman_gadai' => $this->request->getVar('kode_pinjaman'),
            'kode_cb' => $kode_cabang,
            'tanggal' => $this->request->getVar('tgl_bayar'),
            'dana' => $jumlah_bayar,
            'jenis' => 'penebusan',
            'keterangan' => 'Penebusan Barang'
        ]);

        $get_sisa_kas =  $this->SaldoModel->getSisa($kode_cabang);
        if (!empty($this->SaldoModel->getSisa($kode_cabang))) {
            $sisa_kas = $get_sisa_kas[0]['sisa_kas'];
        } else {
            $sisa_kas = 0;
        }
        $total_kas = $sisa_kas + $jumlah_bayar;
        $update_saldo = $this->SaldoModel->save([
            'jumlah_kas' => $jumlah_bayar,
            'sisa_kas' => $total_kas,
            'keterangan' => $this->request->getVar('keterangan'),
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'jenis' => 'pembayaran'
        ]);

        $update_status_bayar = $this->PegadaianModel->update($this->request->getVar('kode_pinjaman'), [
            'status_bayar' => 'Lunas'
        ]);
        if ($simpan_pembayaran == true && $update_saldo == true && $simpan_histori == true && $update_status_bayar == true) {
            $data = [
                'status'  => 'Berhasil',
                'status_text' => 'Barang Berhasil Ditebus!',
                'status_icon' => 'success',
                'redirect_url' => base_url('datagadai')
            ];
        }
        return $this->response->setJSON($data);

        // session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        // return redirect()->to('/datagadai');
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
        return view('Lelang/terlelang', $data);
    }

    public function AkanLelang()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        // $data_gadai = $this->PegadaianModel->getDataLelang($kode_cabang, 'hariIni');

        $data = [
            'title' => 'Data Lelang',
            // 'gadai' => $data_gadai
        ];
        return view('Lelang/datalelang', $data);
    }


    public function createLelang($kode_pinjaman)
    {
        $data = [
            // 'lelang' => $this->LelangModel->findAll(),
            'title' => 'Form Lelang',
            'gadai'  => $this->PegadaianModel->get_detail_pegadaian($kode_pinjaman),
            'validation' => \Config\Services::validation()
        ];
        return view('Lelang/formlelang', $data);
    }

    public function saveLelang()
    {
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
            'kodeCabang' => $this->request->getVar('kode_cabang'),
            'keterangan' => $this->request->getVar('keterangan')
        ];

        $save_lelang = $this->LelangModel->simpan($data);
        $insert_pendapatan = $this->PendapatanModel->save([
            'jumlah_untung' => $keuntungan,
            'kd_pinjaman' => $this->request->getVar('kode_pinjaman'),
            'tgl_masuk' => date('Y-m-d'),
            'jenis' => 'Lelang',
            'keterangan' => $this->request->getVar('keterangan')
        ]);
        $kode_cabang = $this->request->getVar('kode_cabang');
        $get_sisa_kas =  $this->SaldoModel->getSisa($kode_cabang);
        if (!empty($this->SaldoModel->getSisa($kode_cabang))) {
            $sisa_kas = $get_sisa_kas[0]['sisa_kas'];
        } else {
            $sisa_kas = 0;
        }
        $total_kas = $sisa_kas + $jumlah_pinjaman;
        $update_saldo = $this->SaldoModel->save([
            'jumlah_kas' => $jumlah_pinjaman,
            'sisa_kas' => $total_kas,
            'keterangan' => 'Lelang',
            'kode_cabang' => $this->request->getVar('kode_cabang'),
            'jenis' => 'lelang'
        ]);
        $update_status_bayar = $this->PegadaianModel->update($this->request->getVar('kode_pinjaman'), [
            'status_bayar' => 'TERLELANG'
        ]);
        $simpan_histori = $this->HistoriModel->save([
            'kode_pinjaman_gadai' => $this->request->getVar('kode_pinjaman'),
            'kode_cb' => $kode_cabang,
            'tanggal' => date('Y-m-d'),
            'dana' => $keuntungan,
            'jenis' => 'denda',
            'keterangan' => 'Keuntungan Lelang'
        ]);
        $simpan_histori2 = $this->HistoriModel->save([
            'kode_pinjaman_gadai' => $this->request->getVar('kode_pinjaman'),
            'kode_cb' => $kode_cabang,
            'tanggal' => date('Y-m-d'),
            'dana' => $jumlah_pinjaman,
            'jenis' => 'penebusan',
            'keterangan' => 'Jumlah Pinjaman'
        ]);
        if ($save_lelang == true && $update_saldo == true && $simpan_histori == true && $simpan_histori2 == true && $update_status_bayar == true && $insert_pendapatan == true) {
            $data = [
                'status'  => 'Berhasil',
                'status_text' => 'Barang Berhasil diLelang!',
                'status_icon' => 'success',
                'redirect_url' => base_url('datalelang')
            ];
        } else {
            $data = [
                'status'  => 'Gagal',
                'status_text' => 'Gagal Update, terjadi Kesalahan!',
                'status_icon' => 'warning',
                'redirect_url' => base_url('datalelang')
            ];
        }
        return $this->response->setJSON($data);

        // session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan');
        // return redirect()->to('/terlelang');
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
        return view('Pegadaian/formperpanjang', $data);
    }

    public function savePerpanjang()
    {
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $kode_pinjamann = $this->request->getVar('kode_pinjaman');
        $save_perpanjang = $this->PerpanjanganModel->save([
            'kode_pinjamann' => $kode_pinjamann,
            'tgl_perpanjangan' => $this->request->getVar('tgl_perpanjangan')
        ]);

        $update_tgl = $this->PegadaianModel->update($kode_pinjamann, [
            'tgl_jatuh_tempo' => $this->request->getVar('tgl_perpanjangan'),
            'tgl_lelang' => $this->request->getVar('tgl_lelang'),
        ]);

        $bunga = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->request->getVar('bunga'));
        $update_pendapatan = $this->PendapatanModel->save([
            'jumlah_untung' => $bunga,
            'kd_pinjaman' => $kode_pinjamann,
            'keterangan' => $this->request->getVar('keterangan'),
            'jenis' => 'bunga'
        ]);

        $simpan_histori = $this->HistoriModel->save([
            'kode_pinjaman_gadai' => $kode_pinjamann,
            'kode_cb' => $kode_cabang,
            'tanggal' => date('Y-m-d'),
            'dana' => $bunga,
            'jenis' => 'perpanjangan',
            'keterangan' => 'Bunga Perpanjangan'
        ]);

        if ($save_perpanjang == true && $update_tgl == true && $simpan_histori == true && $update_pendapatan == true) {
            $data = [
                'status'  => 'Berhasil',
                'status_text' => 'Berhasil Diperpanjang!',
                'status_icon' => 'success',
                'redirect_url' => base_url('datagadai')
            ];
        } else {
            $data = [
                'status'  => 'Gagal',
                'status_text' => 'Gagal Update, terjadi Kesalahan!',
                'status_icon' => 'warning',
                'redirect_url' => base_url('datagadai')
            ];
        }
        return $this->response->setJSON($data);
        // session()->setFlashdata('Pesan', 'Perpanjangan ' . $kode_pinjamann . ' berhasil dibuat');
        // return redirect()->to('/datagadai');
    }


    public function list()
    {
        helper('bulan');
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        // echo $this->request->getGet('halo');
        // $query = $this->request->getGet('sSearch');
        // $start = $this->request->getGet('iDisplayStart');
        // $length = $this->request->getGet('iDisplayLength');
        if (
            isset($_GET["columns"][1]["search"]["value"]) && $_GET["columns"][1]["search"]["value"] != ""
        ) {
            $temp = explode("|", $_GET["columns"][1]["search"]["value"]);
            $_GET['tanggal_start'] = (isset($temp[1]) ? $temp[0] : date("Y-m-d", 0));
            $_GET['tanggal_end'] = (isset($temp[1]) ? $temp[1] : date("Y-m-d"));
        }
        // echo $_GET['tanggal_start'];
        // echo '<br>';
        // echo $_GET['tanggal_end'];
        // $date = date("Y-m-d", $temp);
        $tgl_besok = date('Y-m-d', strtotime("+1 day"));
        $query = $this->request->getGet('search')["value"];
        $start = $this->request->getGet('start');
        $length = $this->request->getGet('length');
        $date_range_type = strtotime($query);

        $type_data = (!empty($this->request->getGet('type_data'))) ? $this->request->getGet('type_data') : '';
        $keySearch = 'kode_pinjaman';
        if (!empty($query) && $date_range_type == false) {
            $extract = explode("_", $query);
            $query = $extract[0];
            $keySearch = $extract[1];
            if (count($extract) >= 3) {
                $keySearch = $extract[1] . '_' . $extract[2];
            }
        } else {
            $keySearch = 'tgl_gadai';
        }
        // echo $this->PegadaianModel->count_filter('CB01');
        // die;
        $result['sEcho'] = intval($this->request->getGet('sEcho'));
        $result['iTotalRecords'] = $this->PegadaianModel->countResultTable($kode_cabang, $type_data);
        $result['iTotalDisplayRecords'] = $this->PegadaianModel->count_filter($query, $kode_cabang, $type_data, $keySearch);
        if ($length == -1) $length = $result['iTotalDisplayRecords'];
        $data_gadai = $this->PegadaianModel->listDataGadai($start, $length, $query, $keySearch, $kode_cabang, $type_data);
        $i = $start + 1;

        foreach ($data_gadai as $key) {
            $key->no = $i;
            $key->kodepinjaman = $key->kode_pinjaman;
            $key->tgl_gadai = bulan($key->tgl_gadai);
            $key->update_url = base_url() . '/pegadaian/edit/' . $key->kode_pinjaman;
            $key->delete_url = base_url() . '/pegadaian/delete/' . $key->kode_pinjaman;
            $key->pembayaran_url = base_url() . '/pegadaian/createBayar/' . $key->kode_pinjaman;
            $key->penebusan_url = base_url() . '/Pegadaian/createTebus/' . $key->kode_pinjaman;
            $key->perpanjangan_url = base_url() . '/pegadaian/createPerpanjang/' . $key->kode_pinjaman;
            $key->denda_url = base_url() . '/pegadaian/createDenda/' . $key->kode_pinjaman;
            $key->lelang_url = base_url() . '/pegadaian/createLelang/' . $key->kode_pinjaman;
            $key->urlNota = base_url() . '/Pegadaian/cetaknota/' . $key->kode_pinjaman;

            $key->sudah_jatuh_tempo = ($key->tgl_jatuh_tempo < date('Y-m-d')) ? true : false;
            $key->sudah_harus_lelang = ($key->tgl_lelang < date('Y-m-d')) ? true : false;
            $key->sudah_bisa_lelang = ($key->tgl_lelang == date('Y-m-d')) ? true : false;
            $key->jatuh_tempo_hari_ini = ($key->tgl_jatuh_tempo == date('Y-m-d')) ? true : false;
            $key->jatuh_tempo_besok = ($key->tgl_jatuh_tempo == $tgl_besok) ? true : false;
            $key->mark_status = ($key->jatuh_tempo_hari_ini == true || $key->jatuh_tempo_besok == true) ? true : false;
            $key->tgl_jatuh_tempo = bulan($key->tgl_jatuh_tempo);
            $key->tgl_lelang = bulan($key->tgl_lelang);
            // $key->tgl_perpanjangan = (!empty($key->tgl_perpanjangan)) ? bulan($key->tgl_perpanjangan) : '-';
            $key->jumlah_pinjaman = rupiah($key->jumlah_pinjaman);
            $key->bunga = rupiah($key->bunga);
            $i++;
        }
        $result['aaData'] = $data_gadai;
        echo json_encode($result);
    }

    public function list_laporan()
    {
        helper('bulan');

        if (
            isset($_GET["columns"][1]["search"]["value"]) && $_GET["columns"][1]["search"]["value"] != ""
        ) {
            $temp = explode("|", $_GET["columns"][1]["search"]["value"]);
            $_GET['tanggal_start'] = (isset($temp[1]) ? $temp[0] : date("Y-m-d", 0));
            $_GET['tanggal_end'] = (isset($temp[1]) ? $temp[1] : date("Y-m-d"));
        }

        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $query = $this->request->getGet('sSearch');
        $start = $this->request->getGet('iDisplayStart');
        $length = $this->request->getGet('iDisplayLength');
        $type_data = $this->request->getGet('type_data');
        $date_range_type = strtotime($query);
        $keySearch = 'kode_pinjaman';
        if (!empty($query) && $date_range_type == false) {
            $extract = explode("_", $query);
            $query = $extract[0];
            $keySearch = $extract[1];
            if (count($extract) >= 3) {
                $keySearch = $extract[1] . '_' . $extract[2];
            }
        } else {
            $keySearch = 'tgl_gadai';
        }

        $result['sEcho'] = intval($this->request->getGet('sEcho'));
        $result['iTotalRecords'] = $this->PegadaianModel->countResultTable();
        $result['iTotalDisplayRecords'] = $this->PegadaianModel->count_filter($query, $kode_cabang, $type_data, $keySearch);
        if ($length == -1) $length = $result['iTotalDisplayRecords'];
        $data_gadai = $this->PegadaianModel->getDataGadaiLaporan($start, $length, $query, $keySearch, $kode_cabang, $type_data);

        $i = $start + 1;
        foreach ($data_gadai as $key) {
            $key->no = $i;
            $cek_ = '';
            $hari_esok = date('Y-m-d', strtotime("+1 day"));
            if ($key->tgl_jatuh_tempo == date('Y-m-d')) {
                $cek_ = 'danger text-white';
            } elseif ($key->tgl_jatuh_tempo == $hari_esok) {
                $cek_ = 'warning text-white';
            } elseif ($key->tgl_jatuh_tempo < date('Y-m-d') && $key->status_bayar != 'Lunas') {
                $cek_ = 'dark';
            } elseif ($key->status_bayar == 'Lunas') {
                $cek_ = 'success';
            } else {
                $cek_ = 'default';
            }
            // $key->bunga = rupiah($key->bunga);
            $key->jumlah_pinjaman = rupiah($key->jumlah_pinjaman);
            $data_cek_dendanya = $this->PegadaianModel->cek_pendapatan_peminjaman('Denda', $key->kode_pinjaman)->jumlah_untung;
            $data_cek_lelangya = $this->PegadaianModel->cek_pendapatan_peminjaman('Lelang', $key->kode_pinjaman)->jumlah_untung;
            $key->pendapatan_denda = ($data_cek_dendanya) ? rupiah($data_cek_dendanya) : '0';
            $key->pendapatan_lelang = ($data_cek_lelangya) ? rupiah($data_cek_lelangya) : '0';
            $key->total_pendapatan_bersih = rupiah($key->bunga + $data_cek_dendanya + $data_cek_lelangya);
            $key->bunga = rupiah($key->bunga);
            $key->jatuh_tempo_now = $cek_;
            $key->tgl_gadai = bulan($key->tgl_gadai);
            $key->tgl_jatuh_tempo = bulan($key->tgl_jatuh_tempo);
            $key->tgl_lelang = bulan($key->tgl_lelang);
            $i++;
        }
        $result['aaData'] = $data_gadai;
        echo json_encode($result);
    }

    public function cetaknota($kode_pinjaman)
    {
        helper('bulan');
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $data = [
            'data_cabang' => $this->CabangModel->infoCabang($kode_cabang),
            'data_nota' => $this->PegadaianModel->get_printDataGadai($kode_pinjaman)
        ];
        return view('nota', $data);
    }

    // import proses
    public function cek_kategori($kategori)
    {
        $id_categori = 0;
        switch ($kategori) {
            case 'LAPTOP':
                $id_categori = 1;
                break;
            case 'HP':
                $id_categori = 2;
                break;
            case 'MOTOR':
                $id_categori = 3;
                break;
            case 'ELEKTRONIK':
                $id_categori = 4;
                break;
            default:
                $id_categori = 0;
                break;
        }
        return $id_categori;
    }
    public function import()
    {
        helper('tanggalbaru');
        helper('faketgl');
        // library('excel');
        // $excel = new PHPExcel();
        $cek_cabang_user = session('kode_cabang');
        $kode_cabang = (!empty($_GET['kode_cabang'])) ? $_GET['kode_cabang'] : $cek_cabang_user;
        $file = $this->request->getFile('file_import');
        if ($file) {
            $excelReader  = new PHPExcel();
            $fileLocation = $file->getTempName();
            $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
            $sheet    = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            foreach ($sheet as $idx => $data) {
                //skip index 1 karena title excel
                // if ($idx == 2) {
                //     continue;
                // }
                $nama = $data['A'];
                $jenis_barang = $data['B'];
                $kategori = $data['C'];
                $kelengkapan = $data['D'];
                $tgl_gadai = $data['E'];
                $tgl_jatuh_tempo = $data['F'];
                $jumlah_pinjaman = $data['G'];
                $bunga = $data['H'];
                $telpon = $data['I'];
                $keterangan = $data['J'];
                // $status_bayar = $data['K'];/

                // $temp_data_nasabah = [
                //     'nama' => $nama,
                //     'nik' => '',
                //     'alamat_nasabah' => '',
                //     'no_telp' => $telpon,
                //     'kode_cabang' => $kode_cabang,
                //     'status' => 'Aktif',
                // ];
                // var_dump($tgl_gadai);
                // echo tanggalbaru($tgl_gadai);
                // echo "<br>";
                // echo preg_replace("/[^a-zA-Z0-9\s]/", "", $jumlah_pinjaman);
                // echo "<br>";
                // echo $this->cek_kategori($kategori);
                // die;
                $this->NasabahModel->save([
                    'nama' => $nama,
                    'nik' => '',
                    'alamat_nasabah' => '',
                    'no_telp' => $telpon,
                    'kode_cabang' => $kode_cabang,
                    'status' => 'Aktif',
                ]);
                $last_id_nasabah = $this->NasabahModel->insertID;
                // $user->insert($data);
                // $user_id = ;
                // $proses insert
                // $temp_data_import[] = array(
                //     'kode_pinjaman'     => '',
                //     'id_nasabah'        => $last_id_nasabah,
                //     'jenis_barang'      => $this->cek_kategori($kategori),
                //     'seri'              => $jenis_barang,
                //     'kelengkapan'       => $kelengkapan,
                //     'jumlah'            => 1,
                //     'kondisi'           => '',
                //     'tgl_gadai'         => $tgl_gadai,
                //     'tgl_jatuh_tempo'   => $tgl_jatuh_tempo,
                //     'tgl_lelang'        => '',
                //     'jumlah_pinjaman'   => $jumlah_pinjaman,
                //     'bunga'             => $bunga,
                //     'keterangan'        => $keterangan,
                // );

                // echo $this->PegadaianModel->create_kode_pinjaman($kode_cabang);
                $kd = $this->PegadaianModel->create_kode_pinjaman($kode_cabang);
                $this->PegadaianModel->insert([
                    'kode_pinjaman'     => 'FG1-' . $idx . '0502',
                    'id_nasabah'        => $last_id_nasabah,
                    'jenis_barang'      => $this->cek_kategori($kategori),
                    'seri'              => $jenis_barang,
                    'kelengkapan'       => $kelengkapan,
                    'jumlah'            => 1,
                    'kondisi'           => '',
                    'tgl_gadai'         => tanggalbaru($tgl_gadai),
                    'tgl_jatuh_tempo'   => tanggalbaru($tgl_jatuh_tempo),
                    'tgl_lelang'        => faketgl($tgl_jatuh_tempo),
                    'jumlah_pinjaman'   => preg_replace("/[^a-zA-Z0-9\s]/", "", $jumlah_pinjaman),
                    'bunga'             => preg_replace("/[^a-zA-Z0-9\s]/", "", $bunga),
                    'kode_cabang'       => $kode_cabang,
                    // 'keterangan'        => $keterangan,
                    'status_bayar'      => 'Belum Lunas',
                ]);


                // insert data
                // $this->contact->insert([
                // 	'nama'=>$nama,
                // 	'handphone'=>$hp,
                // 	'email'=>$email
                // ]);
            }
            // var_dump($temp_data_import);
            // var_dump($sheet);
            // echo 'halooo';
        }
    }
}