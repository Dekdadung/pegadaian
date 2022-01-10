<?php

namespace App\Models;

use CodeIgniter\Model;

class SaldoModel extends Model
{
    protected $table = 'kas';
    protected $primaryKey = 'id_kas';
    protected $useTimestamps = true;
    protected $createdField     = 'tgl_masuk';
    protected $updatedField     = 'tgl_keluar';
    protected $allowedFields = ['jumlah_kas', 'sisa_kas', 'keterangan', 'kode_cabang', 'jenis'];
    protected $returnType = 'array';

    public function getSisa()
    {
        $builder = $this->select('sisa_kas');
        $builder = $this->orderBy('id_kas', 'DESC');
        $builder = $this->limit(1);
        $data = $builder->get()->getResultArray();
        // if (count($data)) {
        return $data;
        // }
        // return null;
    }
}