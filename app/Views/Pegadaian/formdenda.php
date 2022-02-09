<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datalelang') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Denda Nasabah</h1>
    </div>
    <div class="card">
        <form action="/pegadaian/saveDenda" method="post">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputtext4">Kode Pinjaman</label>
                        <input type="text" class="form-control" id="inputtext4" name="kode_pinjaman"
                            value="<?= $gadai['kode_pinjaman']; ?>" disabled>
                        <input hidden type="text" class="form-control" id="inputtext4" name="kode_pinjaman"
                            value="<?= $gadai['kode_pinjaman']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal Jatuh Tempo</label>
                        <input type="text" class="form-control datepicker" id="inputtext4" name="tgl_jatuh_tempo"
                            value="<?= $gadai['tgl_jatuh_tempo']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal Lelang</label>
                        <input type="text" class="form-control datepicker" id="inputtext4" name="tgl_lelang"
                            value="<?= $gadai['tgl_lelang']; ?>">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="inputtext4">Keterangan</label>
                    <textarea type="text"
                        class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>"
                        name="keterangan"></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('keterangan'); ?>
                    </div>
                </div>
                <h5>Jumlah Yang Harus dibayarkan Nasabah :</h5>
                <p>Jumlah Denda adalah <b>5% Pinjaman</b> + <b>10% Pinjaman(Sesuai Bunga yang diberikan diawal)</b></p>
                <div class="form-row" hidden>
                    <div class="form-group col-md-4">
                        <label for="inputtext4">Jumlah Pinjaman</label>
                        <input type="text" class="form-control" id="inputtext4" name="jumlah_pinjaman"
                            value="<?= $gadai['jumlah_pinjaman']; ?>">
                    </div>
                    <div class="form-group col-md-4" hidden>
                        <label for="inputtext4">Denda %</label>
                        <input type="text" class="form-control" id="inputtext4" name="dendaP" value=5>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputtext4">Bunga </label>
                        <input type="text" class="form-control" id="inputtext4" name="bunga"
                            value="<?= $gadai['bunga'] ?>">
                    </div>
                </div>
                <h5>Jumlah Pinjaman : Rp. <?= rupiah($gadai['jumlah_pinjaman']); ?></h5>
                <div class="row">
                    <div class="col-md-4">
                        <ul style="list-style-type:none;padding:0px">
                            <li>Bunga .............................................. <b>Rp.
                                    <?= rupiah($gadai['bunga']); ?></b></li>
                            <li>Denda .............................................. <b>Rp.
                                    <?= rupiah($gadai['jumlah_pinjaman'] * (5 / 100)); ?></b></li>
                            <li>Total Pembayaran Denda :</li>
                        </ul>
                    </div>
                    <div class="col-md-8"></div>
                </div>
                <h3>Rp. <?= rupiah(($gadai['jumlah_pinjaman'] * (5 / 100)) + $gadai['bunga']); ?></h3>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Bayar Denda</button>
            </div>
        </form>
    </div>
    </div>
</section>
<?= $this->endSection() ?>