<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datagadai') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Pembayaran Nasabah</h1>
    </div>
    <div class="card">
        <form action="/Pegadaian/saveBayar" method="post" id="ajx_action_save">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kode Pinjaman</label>
                        <input type="text" class="form-control" id="inputtext4" name="kode_pinjaman" value="<?= $gadai['kode_pinjaman']; ?>" disabled>
                        <input hidden type="text" class="form-control" id="inputtext4" name="kode_pinjaman" value="<?= $gadai['kode_pinjaman']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal Bayar</label>
                        <input type="date" class="form-control " id="inputtext4" name="tgl_bayar" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Jumlah Bayar</label>
                        <input hidden type="text" class="form-control" id="inputtext4" name="jumlah_bayar" value="<?= $gadai['jumlah_pinjaman']; ?>">
                        <input disabled type="text" class="form-control" id="inputtext4" name="jumlah_bayar" value="<?= rupiah($gadai['jumlah_pinjaman']); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Keterangan</label>
                        <input type="text" class="form-control" id="inputtext4" name="keterangan" required>
                    </div>
                </div>
                <input type="text" hidden class="form-control" id="inputtext4" name="kode_cabang" value="<?= $gadai['kode_cabang']; ?>">
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="button_submit" data-title="Simpan">Simpan</button>
            </div>
        </form>
    </div>
    </div>
</section>
<?= $this->endSection() ?>