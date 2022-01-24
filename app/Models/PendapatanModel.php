<?php

namespace App\Models;

use CodeIgniter\Model;

class PendapatanModel extends Model
{
    protected $table = 'pendapatan';
    protected $primaryKey = 'id_pendapatan';
    protected $allowedFields = ['jumlah_untung', 'kd_pinjaman', 'jenis'];
    protected $returnType = 'array';

    public function getTotalPendapatan()
    {
        $builder = $this->selectSum('jumlah_untung');
        $data = $builder->get()->getResultArray();
        return $data;
    }
}