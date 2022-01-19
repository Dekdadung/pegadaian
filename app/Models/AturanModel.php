<?php

namespace App\Models;

use CodeIgniter\Model;

class AturanModel extends Model
{
    protected $table = 'peraturan';
    protected $primaryKey = 'id_peraturan';
    protected $allowedFields = ['bunga', 'denda'];
    protected $returnType = 'array';

    public function simpan($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('peraturan');
        return $builder->insert($data);
    }
}