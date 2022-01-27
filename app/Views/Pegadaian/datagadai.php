<?php
$session = session();
?>

<?= $this->extend('layout/default'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <?php if ($session->get('level') == 'superadmin') :  ?>
    <div class="section-header">
        <h1>Data Gadai</h1>
    </div>
    <?php else : ?>
    <div class="section-header">
        <h1>Data Gadai</h1>
        <div class="section-header-button">
            <a href="<?= site_url('formgadai') ?>" class="btn btn-primary">Tambah</a>
        </div>
    </div>
    <?php endif ?>

    <?php if (session()->getFlashdata('Pesan')) : ?>
    <div class="alert alert-success alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title">Sukses !</div>
            <?= session()->getFlashdata('Pesan'); ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="">
        <style>
        .petunjuk_warna>ul {
            margin: 10px 0;
            padding: 0;
        }

        .petunjuk_warna>ul>li {
            display: inline-block;
            text-decoration: none;
            margin-right: 10px;
        }

        .dataTables_scrollBody {
            overflow: inherit !important;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            justify-content: center !important;
        }

        .dataTables_wrapper .dataTables_paginate {
            float: none !important;
        }
        </style>
        <div class="petunjuk_warna">
            <ul>
                <li><i class="fas fa-square-full text-secondary"></i> Netral</li>
                <li><i class="fas fa-square-full text-warning"></i> Akan Jatuh Tempo</li>
                <li><i class="fas fa-square-full text-danger"></i> Jatuh Tempo Hari Ini</li>
                <li><i class="fas fa-square-full text-dark"></i> Sudah lewat Jatuh Tempo</li>
            </ul>
        </div>
        <input type="hidden" id="base_url" value="<?= base_url() ?>" name="">
        <input type="hidden" id="list_url" value="<?= base_url('listgadai') ?>" name="">
        <div style="display: none;" id="table_column">
            [{"data":"no"},{"data":"kode_pinjaman"},{"data":"nama"},{"data":"tgl_gadai"},{"data":"tgl_jatuh_tempo"},{"data":"tgl_lelang"},{"data":"tgl_perpanjangan"},{"data":"jumlah_pinjaman"},{"data":"bunga"},{"data":"kode_cabang"}]
        </div>
        <div style="display: none;" id="table_columnDef">{"className":"first_child","targets":[0]}</div>
        <?php if ($session->get('level') == 'superadmin') :  ?>
        <div style="display: none;" data-style="dropdown" id="table_action">
            {"edit":false,"delete":false,"print":false,"notifWa":false,"detail":true,"pembayaran":false,"perpanjangan":false,"denda":false,"lelang":false}
        </div>
        <?php else : ?>
        <div style="display: none;" data-style="dropdown" id="table_action">
            {"edit":true,"delete":true,"print":true,"notifWa":true,"detail":true,"pembayaran":true,"perpanjangan":true,"denda":true,"lelang":true}
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
            <div class="col-md-2">
                <div class="input-group-prepend">
                    <select class="custom-select selectTahun" id="inputGroupSelect03">
                        <?php
                        foreach ($semua_data_bulanan as $key => $value) {
                        ?>
                        <option value="<?= $value->tahun ?>" selected=""><?= $value->tahun ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group-prepend">
                    <select class="custom-select" id="inputGroupSelect03">
                        <?php
                        foreach ($semua_data_bulanan as $key => $value) {
                        ?>
                        <option value="<?= $value->bulan ?>" selected=""><?= $value->bulan ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group-prepend">
                    <select class="custom-select" id="inputGroupSelect03">
                        <option value="" selected="">Semua Data</option>
                        <option value="">Lunas</option>
                        <option value="">Akan Jatuh Tempo</option>
                        <option value="">Jatuh Tempo</option>
                        <option value="">Menunggu Pembayaran</option>
                    </select>
                </div>
            </div>
        </div>
        <table class="table table-striped table-md datatable" id="">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Nama Nasabah</th>
                    <th>Tgl. Gadai</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl. Lelang</th>
                    <th>Tgl. Perpanjangan</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Bunga</th>
                    <th>Kode Cabang</th>
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
                        <p class="card-text"><b>Kode Pinjaman : <span class="row_kode_pinjaman"></span></b></p>
                        <p class="card-text"><b>Id Nasabah : <span class="row_id_nasabah"></span></b></p>
                        <p class="card-text"><b>No. Telpon : <span class="row_no_telp"></span></b></p>
                        <p class="card-text"><b>Tgl. Gadai: <span class="row_tgl_gadai"></span></b></p>
                        <p class="card-text"><b>Tgl. Jatuh Tempo: <span class="row_jatuh_tempo"></span></b></p>
                        <p class="card-text"><b>Tgl. Lelang: <span class="row_tgl_lelang"></span></b></p>
                        <p class="card-text"><b>Jumlah Pinjaman : <span class="row_jumlah_pinjaman"></span></b></p>
                        <p class="card-text"><b>Bunga : <span class="row_bunga"></span></b></p>
                        <p class="card-text"><b>Kode Cabang : <span class="row_kode_cabang"></span></b></p>
                        <p class="card-text"><b>Status : <span class="row_status_bayar"></span></b></p>
                        <p class="card-text"><b>Jenis Barang : <span class="row_jenis_barang"></span></b></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>