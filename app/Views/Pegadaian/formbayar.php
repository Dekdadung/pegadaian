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
        <form action="/pembayaran/saveBayar" method="post">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kode Pinjaman</label>
                        <input type="text" class="form-control" id="inputtext4" name="kode_pinjaman"
                            value="<?= $gadai['kode_pinjaman']; ?>" disabled>
                        <input hidden type="text" class="form-control" id="inputtext4" name="kode_pinjaman"
                            value="<?= $gadai['kode_pinjaman']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal Bayar</label>
                        <input type="date" class="form-control " id="inputtext4" name="tgl_bayar">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Jumlah Bayar</label>
                        <input type="text" class="form-control" id="inputtext4" name="jumlah_bayar">

                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Keterangan</label>
                        <input type="text" class="form-control" id="inputtext4" name="keterangan">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Sisa Bayar</label>
                        <input type="text" class="form-control" id="inputtext4" name="sisa_bayar"
                            value="<?= $sisa_bayar; ?>" hidden>
                        <input type="text" class="form-control" id="inputtext4" name="sisa_bayar"
                            value="<?= $sisa_bayar; ?>" disabled>
                    </div>
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