<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datanasabah') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Data Nasabah</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtext4">Nama Nasabah</label>
                    <input type="text" name="nama" class="form-control" id="inputtext4">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputtext4">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="inputtext4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtext4">Telpon</label>
                    <input type="text" name="no_telp" class="form-control" id="inputtext4">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputtext4">Kode Cabang</label>
                    <input type="text" name="kode_cabang" class="form-control" id="inputtext4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtext4">Status</label>
                    <div class="form-label-group">
                        <select class="form-control" name="status">
                            <option value="aktif">Aktif</option>
                            <option value="tidak_aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</section>
<?= $this->endSection() ?>