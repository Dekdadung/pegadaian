<?php

namespace App\Models;

use CodeIgniter\Model;

class NasabahModel extends Model
{
    protected $table = 'nasabah';
    protected $primaryKey = 'id_nasabah';
    protected $useTimestamps = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $allowedFields = ['nama', 'alamat', 'no_telp', 'kode_cabang', 'status'];
    protected $returnType = 'array';

    public function getDataNasabah()
    {
        return $this->db->table('nasabah')
            ->join('cabang', 'cabang.kode_cabang = nasabah.kode_cabang')
            ->get()->getResultArray();
    }
}