<?php

namespace App\Models;

use CodeIgniter\Model;

class PendapatanModel extends Model
{
    protected $table = 'pendapatan';
    protected $primaryKey = 'id_pendapatan';
    protected $allowedFields = ['jumlah_untung', 'kd_pinjaman', 'jenis', 'tgl_masuk', 'keterangan'];
    protected $returnType = 'array';

    public function getTotalPendapatan($kode_cabang)
    {

        // $builder = $this->selectSum('jumlah_untung');
        // $data = $this->query("SELECT sum(jumlah_untung) as total_untung, tgl_masuk FROM `pendapatan` WHERE tgl_masuk = date(NOW()) ")->getResultArray();
        $data = $this->query("SELECT SUM(jumlah_untung) AS total_pendapatan FROM `pendapatan` LEFT join pinjamangadai ON pinjamangadai.kode_pinjaman = pendapatan.kd_pinjaman WHERE pinjamangadai.kode_cabang = '" . $kode_cabang . "' AND pendapatan.tgl_masuk = date(NOW()) ")->getResultArray();
        return $data;
    }
    public function getTotalPendapatanBulan($kode_cabang)
    {
        $bulan_ini = date('Y-m-05');
        $calc_bulan_depan = date('m') + 1;
        $bulan_depan = date('Y-' . $calc_bulan_depan . '-05');
        $data = $this->query("SELECT SUM(jumlah_untung) AS total_pendapatan FROM `pendapatan` LEFT join pinjamangadai ON pinjamangadai.kode_pinjaman = pendapatan.kd_pinjaman WHERE 
        pinjamangadai.kode_cabang = '" . $kode_cabang . "' AND pendapatan.tgl_masuk >= '" . $bulan_ini . "' AND pendapatan.tgl_masuk <= '" . $bulan_depan . "' ")->getResultArray();
        return $data;
    }

    public function Pendapatan_batal($kode_pinjaman)
    {
        $ex = $this->query("DELETE FROM pendapatan where kd_pinjaman = '$kode_pinjaman' AND jenis = 'Bunga' ");
        return $ex;
    }
}
