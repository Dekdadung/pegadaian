<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Nasabah</h1>
        <div class="section-header-button">
            <a href="<?= site_url('formnasabah') ?>" class="btn btn-primary">Tambah</a>
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
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telpon</th>
                    <th>Kode Cabang</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <div class="text-center">
                    <?php
                    $no = 1;
                    foreach ($nasabah as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['alamat_nasabah']; ?></td>
                        <td><?= $row['no_telp']; ?></td>
                        <td><?= $row['kode_cabang']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/nasabah/edit/<?= $row['id_nasabah']; ?>">Edit</a>
                                    <a class="dropdown-item" href="/nasabah/delete/<?= $row['id_nasabah']; ?>"
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