<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datagadai') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Denda Nasabah</h1>
    </div>
    <div class="card">
        <form action="/pegadaian/save2" method="post">
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
                        <label for="inputtext4">Tanggal Lelang</label>
                        <input type="date" class="form-control " id="inputtext4" name="tgl_lelang"
                            value="<?= $gadai['tgl_lelang']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Jumlah Pinjaman</label>
                        <input type="text" class="form-control" id="inputtext4" name="jumlah_pinjaman"
                            value="<?= $gadai['jumlah_pinjaman']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Denda %</label>
                        <input type="text" class="form-control" id="inputtext4" name="dendaP" value=5>
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