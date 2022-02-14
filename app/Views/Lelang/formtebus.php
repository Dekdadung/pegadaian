<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datalelang') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Penebusan Barang</h1>
    </div>
    <div class="card">
        <form action="/Pegadaian/saveTebus" method="post" id="ajx_action_save">
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
                        <label for="inputtext4">Jumlah Pinjaman</label>
                        <input hidden type="text" class="form-control" id="inputtext4" name="jumlah_bayar" value="<?= $gadai['jumlah_pinjaman']; ?>">
                        <input disabled type="text" class="form-control" id="inputtext4" name="jumlah_bayar" value="<?= rupiah($gadai['jumlah_pinjaman']); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Keterangan</label>
                        <input type="text" class="form-control" id="inputtext4" name="keterangan" required>
                    </div>
                </div>
                <div class="form-group col-md-12" hidden>
                    <label for="inputtext4">Denda %</label>
                    <input type="text" class="form-control" id="inputtext4" name="dendaP" value=5>
                </div>
                <input type="text" hidden class="form-control" id="inputtext4" name="kode_cabang" value="<?= $gadai['kode_cabang']; ?>">

                <h5>Jumlah Pinjaman : Rp. <?= rupiah($gadai['jumlah_pinjaman']); ?></h5>
                <div class="row">
                    <div class="col-md-4">
                        <ul style="list-style-type:none;padding:0px">
                            <li>Denda (5%) .............................................. <b>Rp.
                                    <?= rupiah($gadai['jumlah_pinjaman'] * (5 / 100)); ?></b></li>
                            <li>Total Penebusan Barang :</li>
                        </ul>
                    </div>
                    <div class="col-md-8"></div>
                </div>
                <h3>Rp. <?= rupiah(($gadai['jumlah_pinjaman'] * (5 / 100) + $gadai['jumlah_pinjaman'])); ?></h3>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit" id="button_submit" data-title="Tebus">Tebus</button>
            </div>
        </form>
    </div>
    </div>
</section>
<?= $this->endSection() ?>