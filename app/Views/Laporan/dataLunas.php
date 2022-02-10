<?php
$session = session();
?>
<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Gadai Lunas</h1>
        <div class="section-header-button">
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Export Data
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" id="akses-excel" href="<?php echo base_url('excel/export') ?>"><i
                            class="fa fa-file-excel"></i> EXCEL</a>
                    <!-- <a class="dropdown-item" href="<?php echo base_url('excel/tes') ?>">Test Data</a> -->
                    <a class="dropdown-item" href="<?php echo base_url('/uploadForm') ?>"><i class="fa fa-upload"></i>
                        UPLOAD DATA</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- <form method="post" class="form-inline">
            <label>Tanggal Awal</label>
            <input type="date" name="tglawal" class="form-control">
            <label class="ml-3">Tanggal Akhir</label>
            <input type="date" name="tglakhir" class="form-control">
            <button type="submit" name="filter" class="btn btn-primary ml-3">Filter</button>
        </form> -->
        <!-- <div class="col-md-2">
            <div class="input-group-prepend">
                <select class="custom-select" id="inputGroupSelect03">
                    <option value="" selected="">Bulan Ini</option>
                    <option value="">Lunas</option>
                </select>
            </div>
        </div> -->
        <div class="col-md-8">
            <div class="kt-form__label text-left">
                <label>Cari data</label>
            </div>
            <div class="input-group" style="margin-top:5px;">
                <div class="input-group-prepend">
                    <select class="custom-select searchType" id="inputGroupSelect03">
                        <option value="kode_pinjaman" selected="">Kode Pinjaman</option>
                        <option value="nama">Nama Nasabah</option>
                    </select>
                </div>
                <input type="text" class="searchInput form-control" placeholder="Cari data...">
            </div>
        </div>
        <div class="col-md-4">
            <!-- <div class="input-group-prepend">
                <select class="custom-select" id="inputGroupSelect03">
                    <option value="" selected="">Semua Kategori</option>
                    <option value="">Lunas</option>
                    <option value="">Akan Jatuh Tempo</option>
                    <option value="">Jatuh Tempo</option>
                    <option value="">Menunggu Pembayaran</option>
                </select>
            </div> -->
            <div class="kt-form__label text-left">
                <label>Filter dengan Tanggal</label>
            </div>
            <div class="input-group input-daterange">
                <input type="text" class="form-control searchInputRange" name="tanggal_start" value=""
                    placeholder="Dari" autocomplete="off" data-col-index="1" data-field="tanggal_start">
                <div class="input-group-addon"><i class="fas fa-ellipsis-h"></i></div>
                <input type="text" class="form-control searchInputRange" name="tanggal_end" value=""
                    placeholder="Sampai" autocomplete="off" data-col-index="1" data-field="tanggal_end">
            </div>
        </div>
    </div>
    <div class="">
        <input type="hidden" id="base_url" value="<?= base_url() ?>" name="">
        <input type="hidden" id="list_url" value="<?= base_url('listLaporan') ?>" name="">
        <input type="hidden" id="current_page" value="<?= base_url('laporan') ?>" name="">
        <input type="hidden" id="type_data" value="" name="">
        <div style="display: none;" id="table_column">
            [{"data":"no"},{"data":"kode_pinjaman"},{"data":"nama"},{"data":"nama_barang"},{"data":"tgl_gadai"},{"data":"tgl_jatuh_tempo"},{"data":"jumlah_pinjaman"},{"data":"bunga"},{"data":"pendapatan_denda"},{"data":"pendapatan_lelang"},{"data":"total_pendapatan_bersih"}]
        </div>
        <div style="display: none;" id="sumColumn">[6,10]</div>
        <div style="display: none;" id="table_columnDef">{"className":"white_space","targets":[2]}</div>
        <div style="display: none;" data-style="dropdown" id="table_action"></div>
        <table class="table table-striped table-md datatable">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Nama Nasabah</th>
                    <th>Jenis Barang</th>
                    <th>Tgl. Gadai</th>
                    <th>Jatuh Tempo</th>
                    <!-- <th>Tgl. Lelang</th> -->
                    <th>Jumlah Pinjaman</th>
                    <th>Bunga</th>
                    <th>Denda</th>
                    <th>Lelang</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: right;"><strong>Total Saldo Keluar : </strong></td>
                    <td><strong></strong></td>
                    <td><strong></strong></td>
                    <td colspan="2"><strong>Total Pendapatan : </strong></td>
                    <td><strong></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</section>

<?= $this->endSection(); ?>