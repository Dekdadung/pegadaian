<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1><?= date('Y-m-d') ?>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="<?= site_url('jsampah'); ?>">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Peminjaman Bulan Ini</h4>
                            </div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="<?= site_url('nasabah'); ?>">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Sisa Saldo</h4>
                            </div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="<?= site_url('pengepul'); ?>">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pendapatan Bulan Ini</h4>
                            </div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="<?= site_url('pesan'); ?>">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Akan Jatuh Tempo</h4>
                            </div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-striped table-md">
            <tbody>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Id Nasabah</th>
                    <th>Tgl. Gadai</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl. Lelang</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Kode Cabang</th>
                    <th>Action</th>
                </tr>
                <div class="text-center">
                    <?php
                    $no = 1;
                    foreach ($home as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['kode_pinjaman']; ?></td>
                        <td><?= $row['id_nasabah']; ?></td>
                        <td><?= $row['tgl_gadai']; ?></td>
                        <td><?= $row['tgl_jatuh_tempo']; ?></td>
                        <td><?= $row['tgl_lelang']; ?></td>
                        <td><?= rupiah($row['jumlah_pinjaman']); ?></td>
                        <td><?= $row['kode_cabang']; ?></td>
                        <td>
                            <textarea name="" hidden class="datarow-<?= $row['kode_pinjaman']; ?>"
                                id=""><?= json_encode($row); ?></textarea>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btn-detail"
                                        href="/pegadaian/detail/<?= $row['kode_pinjaman']; ?>"
                                        data-kdpinjaman="<?= $row['kode_pinjaman']; ?>">Detail</a>
                                    <a class="dropdown-item"
                                        href="/pegadaian/edit/<?= $row['kode_pinjaman']; ?>">Edit</a>
                                    <a class="dropdown-item" href="/pegadaian/delete/<?= $row['kode_pinjaman']; ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </div>

            </tbody>
        </table>
    </div>
</section>
<?= $this->endSection(); ?>