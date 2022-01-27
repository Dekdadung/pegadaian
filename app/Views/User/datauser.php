<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data User</h1>
        <div class="section-header-button">
            <a href="<?= site_url('formuser') ?>" class="btn btn-primary" data-toggle="modal"
                data-target="#exampleModal">Tambah User</a>
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
                    <th>Cabang</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
                <div class="text-center">
                    <?php
                    $no = 1;
                    foreach ($user as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_user']; ?></td>
                        <td><?= $row['cabang']; ?></td>
                        <td><?= $row['level']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal"
                                        id="btn-edit-user" data-id-user="<?= $row['id_user']; ?>"
                                        data-nama-user="<?= $row['nama_user']; ?>" data-cabang="<?= $row['cabang']; ?>"
                                        data-level="<?= $row['level']; ?>" data-username="<?= $row['username']; ?>"
                                        data-password="<?= $row['password']; ?>">Edit</a>
                                    <a class="dropdown-item" href="/user/delete/<?= $row['id_user']; ?>"
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user/save" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Nama User</label>
                            <input type="text" name="nama_user"
                                class="form-control <?= ($validation->hasError('nama_user')) ? 'is-invalid' : ''; ?>"
                                id="inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_user'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Level</label>
                            <div class="form-label-group">
                                <select class="form-control" name="level">
                                    <option value="admin">admin</option>
                                    <option value="superadmin">superadmin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Username</label>
                            <input type="text" name="username"
                                class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>"
                                id="inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Password</label>
                            <input type="text" name="password"
                                class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                                id="inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Cabang</label>
                            <div class="form-label-group">
                                <select class="form-control" name="cabang">
                                    <?php foreach ($cabang as $row) : ?>
                                    <option value="<?= $row['kode_cabang']; ?>">
                                        <?= $row['nama_cabang']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
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
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formUser" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Nama User</label>
                            <input type="text" name="nama_user"
                                class="form-control <?= ($validation->hasError('nama_user')) ? 'is-invalid' : ''; ?>"
                                id="nama-user">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_user'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Level</label>
                            <div class="form-label-group">
                                <select class="form-control" name="level">
                                    <option value="admin">admin</option>
                                    <option value="superadmin">superadmin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Username</label>
                            <input type="text" name="username"
                                class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>"
                                id="username">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Password</label>
                            <input type="text" name="password"
                                class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                                id="">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Cabang</label>
                            <div class="form-label-group">
                                <select class="form-control" name="cabang">
                                    <?php foreach ($cabang as $row) : ?>
                                    <option value="<?= $row['kode_cabang']; ?>">
                                        <?= $row['nama_cabang']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>