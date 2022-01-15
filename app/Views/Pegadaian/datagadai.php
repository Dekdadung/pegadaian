<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Gadai</h1>
        <div class="section-header-button">
            <a href="<?= site_url('formgadai') ?>" class="btn btn-primary">Tambah</a>
        </div>
    </div>
    <?php if (session()->getFlashdata('Pesan')) : ?>
    <div class="alert alert-success alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title">Sukses !</div>
            <?= session()->getFlashdata('Pesan'); ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="card-body table-responsive">
        <table class="table table-striped table-md" id="mytable">
            <tbody>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Nama Nasabah</th>
                    <th>Tgl. Gadai</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl. Lelang</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Bunga</th>
                    <th>Kode Cabang</th>
                    <th>Action</th>
                </tr>
                <div>
                    <?php
                    $no = 1;
                    foreach ($gadai as $row) :
                    ?>
                    <tr class="text-center">
                        <td><?= $no++; ?></td>
                        <td><?= $row->kode_pinjaman; ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= $row->tgl_gadai ?></td>
                        <td><?= $row->tgl_jatuh_tempo ?></td>
                        <td><?= $row->tgl_lelang ?></td>
                        <td><?= rupiah($row->jumlah_pinjaman); ?></td>
                        <td><?= rupiah($row->bunga) ?></td>
                        <td><?= $row->kode_cabang ?></td>
                        <td>
                            <textarea name="" hidden class="datarow-<?= $row->kode_pinjaman ?>"
                                id=""><?= json_encode($row); ?></textarea>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btn-detail" href="">Kirim Notifikasi</a>
                                    <a class="dropdown-item btn-detail"
                                        href="/pegadaian/detail/<?= $row->kode_pinjaman ?>"
                                        data-kdpinjaman="<?= $row->kode_pinjaman ?>">Detail</a>
                                    <a class="dropdown-item" href="/pegadaian/edit/<?= $row->kode_pinjaman ?>">Edit</a>
                                    <a class="dropdown-item" href="/pegadaian/delete/<?= $row->kode_pinjaman ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                                    <a class="dropdown-item"
                                        href="/pembayaran/createBayar/<?= $row->kode_pinjaman ?>">Pembayaran</a>
                                    <a class="dropdown-item"
                                        href="/perpanjangan/createPerpanjang/<?= $row->kode_pinjaman ?>">Perpanjangan</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </div>

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