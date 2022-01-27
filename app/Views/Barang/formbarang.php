<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('databarang') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Jenis Barang</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="/barang/save" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" id="inputtext4"
                            placeholder="Masukkan Nama Barang">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>