<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datacabang') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Data Cabang</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtext4">Kode Cabang</label>
                    <input type="text" name="kode_cabang" class="form-control" id="inputtext4">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputtext4">Nama Cabang</label>
                    <input type="text" name="nama_cabang" class="form-control" id="inputtext4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtext4">Alamat</label>
                    <textarea class="form-control" name="alamat"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputtext4">Kode Toko</label>
                    <input type="text" name="kode_toko" class="form-control" id="inputtext4">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</section>
<?= $this->endSection() ?>