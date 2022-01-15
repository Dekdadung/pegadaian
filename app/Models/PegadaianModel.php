<?php

namespace App\Models;

use CodeIgniter\Model;

class PegadaianModel extends Model
{
    protected $table = 'pinjamangadai';
    protected $primaryKey = 'kode_pinjaman';
    protected $allowedFields = ['id_nasabah', 'no_telp', 'jenis_barang', 'seri', 'kelengkapan', 'jumlah', 'kondisi', 'tgl_gadai', 'tgl_jatuh_tempo', 'tgl_lelang', 'jumlah_pinjaman', 'bunga', 'kode_cabang', 'status_bayar'];
    protected $returnType = 'array';

    public function getDataGadai()
    {
        return $this->db->table('pinjamangadai')
            ->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah')
            ->join('cabang', 'cabang.kode_cabang = pinjamangadai.kode_cabang')
            ->get()->getResultObject();
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

    public function getTelp($id_nasabah)
    {
        $builder = $this->select('no_telp');
        $builder = $this->limit(1);
        if (!empty($id_nasabah)) {
            $builder = $this->where('id_nasabah', $id_nasabah);
        }
        $data = $builder->get()->getResultArray();
        return $data;
    }

    public function getTotalPinjaman()
    {
        $builder = $this->selectSum('jumlah_pinjaman');
        $data = $builder->get()->getResultArray();
        return $data;
    }
}