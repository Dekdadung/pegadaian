<?php
$session = session();
?>
<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Akan Di Lelang</h1>
    </div>
    <div class="">
        <div class="petunjuk_warna">
            <ul>
                <li><i class="fas fa-square-full text-white"></i> Masih Bisa diperpanjang</li>
                <li><i class="fas fa-square-full text-warning"></i> Sudah Masuk Lelang</li>
                <li><i class="fas fa-square-full text-danger"></i> Sudah Melewati Tanggal Batas lelang dan Harus Segera Dilelang</li>
                <!-- <li><i class="fas fa-square-full text-dark"></i> Sudah lewat Jatuh Tempo</li> -->
            </ul>
        </div>
        <input type="hidden" id="base_url" value="<?= base_url() ?>" name="">
        <input type="hidden" id="list_url" value="<?= base_url('listlelang') ?>" name="">
        <input type="hidden" id="type_data" value="TERLELANG" name="">
        <div style="display: none;" id="table_column">
            [{"data":"no"},{"data":"kode_pinjaman"},{"data":"nama"},{"data":"tgl_gadai"},{"data":"tgl_jatuh_tempo"},{"data":"tgl_lelang"},{"data":"jumlah_pinjaman"},{"data":"bunga"}]
        </div>
        <div style="display: none;" id="table_columnDef">{"className":"white_space","targets":[2]}</div>
        <?php if ($session->get('level') == 'superadmin') :  ?>
            <div style="display: none;" data-style="dropdown" id="table_action">
                {"edit":false,"delete":false,"print":false,"notifWa":false,"detail":false,"pembayaran":false,"perpanjangan":false,"denda":true,"lelang":true}
            </div>
        <?php else : ?>
            <div style="display: none;" data-style="dropdown" id="table_action">
                {"edit":false,"delete":false,"print":false,"notifWa":false,"detail":false,"pembayaran":false,"perpanjangan":false,"denda":true,"lelang":true}
            </div>
        <?php endif; ?>
        <div class="my_box row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select class="custom-select searchType" id="inputGroupSelect03">
                            <option value="kode_pinjaman" selected="">Kode Pinjaman</option>
                            <option value="nama">Nama Nasabah</option>
                        </select>
                    </div>
                    <input type="text" class="searchInput form-control" placeholder="Cari data...">
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
        <table class="table table-striped table-md datatable">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Nama Nasabah</th>
                    <th>Tgl. Gadai</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl. Lelang</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Bunga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</section>

<?= $this->endSection(); ?>