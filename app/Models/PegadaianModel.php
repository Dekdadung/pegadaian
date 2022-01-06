<?php

namespace App\Models;

use CodeIgniter\Model;

class PegadaianModel extends Model
{
    protected $table = 'pinjamangadai';
    protected $primaryKey = 'kode_pinjaman';
    protected $allowedFields = ['id_nasabah', 'jenis_barang', 'kelengkapan', 'jumlah', 'kondisi', 'tgl_gadai', 'tgl_jatuh_tempo', 'tgl-lelang', 'jumlah_pinjaman', 'bunga', 'kode_cabang', 'status'];
    protected $returnType = 'array';

    public function getDataGadai()
    {
        return $this->db->table('pinjamgadai')
            ->join('nasabah', 'nasabah.id_nasabah = pinjamgadai.id_nasabah')
            ->join('cabang', 'cabang.kode_cabang = pinjamgadai.kode_cabang')
            ->get()->getResultArray();
    }
}