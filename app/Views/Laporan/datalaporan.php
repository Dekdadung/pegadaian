<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Laporan</h1>
        <div class="section-header-button">
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Export Data
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="<?php echo base_url('excel/export') ?>">EXCEL<i class="fa fa-file-excel"></i></a>
                    <a class="dropdown-item" href="<?php echo base_url('export/generate') ?>">PDF<i class="fa fa-file-pdf"></i></a>
                    <a class="dropdown-item" onclick="window.print()">PRINT DATA<i class="fa fa-print"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <form method="post" class="form-inline">
            <label>Tanggal Awal</label>
            <input type="date" name="tglawal" class="form-control">
            <label class="ml-3">Tanggal Akhir</label>
            <input type="date" name="tglakhir" class="form-control">
            <button type="submit" name="filter" class="btn btn-primary ml-3">Filter</button>
        </form>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-md">
            <tbody>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Nama Nasabah</th>
                    <th>Tgl. Gadai</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl. Lelang</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Kode Cabang</th>
                </tr>
                <div class="text-center">
                    <?php
                    $no = 1;

                    foreach ($gadai as $row) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->kode_pinjaman; ?></td>
                            <td><?= $row->nama; ?></td>
                            <td><?= $row->tgl_gadai; ?></td>
                            <td><?= $row->tgl_jatuh_tempo; ?></td>
                            <td><?= $row->tgl_lelang; ?></td>
                            <td><?= rupiah($row->jumlah_pinjaman); ?></td>
                            <td><?= $row->kode_cabang; ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </div>
            </tbody>
        </table>
    </div>
</section><?= $this->endSection(); ?>