<?php
$session = session();
?>
<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Nasabah</h1>
        <div class="section-header-button">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                data-target="#exampleModal">Tambah
                Nasabah</button>
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
        <table class="table table-striped table-md" id="tabelNasabah">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telpon</th>
                    <th>Kode Cabang</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <div class="text-center">
                    <?php
                    $no = 1;
                    foreach ($nasabah as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nama; ?></td>
                        <td><?= $row->alamat_nasabah; ?></td>
                        <td><?= $row->no_telp; ?></td>
                        <td><?= $row->kode_cabang; ?></td>
                        <td><?= $row->status; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#editModal" href="#"
                                        id="btn-edit-nasabah" data-id-nasabah="<?= $row->id_nasabah; ?>"
                                        data-nama="<?= $row->nama; ?>" data-alamat="<?= $row->alamat_nasabah; ?>"
                                        data-telpon="<?= $row->no_telp; ?>" data-kode-cabang="<?= $row->kode_cabang; ?>"
                                        data-status="
                                        <?= $row->status; ?>" data-nik="<?= $row->nik; ?>">Edit</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal"
                                        href="/nasabah/delete/<?= $row->id_nasabah; ?>"
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/nasabah/save" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Nama Nasabah</label>
                            <input type="text" name="nama"
                                class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="
                            inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Alamat</label>
                            <textarea type="text" name="alamat_nasabah"
                                class="form-control <?= ($validation->hasError('alamat_nasabah')) ? 'is-invalid' : ''; ?>"
                                id="inputtext4"></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat_nasabah'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Telpon</label>
                            <input type="text" name="no_telp"
                                class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>"
                                id="inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_telp'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <?php if ($session->get('level') == 'superadmin') :  ?>
                            <label for="inputtext4">Kode Cabang</label>
                            <select
                                class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>"
                                name=" kode_cabang">
                                <?php foreach ($cabang as $row) : ?>
                                <option value="<?= $row['kode_cabang']; ?>">
                                    <?= $row['nama_cabang']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('kode_cabang'); ?>
                            </div>
                            <?php else : ?>
                            <label for="inputtext4">Kode Cabang</label>
                            <input type="text" name="kode_cabang" hidden
                                class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>"
                                id="inputtext4" value="<?= $kode_cabang ?>">
                            <input type="text" name="kode_cabang" disabled
                                class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>"
                                id="inputtext4" value="<?= $kode_cabang ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kode_cabang'); ?>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">NIK Nasabah</label>
                            <input type="text" name="nik"
                                class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="
                            inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nik'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Status</label>
                            <div class="form-label-group">
                                <select
                                    class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>"
                                    name="status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('status'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formNasabah" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Nama Nasabah</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Alamat</label>
                            <textarea type="text" name="alamat_nasabah" id="alamat"
                                class="form-control <?= ($validation->hasError('alamat_nasabah')) ? 'is-invalid' : ''; ?>"></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat_nasabah'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Telpon</label>
                            <input type="text" name="no_telp" id="telpon"
                                class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_telp'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Kode Cabang</label>
                            <input type="text" name="kode_cabang" hidden
                                class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>"
                                id="kode-cabang">
                            <input type="text" name="kode_cabang" disabled id="kode-cabang"
                                class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>"
                                id="kode-cabang">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kode_cabang'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">NIK Nasabah</label>
                            <input type="text" name="nik" id="nik"
                                class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="
                            nik" value="">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nik'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Status</label>
                            <div class="form-label-group">
                                <select
                                    class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>"
                                    name="status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('status'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#tabelNasabah').DataTable();
});
</script>

<?= $this->endSection(); ?>