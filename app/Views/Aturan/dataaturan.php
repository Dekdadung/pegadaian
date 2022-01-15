<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Aturan Cabang</h1>
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
                    <th>Bunga</th>
                    <th>Denda</th>
                    <th>Action</th>
                </tr>
                <div class="text-center">
                    <?php
                    $no = 1;
                    foreach ($aturan as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->kode_cabang; ?></td>
                        <td><?= $row->bunga; ?></td>
                        <td><?= $row->denda; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/aturan/edit/<?= $row->id_peraturan; ?>">Edit</a>
                                    <a class="dropdown-item" href="/aturan/delete/<?= $row->id_peraturan; ?>"
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