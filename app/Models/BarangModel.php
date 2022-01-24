<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'kategori_barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['nama_barang'];
    protected $returnType = 'array';

    public function simpan($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_barang');
        return $builder->insert($data);
    }
}