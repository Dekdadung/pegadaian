<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('nasabah') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Detail Nasabah</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Data Nasabah</h4>
                <div class="card-header-action">
                    <a href="/nasabah/edit/" class="btn btn-warning btn-sm"> <i class="fas fa-pencil-alt"></i></a>
                    <a href="/nasabah/delete/" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i></a>
                </div>
            </div>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text"><b>No. Rekening: 098765432</b></p>
                            <p class="card-text"><b>Telepon: 0986543</b></p>
                            <p class="card-text"><b>Saldo: Rp.1000</b></p>
                            <p class="card-text"><b>Username Akun: Dadung</b></p>
                            <p class="card-text"><b>Password Akun: Abcajasa</b></p>
                            <p class="card-text"><b>Level: </b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>