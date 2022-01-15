<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
    protected $table = 'cabang';
    protected $primaryKey = 'kode_cabang';
    protected $allowedFields = ['kode_cabang', 'nama_cabang', 'alamat', 'saldo_cabang', 'kode_toko'];
    protected $returnType = 'array';

    public function simpan($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('cabang');
        return $builder->insert($data);
    }

    public function getSisa()
    {
        $builder = $this->select('saldo_cabang');
        $builder = $this->orderBy('kode_cabang');
        $builder = $this->limit(1);
        $data = $builder->get()->getResultArray();
        return $data;
    }
}