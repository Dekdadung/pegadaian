<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Data Keuangan Bank</h4>
            </div>
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
                    <div class="hero align-items-center bg-white text-black">
                        <div class="hero-inner text-center">
                            <h2>Total Kas Pegadaian</h2>
                            <p class="lead"> Cara manggil saldonya gimana?
                            </p>
                            <form action="/saldo/save" method="post">
                                <div class="text-center navbar-header search mt-2"
                                    style="display: inline-block; float: none; margin: 0 auto;">
                                    <input type="text" id="search" class="form-control" name="jumlah_kas"
                                        placeholder="Masukkan Saldo">
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>