<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoriModel extends Model
{
    protected $table = 'histori';
    protected $primaryKey = 'id_histori';
    protected $allowedFields = ['kode_pinjaman_gadai', 'kode_cb', 'tanggal', 'dana', 'jenis', 'keterangan'];
    protected $returnType = 'array';

    public function HistoriTebus($kode_cabang = null, $jenis = null, $tanggal = null)
    {
        $this->db->table('histori');
        $this->join('pinjamangadai', 'pinjamangadai.kode_pinjaman = histori.kode_pinjaman_gadai');
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');

        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('histori.kode_cb', $kode_cabang);
        }
        if (!empty($jenis) && $jenis = 'penebusan') {
            $this->where('histori.jenis', 'penebusan');
        }
        if (!empty($tanggal) && $tanggal = 'now') {
            $this->where('histori.tanggal', date('Y-m-d'));
        }
        return $this->get()->getResultObject();
    }
    public function HistoriPerpanjangan($kode_cabang = null, $jenis = null, $tanggal = null)
    {
        $this->db->table('histori');
        $this->join('pinjamangadai', 'pinjamangadai.kode_pinjaman = histori.kode_pinjaman_gadai');
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');

        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('histori.kode_cb', $kode_cabang);
        }
        if (!empty($jenis) && $jenis = 'perpanjangan') {
            $this->where('histori.jenis', 'perpanjangan');
        }
        if (!empty($tanggal) && $tanggal = 'now') {
            $this->where('histori.tanggal', date('Y-m-d'));
        }
        return $this->get()->getResultObject();
    }
    public function HistoriDenda($kode_cabang = null, $jenis = null, $tanggal = null)
    {
        $this->db->table('histori');
        $this->join('pinjamangadai', 'pinjamangadai.kode_pinjaman = histori.kode_pinjaman_gadai');
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');

        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            $this->where('histori.kode_cb', $kode_cabang);
        }
        if (!empty($jenis) && $jenis = 'denda') {
            $this->where('histori.jenis', 'denda');
        }
        if (!empty($tanggal) && $tanggal = 'now') {
            $this->where('histori.tanggal', date('Y-m-d'));
        }
        return $this->get()->getResultObject();
    }
    public function AllHistoriTebus($kode_cabang = null, $jenis = null)
    {
        $this->db->table('histori');
        $this->join('pinjamangadai', 'pinjamangadai.kode_pinjaman = histori.kode_pinjaman_gadai');
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');

        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            // $this->query("SELECT * FROM histori WHERE kode_cb = '$kode_cabang' AND jenis = 'denda'");
            $this->where('histori.kode_cb', $kode_cabang);
        }
        if (!empty($jenis) && $jenis = 'penebusan') {
            // $this->query("SELECT * FROM histori WHERE kode_cb = '$kode_cabang' AND jenis = 'denda'");
            $this->where('histori.jenis', 'penebusan');
        }

        // if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
        //     $this->query("SELECT * FROM histori WHERE kode_cb = '$kode_cabang' AND jenis = 'penebusan'");
        // } else {
        //     $this->query("SELECT * FROM histori WHERE jenis = 'penebusan'");
        // }
        return $this->get()->getResultObject();

        // $data = $query->getRow();
        // return $data;
    }
    public function AllHistoriPerpanjangan($kode_cabang = null, $jenis = null)
    {
        $this->db->table('histori');
        $this->join('pinjamangadai', 'pinjamangadai.kode_pinjaman = histori.kode_pinjaman_gadai');
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');

        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            // $this->query("SELECT * FROM histori WHERE kode_cb = '$kode_cabang' AND jenis = 'denda'");
            $this->where('histori.kode_cb', $kode_cabang);
        }
        if (!empty($jenis) && $jenis = 'perpanjangan') {
            // $this->query("SELECT * FROM histori WHERE kode_cb = '$kode_cabang' AND jenis = 'denda'");
            $this->where('histori.jenis', 'perpanjangan');
        }
        // if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
        //     $this->query("SELECT * FROM histori WHERE kode_cb = '$kode_cabang' AND jenis = 'perpanjangan'");
        // } else {
        //     $this->query("SELECT * FROM histori WHERE jenis = 'perpanjangan'");
        // }
        // $data = $query->getRow();
        // return $data;
        return $this->get()->getResultObject();
    }
    public function AllHistoriDenda($kode_cabang = null, $jenis = null)
    {
        $this->db->table('histori');
        $this->join('pinjamangadai', 'pinjamangadai.kode_pinjaman = histori.kode_pinjaman_gadai');
        $this->join('nasabah', 'nasabah.id_nasabah = pinjamangadai.id_nasabah');

        if (!empty($kode_cabang) && $kode_cabang != 'FG00') {
            // $this->query("SELECT * FROM histori WHERE kode_cb = '$kode_cabang' AND jenis = 'denda'");
            $this->where('histori.kode_cb', $kode_cabang);
        }
        if (!empty($jenis) && $jenis = 'denda') {
            // $this->query("SELECT * FROM histori WHERE kode_cb = '$kode_cabang' AND jenis = 'denda'");
            $this->where('histori.jenis', 'denda');
        }
        // else {
        //     $this->query("SELECT * FROM histori WHERE jenis = 'denda'");
        // }

        // $data = $query->getRow();
        // return $data;
        return $this->get()->getResultObject();
    }
}