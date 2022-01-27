<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datalelang') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Lelang</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="/pegadaian/savelelang" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kode Pinjaman</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('kode_pinjaman')) ? 'is-invalid' : ''; ?>"
                            id="inputtext4" name="kode_pinjaman" value="<?= $gadai['kode_pinjaman']; ?>" hidden>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('kode_pinjaman')) ? 'is-invalid' : ''; ?>"
                            id="inputtext4" name="kode_pinjaman" value="<?= $gadai['kode_pinjaman']; ?>" disabled>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kode_pinjaman'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal lelang</label>
                        <input type="date"
                            class="form-control <?= ($validation->hasError('tgl_lelang')) ? 'is-invalid' : ''; ?>"
                            id="inputtext4" name="tgl_lelang" value="<?= $gadai['tgl_lelang']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_lelang'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Jenis Barang</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : ''; ?>"
                            id="inputtext4" name="nama_barang" value="<?= $gadai['jenis_barang']; ?>" hidden>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : ''; ?>"
                            id="inputtext4" name="nama_barang" value="<?= $gadai['jenis_barang']; ?>" disabled>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_barang'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Harga Terjual</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('hasil_lelang')) ? 'is-invalid' : ''; ?>"
                            id="rupiah" name="hasil_lelang">
                        <div class="invalid-feedback">
                            <?= $validation->getError('hasil_lelang'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6" hidden>
                    <label for="inputtext4">Kode Cabang</label>
                    <input type="text"
                        class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>"
                        id="rupiah" name="kode_cabang" value="<?= $gadai['kode_cabang']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('kode_cabang'); ?>
                    </div>
                </div>
                <input type="text" class="form-control" id="inputtext4" name="jumlah_pinjaman"
                    value="<?= $gadai['jumlah_pinjaman']; ?>">
                <input type="text" class="form-control" id="inputtext4" name="kode_pinjaman"
                    value="<?= $gadai['kode_pinjaman']; ?>">
                <div class="card-footer">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>