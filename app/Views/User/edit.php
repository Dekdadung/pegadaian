<?= $this->extend('layout/default'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datauser') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Ubah Data User</h1>
    </div>
    <div class="card">
        <form action="/user/update/<?= $user['id_user']; ?>" method="post">
            <div class="card-body">
                <?= csrf_field(); ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Nama User</label>
                        <input type="text" name="nama_user" value="<?= $user['nama_user']; ?>" class="form-control"
                            id="inputtext4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Level</label>
                        <div class="form-label-group">
                            <select class="form-control" name="level">
                                <option hidden selected=""><?= $user['level']; ?></option>
                                <option value="admin">Admin</option>
                                <option value="superadmin">SuperAdmin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Username</label>
                        <input type="text" name="username" value="<?= $user['username']; ?>" class="form-control"
                            id="inputtext4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Password</label>
                        <input type="text" name="password" value="<?= $user['password']; ?>" class="form-control"
                            id="inputtext4">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Cabang</label>
                        <div class="form-label-group">
                            <select class="form-control" name="cabang">
                                <option hidden selected=""><?= $user['cabang']; ?></option>
                                <?php foreach ($cabang as $row) : ?>
                                <option value="<?= $row['kode_cabang']; ?>">
                                    <?= $row['nama_cabang']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>