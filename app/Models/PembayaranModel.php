<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $allowedFields = ['kode_pinjaman', 'tgl_bayar', 'jumlah_bayar', 'keterangan'];
    protected $returnType = 'array';

    public function getTotalPembayaran()
    {
        $builder = $this->selectSum('jumlah_bayar');
        $data = $builder->get()->getResultArray();
        return $data;
    }
}