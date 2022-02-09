<?php

namespace App\Models;

use CodeIgniter\Model;

class PegadaianModel extends Model
{
    protected $table = 'pinjamangadai';
    protected $primaryKey = 'kode_pinjaman';
    protected $allowedFields = ['kode_pinjaman', 'id_nasabah', 'jenis_barang', 'seri', 'kelengkapan', 'jumlah', 'kondisi', 'tgl_gadai', 'tgl_jatuh_tempo', 'tgl_lelang', 'jumlah_pinjaman', 'bunga', 'kode_cabang', 'status_bayar'];
    protected $returnType = 'array';

    public function getDataGadai($kode_cabang = null, $dataSekarang = null, $tanggal_start = null, $tanggal_end = null)
    {
        $this->db->table('pinjamangadai');
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');
        $this->join('cabang', 'cabang.kode_cabang = pinjamangadai.kode_cabang');
        $this->join('kategori_barang', 'kategori_barang.id_barang = pinjamangadai.jenis_barang', 'left');
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('pinjamangadai.kode_cabang', $kode_cabang);
        }

        if (!empty($dataSekarang) && $dataSekarang == 'hariIni') {
            // $array = ['pinjamangadai.tgl_gadai' => date('Y-m-d'), 'pinjamangadai.tgl_jatuh_tempo' => date('Y-m-d', strtotime("+1 day"))];
            $this->where('pinjamangadai.tgl_gadai', date('Y-m-d'));
            // $this->where('pinjamangadai.status_bayar !=', 'Lunas');
            // $this->where('pinjamangadai.tgl_jatuh_tempo', date('Y-m-d', strtotime("+1 day")));
        }
        if (!empty($tanggal_start) && !empty($tanggal_end)) {
            $this->where('tgl_gadai >=', $tanggal_start);
            $this->where('tgl_gadai <=', $tanggal_end);
        }
        return $this->get()->getResultObject();
    }

    public function get_printDataGadai($kode_pinjaman)
    {
        $this->db->table('pinjamangadai');
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');
        // $this->join('cabang', 'cabang.kode_cabang = pinjamangadai.kode_cabang');
        $this->join('kategori_barang', 'kategori_barang.id_barang = pinjamangadai.jenis_barang', 'left');
        $this->where('pinjamangadai.kode_pinjaman', $kode_pinjaman);
        return $this->get()->getRow();
    }

    public function getDataGadaiLaporan($start, $length, $query, $keysearch, $kode_cabang = null, $type_data = null, $dataSekarang = null)
    {
        $request = \Config\Services::request();
        $kolom = ['kode_pinjaman', 'id_nasabah', 'tgl_gadai', 'tgl_jatuh_tempo', 'tgl_lelang', 'jumlah_pinjaman', 'bunga', 'kode_cabang'];
        $this->db->table('pinjamangadai');

        $this->groupStart();
        $this->orLike($keysearch, $query, 'BOTH');
        $this->groupEnd();

        if ($request->getGet('iSortCol_0')) {
            for ($i = 0; $i < intval($request->getGet('iSortingCols', TRUE)); $i++) {
                if ($request->getGet('bSortable_' . intval($request->getGet('iSortCol_' . $i)), TRUE) == "true") {
                    $this->orderBy($kolom[intval($request->getGet('iSortCol_' . $i, TRUE))], $request->getGet('sSortDir_' . $i, TRUE));
                }
            }
        }

        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');
        $this->join('cabang', 'cabang.kode_cabang = pinjamangadai.kode_cabang');
        $this->join('kategori_barang', 'kategori_barang.id_barang = pinjamangadai.jenis_barang', 'left');
        // $this->join('pendapatan', 'pendapatan.kd_pinjaman = pinjamangadai.kode_pinjaman', 'left');// baruuu!
        // $this->join('pendapatan', 'pendapatan.kd_pinjaman = pinjamangadai.kode_pinjaman', 'right');
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('pinjamangadai.kode_cabang', $kode_cabang);
        }
        if (!empty($dataSekarang) && $dataSekarang == 'hariIni') {
            $this->where('pinjamangadai.tgl_gadai', date('Y-m-d'));
        }
        return $this->get()->getResultObject();
    }
    public function cek_pendapatan_peminjaman($jenis, $kd_pinjaman)
    {
        // $db      = \Config\Database::connect();
        // $builder = $db->table('pendapatan');
        // // $this->db->table('pendapatan');
        // $builder->select('jumlah_untung');
        // $builder->where('kd_pinjaman', $kd_pinjaman);
        // $builder->where('jenis', $jenis);
        // $builder->limit(1);
        // return $builder->get()->getRow();

        $query = $this->query("SELECT jumlah_untung, count(id_pendapatan) as total_data FROM pendapatan WHERE kd_pinjaman = '$kd_pinjaman' AND jenis = '$jenis' ");
        if ($query) {
            return $query->getRow();
        }
        return 0;
        // $data = $query->getResultObject();
        // return $data;
    }

    public function bungaTotal($jenis, $kd_pinjaman)
    {
        // $db      = \Config\Database::connect();
        // $builder = $db->table('pendapatan');
        // // $this->db->table('pendapatan');
        // $builder->select('jumlah_untung');
        // $builder->where('kd_pinjaman', $kd_pinjaman);
        // $builder->where('jenis', $jenis);
        // $builder->limit(1);
        // return $builder->get()->getRow();

        $query = $this->query("SELECT SUM(jumlah_untung) as total FROM pendapatan WHERE kd_pinjaman = '$kd_pinjaman' AND jenis = '$jenis' ");
        if ($query) {
            return $query->getRow();
        }
        return 0;
        // $data = $query->getResultObject();
        // return $data;
    }



    public function getDataLelang($kode_cabang = null, $dataSekarang = null)
    {
        $this->db->table('pinjamangadai');
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');
        $this->join('cabang', 'cabang.kode_cabang = pinjamangadai.kode_cabang');
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('pinjamangadai.kode_cabang', $kode_cabang);
        }

        if (!empty($dataSekarang) && $dataSekarang == 'hariIni') {
            // $array = ['pinjamangadai.tgl_gadai' => date('Y-m-d'), 'pinjamangadai.tgl_jatuh_tempo' => date('Y-m-d', strtotime("+1 day"))];
            $this->where('pinjamangadai.tgl_lelang', date('Y-m-d'));
            // $this->where('pinjamangadai.tgl_jatuh_tempo', date('Y-m-d', strtotime("+1 day")));
        }
        return $this->get()->getResultObject();
    }

    public function sortDate($kode_cabang = null)
    {
        // $this->select('*');
        // $this->from('documents');
        // $this->where('DATE(Now())');
        // $query = $this->get();
        // return $query->result();
        // dd($data);
        // die;
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $query = $this->query("SELECT count(kode_pinjaman) as total FROM pinjamangadai WHERE tgl_jatuh_tempo = date(NOW()) && kode_cabang = '$kode_cabang' AND status_bayar != 'Lunas'");
        } else {
            $query = $this->query("SELECT count(kode_pinjaman) as total FROM pinjamangadai WHERE tgl_jatuh_tempo = date(NOW()) AND status_bayar != 'Lunas' ");
        }
        $data = $query->getRow()->total;
        return $data;
    }

    public function sortDateLelang($kode_cabang = null)
    {
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $query = $this->query("SELECT count(kode_pinjaman) as total FROM pinjamangadai WHERE tgl_jatuh_tempo < date(NOW()) && kode_cabang = '$kode_cabang' AND status_bayar != 'Lunas' ");
        } else {
            $query = $this->query("SELECT count(kode_pinjaman) as total FROM pinjamangadai WHERE tgl_jatuh_tempo < date(NOW()) AND status_bayar != 'Lunas' ");
        }
        $data = $query->getRow()->total;
        return $data;
    }

    public function selectJatuhTempo($kode_cabang = null)
    {
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $query = $this->query("SELECT * FROM pinjamangadai WHERE tgl_jatuh_tempo = date(NOW()) && kode_cabang = '$kode_cabang' AND status_bayar != 'Lunas'");
        } else {
            $query = $this->query("SELECT * FROM pinjamangadai WHERE tgl_jatuh_tempo = date(NOW()) AND status_bayar != 'Lunas'");
        }

        $data = $query->getResultArray();
        // dd($data);
        // die;
        return $data;
    }

    public function create_kode_pinjaman($cabang_kode)
    {
        $dd = $this->query("SELECT kode_toko FROM cabang where kode_cabang = '$cabang_kode' ");
        $get_kode_cabang = $dd->getResultArray();
        $kode_cabang = $get_kode_cabang[0]['kode_toko'];
        $tahun_sekarang = date('Y');
        $bulan_sekarang = date('m');
        $get_cek_pinjamangadai = $this->query("SELECT count(kode_pinjaman) as total FROM pinjamangadai where kode_cabang = '$cabang_kode' AND YEAR(tgl_gadai) = $tahun_sekarang AND MONTH(tgl_gadai) = $bulan_sekarang ");
        $row_data_pinjamangadai = $get_cek_pinjamangadai->getResultArray();
        $jumlah_data_peminjam_sekarang = $row_data_pinjamangadai[0]['total'];
        $kode_pinjaman = $kode_cabang . '-' . ($jumlah_data_peminjam_sekarang + 1) . date('dmy');
        // check same kode_pinjaman
        // $cek_lagi = $this->query("SELECT count(kode_pinjaman) as cek_kp FROM pinjamangadai WHERE kode_pinjaman = '$kode_pinjaman' ");
        // $cek_lagi_result = $cek_lagi->getRow()->cek_kp;
        // if ($cek_lagi_result > 0) {
        //     $kode_pinjaman = $kode_cabang . '-' . ($jumlah_data_peminjam_sekarang + 2) . date('dm');
        // } else {
        //     $kode_pinjaman = $kode_cabang . '-' . ($jumlah_data_peminjam_sekarang + 1) . date('dm');
        // }
        return $kode_pinjaman;
    }

    public function simpan($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pinjamangadai');
        return $builder->insert($data);
    }

    public function simpan_nasabah_import($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('nasabah');
        $builder->insert($data);
        $user_id = $db->insertID();
        return $user_id;
    }

    public function getTotalPinjaman($kode_cabang)
    {
        // $builder = $this->selectSum('jumlah_pinjaman');
        // $data = $builder->get()->getResultArray();
        $data = $this->query("SELECT sum(jumlah_pinjaman) as jumlah_pinjaman FROM `pinjamangadai` WHERE tgl_gadai = date(NOW()) && kode_cabang = '" . $kode_cabang . "'")->getResultArray();
        return $data;
    }

    // for datatable list data

    public function countResultTable($kode_cabang = null, $type_data = null)
    {
        $this->selectCount('kode_pinjaman');
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('pinjamangadai.kode_cabang', $kode_cabang);
        }
        if (!empty($type_data) && $type_data == "TERLELANG") {
            $this->where('pinjamangadai.tgl_jatuh_tempo <', date('Y-m-d'));
        } else {
            $this->where('pinjamangadai.tgl_jatuh_tempo >=', date('Y-m-d'));
        }
        $this->where('pinjamangadai.status_bayar !=', 'TERLELANG');
        $this->where('pinjamangadai.status_bayar !=', 'Lunas');
        $query = $this->get()->getRow()->kode_pinjaman;
        return $query;
    }
    public function count_filter($query, $kode_cabang = null, $type_data = null)
    {
        $this->select('count("kode_pinjaman") as qty');
        $this->groupStart();
        $this->orLike('kode_pinjaman', $query, 'BOTH');
        $this->groupEnd();
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('pinjamangadai.kode_cabang', $kode_cabang);
        }
        if (!empty($type_data) && $type_data == "TERLELANG") {
            $this->where('pinjamangadai.tgl_jatuh_tempo <', date('Y-m-d'));
        } else {
            $this->where('pinjamangadai.tgl_jatuh_tempo >=', date('Y-m-d'));
        }
        $this->where('pinjamangadai.status_bayar !=', 'TERLELANG');
        $this->where('pinjamangadai.status_bayar !=', 'Lunas');
        return $this->get()->getRow()->qty;
    }
    public function listDataGadai($start, $length, $query, $keysearch, $kode_cabang = null, $type_data = null)
    {
        $request = \Config\Services::request();
        $kolom = ['kode_pinjaman', 'id_nasabah', 'tgl_gadai', 'tgl_jatuh_tempo', 'tgl_lelang', 'jumlah_pinjaman', 'bunga', 'kode_cabang'];
        $this->groupStart();
        $this->orLike($keysearch, $query, 'BOTH');
        $this->groupEnd();

        if ($request->getGet('iSortCol_0')) {
            for ($i = 0; $i < intval($request->getGet('iSortingCols', TRUE)); $i++) {
                if ($request->getGet('bSortable_' . intval($request->getGet('iSortCol_' . $i)), TRUE) == "true") {
                    $this->orderBy($kolom[intval($request->getGet('iSortCol_' . $i, TRUE))], $request->getGet('sSortDir_' . $i, TRUE));
                }
            }
        }
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');
        $this->join('perpanjangan', 'perpanjangan.kode_pinjamann = pinjamangadai.kode_pinjaman', 'left');
        $this->join('kategori_barang', 'kategori_barang.id_barang = pinjamangadai.jenis_barang', 'left');
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('pinjamangadai.kode_cabang', $kode_cabang);
        }
        if (!empty($type_data) && $type_data == "TERLELANG") {
            $this->where('pinjamangadai.tgl_jatuh_tempo <', date('Y-m-d'));
        } else {
            $this->where('pinjamangadai.tgl_jatuh_tempo >=', date('Y-m-d'));
        }
        $this->where('pinjamangadai.status_bayar !=', 'TERLELANG');
        $this->where('pinjamangadai.status_bayar !=', 'Lunas');
        $this->orderBy('tgl_gadai', 'desc');
        $this->orderBy('kode_pinjaman', 'desc');
        return $this->get($length, $start)->getResultObject();
        // $query = $this->getLastQuery();
        // echo (string)$query;
    }

    public function get_month_olny()
    {
        $query = $this->query("SELECT date_format(tgl_gadai, '%M') AS bulan,date_format(tgl_gadai, '%Y') AS tahun,COUNT(kode_pinjaman) as total_data from pinjamangadai group by date_format(tgl_gadai, '%M') ORDER BY tgl_gadai ASC");
        $data = $query->getResultObject();
        return $data;
    }

    public function cek_peminjaman($kode_pinjaman)
    {
        if (!empty($kode_pinjaman)) {
            $query = $this->query("SELECT jumlah_pinjaman from pinjamangadai WHERE kode_pinjaman = '" . $kode_pinjaman . "' ");
            $data = $query->getRow()->jumlah_pinjaman;
            return $data;
        }
        return null;
    }
}