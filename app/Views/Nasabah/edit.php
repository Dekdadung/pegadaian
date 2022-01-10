<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datanasabah') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Ubah Data Nasabah</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="/nasabah/update/<?= $nasabah['id_nasabah']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Nama Nasabah</label>
                        <input type="text" name="nama"
                            class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="
                            inputtext4" value="<?= $nasabah['nama']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Alamat</label>
                        <textarea type="text" name="alamat"
                            class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>"
                            id="inputtext4"><?= $nasabah['alamat']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Telpon</label>
                        <input type="text" name="no_telp"
                            class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>"
                            id="inputtext4" value="<?= $nasabah['no_telp']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telp'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kode Cabang</label>
                        <select class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>"
                            name=" kode_cabang">
                            <option hidden selected=""><?= $nasabah['kode_cabang']; ?></option>
                            <?php foreach ($cabang as $row) : ?>
                            <option value="<?= $row['kode_cabang']; ?>">
                                <?= $row['nama_cabang']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kode_cabang'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Status</label>
                        <div class="form-label-group">
                            <select class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>"
                                name="status">
                                <option hidden selected=""><?= $nasabah['status']; ?></option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('status'); ?>
                            </div>
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