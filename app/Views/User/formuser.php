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
                        <input type="text" name="nama_user" class="form-control" id="inputtext4">
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
                        <input type="text" name="username" class="form-control" id="inputtext4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Password</label>
                        <input type="text" name="password" class="form-control" id="inputtext4">
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