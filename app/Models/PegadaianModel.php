<?php

namespace App\Models;

use CodeIgniter\Model;

class PegadaianModel extends Model
{
    protected $table = 'pinjamangadai';
    protected $primaryKey = 'kode_pinjaman';
    protected $allowedFields = ['id_nasabah', 'jenis_barang', 'seri', 'kelengkapan', 'jumlah', 'kondisi', 'tgl_gadai', 'tgl_jatuh_tempo', 'tgl_lelang', 'jumlah_pinjaman', 'bunga', 'kode_cabang', 'status_bayar'];
    protected $returnType = 'array';

    public function getDataGadai($kode_cabang = null, $dataSekarang = null)
    {
        $this->db->table('pinjamangadai');
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');
        $this->join('cabang', 'cabang.kode_cabang = pinjamangadai.kode_cabang');
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('pinjamangadai.kode_cabang', $kode_cabang);
        }

        if (!empty($dataSekarang) && $dataSekarang == 'hariIni') {
            // $array = ['pinjamangadai.tgl_gadai' => date('Y-m-d'), 'pinjamangadai.tgl_jatuh_tempo' => date('Y-m-d', strtotime("+1 day"))];
            $this->where('pinjamangadai.tgl_gadai', date('Y-m-d'));
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
            $query = $this->query("SELECT * FROM pinjamangadai WHERE tgl_jatuh_tempo = date(NOW()) && kode_cabang = '$kode_cabang'");
        } else {
            $query = $this->query("SELECT * FROM pinjamangadai WHERE tgl_jatuh_tempo = date(NOW())");
        }

        $data = $query->getResultArray();
        // dd($data);
        // die;
        return count($data);
    }

    public function selectJatuhTempo($kode_cabang = null)
    {
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $query = $this->query("SELECT * FROM pinjamangadai WHERE tgl_jatuh_tempo = date(NOW()) && kode_cabang = '$kode_cabang'");
        } else {
            $query = $this->query("SELECT * FROM pinjamangadai WHERE tgl_jatuh_tempo = date(NOW())");
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

        $get_cek_pinjamangadai = $this->query("SELECT count(kode_pinjaman) as total FROM pinjamangadai where kode_cabang = '$cabang_kode' ");
        $row_data_pinjamangadai = $get_cek_pinjamangadai->getResultArray();
        $jumlah_data_peminjam_sekarang = $row_data_pinjamangadai[0]['total'];

        $kode_pinjaman = $kode_cabang . '-' . ($jumlah_data_peminjam_sekarang + 1) . date('dm');
        return $kode_pinjaman;
    }

    public function simpan($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pinjamangadai');
        return $builder->insert($data);
    }

    public function getTotalPinjaman($kode_cabang)
    {
        // $builder = $this->selectSum('jumlah_pinjaman');
        // $data = $builder->get()->getResultArray();
        $data = $this->query("SELECT sum(jumlah_pinjaman) as jumlah_pinjaman FROM `pinjamangadai` WHERE tgl_gadai = date(NOW()) && kode_cabang = '" . $kode_cabang . "'")->getResultArray();
        return $data;
    }

    // for datatable list data
    public function count_filter($query)
    {
        $this->select('count("kode_pinjaman") as qty');
        $this->groupStart();
        $this->orLike('kode_pinjaman', $query, 'BOTH');
        $this->groupEnd();
        return $this->get()->getRow()->qty;
    }
    public function listDataGadai($start, $length, $query, $keysearch)
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
        $this->orderBy('tgl_gadai', 'desc');
        return $this->get($length, $start)->getResultObject();
    }

    public function get_month_olny()
    {
        $query = $this->query("SELECT date_format(tgl_gadai, '%M') AS bulan,date_format(tgl_gadai, '%Y') AS tahun,COUNT(kode_pinjaman) as total_data from pinjamangadai group by date_format(tgl_gadai, '%M') ORDER BY tgl_gadai ASC");
        $data = $query->getResultObject();
        return $data;
    }
}