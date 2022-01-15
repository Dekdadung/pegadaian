<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Data Saldo</h1>
        <div class="section-header-button">

        </div>
        <div class="section-header-breadcrumb">
            <form action="" method="get">
                <div class="form-control">
                    <label>Pilih Cabang</label>
                    <select class="form-floating mb-3" name="kode_cabang" required onchange="this.form.submit()">
                        <option value="">Pilih Cabang!</option>
                        <?php foreach ($cabang as $row) : ?>
                        <option value="<?= $row['kode_cabang']; ?>"> <?= $row['nama_cabang']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card body">
                <?php if (session()->getFlashdata('Pesan')) : ?>
                <div class="alert alert-success alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Sukses !</div>
                        <?= session()->getFlashdata('Pesan'); ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-12 mb-4">
                    <div class="row align-items-center g-lg-5 py-5">
                        <div class="col-lg-7 text-lg-start">
                            <div class="text-center">
                                <h5 class="display-4 fw-bold">Saldo Anda Sejumlah <?php echo rupiah($saldo); ?></h5>
                            </div>
                            <h5 class="fw-bold">Terakhir Diisi Tanggal : <?php echo $tgl; ?></h5>
                        </div>
                        <div class="col-md-10 mx-auto col-lg-5">
                            <form action="saldo/save" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
                                <div class="form-floating mb-3">
                                    <label for="floatingInput">Saldo</label>
                                    <input type="text" name="jumlah_kas"
                                        class="form-control <?= ($validation->hasError('jumlah_kas')) ? 'is-invalid' : ''; ?>"
                                        id="">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jumlah_kas'); ?>
                                    </div>
                                </div>
                                <input type="hidden" name="kode_cabang" value="<?= $kode_cabang_sekarang ?>">
                                <div class="form-floating mb-3">
                                    <label for="floatingPassword">Keterangan</label>
                                    <textarea class="form-control" name="keterangan"></textarea>
                                </div>
                                <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>