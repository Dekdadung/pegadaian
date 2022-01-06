<?php

namespace App\Models;

use CodeIgniter\Model;

class SaldoModel extends Model
{
    protected $table = 'kas';
    protected $primaryKey = 'id_kas';
    protected $allowedFields = ['jumlah_kas', 'tgl_masuk', 'tgl_keluar', 'keterangan', 'kode_cabang'];
    protected $returnType = 'array';
}
