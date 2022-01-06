<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Gadai</h1>
        <div class="section-header-button">
            <!-- <a href="<?= site_url('formgadai') ?>" class="btn btn-primary">Tambah</a> -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Launch demo modal
            </button>
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
        <table class="table table-striped table-md">
            <tbody>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Id Nasabah</th>
                    <th>Tgl. Gadai</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl. Lelang</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Kode Cabang</th>
                    <th>Action</th>
                    <!-- <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Id Nasabah</th>
                    <th>Jenis Barang</th>
                    <th>Kelengkapan</th>
                    <th>Jumlah</th>
                    <th>Tgl. Gadai</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl. Lelang</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Bunga</th>
                    <th>Kode Cabang</th>
                    <th>Action</th> -->
                </tr>
                <div class="text-center">
                    <?php
                    $no = 1;
                    foreach ($gadai as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['kode_pinjaman']; ?></td>
                        <td><?= $row['id_nasabah']; ?></td>
                        <td><?= $row['tgl_gadai']; ?></td>
                        <td><?= $row['tgl_jatuh_tempo']; ?></td>
                        <td><?= $row['tgl_lelang']; ?></td>
                        <td><?= $row['jumlah_pinjaman']; ?></td>
                        <td><?= $row['kode_cabang']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#modalDetail"
                                        href="/pegadaian/edit/<?= $row['kode_pinjaman']; ?>">Detail</a>
                                    <a class="dropdown-item"
                                        href="/pegadaian/edit/<?= $row['kode_pinjaman']; ?>">Edit</a>
                                    <a class="dropdown-item" href="/pegadaian/delete/<?= $row['kode_pinjaman']; ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
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
<<!-- Modal -->
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
                            <p class="card-text"><b>Kode Pinjaman : <?= $row['kode_pinjaman']; ?></b></p>
                            <p class="card-text"><b>Id Nasabah : <?= $row['id_nasabah']; ?></b></p>
                            <p class="card-text"><b>No. Telpon : <?= $row['no_telp']; ?></b></p>
                            <p class="card-text"><b>Tgl. Gadai: <?= $row['tgl_gadai']; ?></b></p>
                            <p class="card-text"><b>Tgl. Jatuh Tempo: <?= $row['tgl_jatuh_tempo']; ?></b></p>
                            <p class="card-text"><b>Tgl. Lelang: <?= $row['tgl_lelang']; ?></b></p>
                            <p class="card-text"><b>Jumlah Pinjaman : <?= $row['jumlah_pinjaman']; ?></b></p>
                            <p class="card-text"><b>Bunga : <?= $row['bunga']; ?> %</b></p>
                            <p class="card-text"><b>Kode Cabang : <?= $row['kode_cabang']; ?></b></p>
                            <p class="card-text"><b>Status : <?= $row['status_bayar']; ?></b></p>
                            <p class="card-text"><b>Jenis Barang : <?= $row['jenis_barang']; ?></b></p>
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