<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Cabang</h1>
        <div class="section-header-button">
            <a href="<?= site_url('formcabang') ?>" class="btn btn-primary" data-toggle="modal"
                data-target="#exampleModal">Tambah</a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <?php if (session()->getFlashdata('Pesan')) : ?>
        <script type="text/javascript">
        $(document).ready(function() {
            swal({
                title: "Berhasil !",
                text: "<?= session()->getFlashdata('Pesan'); ?>",
                timer: 1500,
                icon: "success"
            });
        });
        </script>
        <?php endif; ?>
        <table class="table table-striped table-md" id="tabelCabang">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Cabang</th>
                    <th>Nama Cabang</th>
                    <th>Alamat</th>
                    <th>No. Telp/WA</th>
                    <th>Kode Toko</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
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
                        <td><?= $row['no_telp']; ?></td>
                        <td><?= $row['kode_toko']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal"
                                        id="btn-edit-cabang" data-kode-cabang="<?= $row['kode_cabang']; ?>"
                                        data-nama-cabang="<?= $row['nama_cabang']; ?>"
                                        data-alamat="<?= $row['alamat']; ?>"
                                        data-kode-toko="<?= $row['kode_toko']; ?>">Edit</a>
                                    <a class="dropdown-item Cdelete-btn" href=""
                                        data-kode-cabang="<?= $row['kode_cabang']; ?>">Delete</a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Cabang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/cabang/save" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Kode Cabang</label>
                            <input type="text" name="kode_cabang"
                                class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>"
                                id="inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kode_cabang'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Nama Cabang</label>
                            <input type="text" name="nama_cabang"
                                class="form-control <?= ($validation->hasError('nama_cabang')) ? 'is-invalid' : ''; ?>"
                                id="inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_cabang'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">No.Telp / WA</label>
                            <input type="text"
                                class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>"
                                name="no_telp">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_telp'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Kode Toko</label>
                            <input type="text" name="kode_toko"
                                class="form-control <?= ($validation->hasError('kode_toko')) ? 'is-invalid' : ''; ?>"
                                id="inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kode_toko'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputtext4">Alamat</label>
                            <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>"
                                name="alamat"></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Cabang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formcabang">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Kode Cabang</label>
                            <input type="text" name="kode_cabang"
                                class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>"
                                id="kode-cabang" value="">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kode_cabang'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Nama Cabang</label>
                            <input type="text" name="nama_cabang"
                                class="form-control <?= ($validation->hasError('nama_cabang')) ? 'is-invalid' : ''; ?>"
                                id="nama-cabang" value="">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_cabang'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">No.Telp / WA</label>
                            <input type="text"
                                class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>"
                                name="no_telp" id="no_telp">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_telp'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Kode Toko</label>
                            <input type="text" name="kode_toko"
                                class="form-control <?= ($validation->hasError('kode_toko')) ? 'is-invalid' : ''; ?>"
                                id="kode-toko" value="">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kode_toko'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputtext4">Alamat</label>
                            <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>"
                                name="alamat" id="alamat"></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#tabelCabang').DataTable({
        responsive: true
    });
});
</script>
<?= $this->endSection(); ?>