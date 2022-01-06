<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
    protected $table = 'cabang';
    protected $primaryKey = 'kode_cabang';
    protected $allowedFields = ['nama_cabang', 'alamat', 'kode_toko'];
    protected $returnType = 'array';
}
