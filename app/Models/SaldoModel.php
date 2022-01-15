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

    public function getSisa($kode_cabang = null)
    {
        $builder = $this->select('sisa_kas, tgl_masuk');
        $builder = $this->orderBy('id_kas', 'DESC');
        $builder = $this->limit(1);
        if (!empty($kode_cabang)) {
            $builder = $this->where('kode_cabang', $kode_cabang);
        }
        $data = $builder->get()->getResultArray();
        return $data;
    }

    public function getTanggal()
    {
        $builder = $this->select('tgl_masuk');
        $builder = $this->orderBy('id_kas', 'DESC');
        $builder = $this->limit(1);
        $data = $builder->get()->getResultArray();
        return $data;
    }

    // public function getTotalSaldo()
    // {
    //     $builder = $this->selectSum('jumlah_kas');
    //     $data = $builder->get()->getResultArray();
    //     return $data;
    // }
}