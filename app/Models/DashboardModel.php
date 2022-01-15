<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function getDataGadai()
    {
        return $this->db->table('pinjamangadai')
            ->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah')
            ->join('cabang', 'cabang.kode_cabang = pinjamangadai.kode_cabang')
            ->get()->getResultObject();
    }
}