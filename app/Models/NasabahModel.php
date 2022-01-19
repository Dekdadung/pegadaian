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
    protected $allowedFields = ['nama', 'nik', 'alamat_nasabah', 'no_telp', 'kode_cabang', 'status'];
    protected $returnType = 'array';

    public function getDataNasabah($kode_cabang = null)
    {
        // return $this->db->table('nasabah')
        //     ->join('cabang', 'cabang.kode_cabang = nasabah.kode_cabang')
        //     ->get()->getResultArray();
        $this->db->table('nasabah');
        $this->join('cabang', 'cabang.kode_cabang = nasabah.kode_cabang');
        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('nasabah.kode_cabang', $kode_cabang);
        }
        return $this->get()->getResultObject();
    }

    public function simpan($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('nasabah');
        return $builder->insert($data);
    }
}