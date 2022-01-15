<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('dataaturan') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Data aturan</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="/aturan/update/<?= $aturan['id_aturan']; ?>" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kode Cabang</label>
                        <input type="text" name="kode_cabang" class="form-control" id="inputtext4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Bunga</label>
                        <input type="text" name="bunga" class="form-control" id="inputtext4">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Denda</label>
                        <input type="text" name="denda" class="form-control" id="inputtext4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kode Toko</label>
                        <input type="text" name="kode_toko" class="form-control" id="inputtext4">
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