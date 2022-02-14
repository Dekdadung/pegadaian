<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datagadai') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Perpanjangan Tempo</h1>
    </div>
    <div class="card">
        <form action="/pegadaian/savePerpanjang" method="post" id="form_save_with_date">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6" hidden>
                        <label for="inputtext4">Kode Pinjaman</label>
                        <input type="text" class="form-control" id="inputtext4" name="kode_pinjaman" value="<?= $gadai['kode_pinjaman']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal Perpanjangan</label>
                        <input type="text" class="form-control datepicker" id="tgl_jatuh_tempo" data-datenow="<?= $perpanjang_ini; ?>" name="tgl_perpanjangan" value="<?= $perpanjang_ini; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal Lelang</label>
                        <input type="text" class="form-control datepicker" id="tgl_lelang" data-datenow="<?= $gadai['tgl_lelang']; ?>" name="tgl_lelang" value="<?= $gadai['tgl_lelang']; ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputtext4">Keterangan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" name="keterangan" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('keterangan'); ?>
                        </div>
                    </div>
                </div>
                <input type="text" name="bunga" value="<?= $gadai['bunga']; ?>" hidden>
                <h5>Jumlah Bunga Yang Harus Dibayar Nasabah :</h5>
                <p>Jumlah Pembayaran adalah <?= $gadai['jumlah_pinjaman'] / $gadai['bunga']; ?>% dari jumlah pinjmanan sebelumnya</p>
                <h3>Rp. <?= rupiah($gadai['bunga']); ?></h3>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
    </div>
</section>
<?= $this->endSection() ?>