<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Cabang</h1>
        <div class="section-header-button">
            <a href="<?= site_url('formcabang') ?>" class="btn btn-primary">Tambah</a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <?php if (session()->getFlashdata('Pesan')) : ?>
        <div class="alert alert-success alert-has-icon">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Sukses !</div>
                <?= session()->getFlashdata('Pesan'); ?>
            </div>
        </div>
        <?php endif; ?>
        <table class="table table-striped table-md">
            <tbody>
                <tr>
                    <th>No</th>
                    <th>Kode Cabang</th>
                    <th>Nama Cabang</th>
                    <th>Alamat</th>
                    <th>Kode Toko</th>
                    <th>Action</th>
                </tr>
                <div class="text-center">
                    <?php
                    $no = 1;
                    foreach ($cabang as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['kode_cabang']; ?></td>
                        <td><?= $row['nama_cabang']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['kode_toko']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/cabang/edit/<?= $row['kode_cabang']; ?>">Edit</a>
                                    <a class="dropdown-item" href="/cabang/delete/<?= $row['kode_cabang']; ?>"
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
<?= $this->endSection(); ?>