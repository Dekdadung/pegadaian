<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoriModel extends Model
{
    protected $table = 'histori';
    protected $primaryKey = 'id_histori';
    protected $allowedFields = ['kode_pinjaman_gadai', 'kode_cb', 'tanggal', 'dana', 'jenis', 'keterangan'];
    protected $returnType = 'array';
}