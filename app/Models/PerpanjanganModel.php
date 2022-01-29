<?php

namespace App\Models;

use CodeIgniter\Model;

class PerpanjanganModel extends Model
{
    protected $table = 'perpanjangan';
    protected $primaryKey = 'id_perpanjangan';
    protected $allowedFields = ['kode_pinjamann', 'tgl_perpanjangan'];
    protected $returnType = 'array';

    public function get_jatuh_tempo($kode_pinjamann)
    {
        $this->select('tgl_perpanjangan');
        $this->where('kode_pinjamann', $kode_pinjamann);
        $this->orderBy('id_perpanjangan', 'DESC');
        $this->limit(1);
        $get = $this->get()->getResultArray();
        return $get;
    }
}