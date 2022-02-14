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
                <!-- <li><i class="fas fa-square-full text-warning"></i> Sudah Masuk Lelang</li> -->
                <li><i class="fas fa-square-full text-danger"></i> Sudah Melewati Tanggal Batas lelang dan Harus Segera
                    Dilelang</li>
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
                {"edit":false,"delete":false,"print":false,"notifWa":false,"detail":true,"pembayaran":false,"perpanjangan":false,"denda":true,"lelang":true,"penebusan":true}
            </div>
        <?php else : ?>
            <div style="display: none;" data-style="dropdown" id="table_action">
                {"edit":false,"delete":false,"print":false,"notifWa":false,"detail":true,"pembayaran":false,"perpanjangan":false,"denda":true,"lelang":true,"penebusan":true}
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

<!-- Modal -->
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Data Gadai Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text">Kode Pinjaman : <b><span class="row_kode_pinjaman"></span></b></p>
                        <!-- <p class="card-text">Id Nasabah : <b><span class="row_id_nasabah"></span></b></p> -->
                        <p class="card-text">Nama Nasabah : <b><span class="row_nama"></span></b></p>
                        <p class="card-text">No. Telpon : <b><span class="row_no_telp"></span></b></p>
                        <p class="card-text">Tgl. Gadai: <b><span class="row_tgl_gadai"></span></b></p>
                        <p class="card-text">Tgl. Jatuh Tempo: <b><span class="row_tgl_jatuh_tempo"></span></b></p>
                        <p class="card-text">Tgl. Lelang: <b><span class="row_tgl_lelang"></span></b></p>
                        <p class="card-text">Jumlah Pinjaman : <b><span class="row_jumlah_pinjaman"></span></b></p>
                        <p class="card-text">Bunga : <b><span class="row_bunga"></span></b></p>
                        <p class="card-text">Kode Cabang : <b><span class="row_kode_cabang"></span></b></p>
                        <p class="card-text">Status : <b><span class="row_status_bayar"></span></b></p>
                        <p class="card-text">Jenis Barang : <b><span class="row_nama_barang"></span></b></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>