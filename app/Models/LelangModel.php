<?php

namespace App\Models;

use CodeIgniter\Model;

class LelangModel extends Model
{
    protected $table = 'lelang';
    protected $primaryKey = 'id_lelang';
    protected $allowedFields = ['kode_pinjaman, hasil_lelang, tgl_lelang, nama_barang, kodeCabang, keterangan'];
    protected $returnType = 'array';

    public function getDataLelang($kode_cabang = null)
    {
        $this->db->table('lelang');
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('lelang.kodeCabang', $kode_cabang);
        }
        return $this->get()->getResultObject();
    }

    public function simpan($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('lelang');
        return $builder->insert($data);
    }
}