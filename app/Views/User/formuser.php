<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datauser') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Data User</h1>
    </div>
    <div class="card">
        <div class="card-body">
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
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>