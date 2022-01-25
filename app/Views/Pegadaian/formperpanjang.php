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
        <form action="/perpanjangan/savePerpanjang" method="post">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6" hidden>
                        <label for="inputtext4">Kode Pinjaman</label>
                        <input type="text" class="form-control" id="inputtext4" name="kode_pinjaman"
                            value="<?= $gadai['kode_pinjaman']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal Perpanjangan</label>
                        <input type="date" class="form-control " id="inputtext4" name="tgl_perpanjangan"
                            value="<?= $perpanjang_ini; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal Lelang</label>
                        <input type="date" class="form-control " id="inputtext4" name="tgl_lelang"
                            value="<?= $gadai['tgl_lelang']; ?>">
                    </div>
                </div>
                <input type="text" name="bunga" value="<?= $gadai['bunga']; ?>" hidden>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    </div>
</section>
<?= $this->endSection() ?>