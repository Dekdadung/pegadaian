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
            ->get()->getResultArray();
    }
}