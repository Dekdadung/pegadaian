<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Nasabah</h1>
        <div class="section-header-button">
            <a href="<?= site_url('formnasabah') ?>" class="btn btn-primary">Tambah</a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-striped table-md">
            <tbody>
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telpon</th>
                    <th>Kode Cabang</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <div class="text-center">
                    <tr>
                        <td>1</td>
                        <td>Kaleng</td>
                        <td>5000</td>
                        <td>1</td>
                        <td>Kaleng</td>
                        <td>5000</td>
                        <td>1</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </div>
            </tbody>
        </table>
    </div>
</section>
<?= $this->endSection(); ?>