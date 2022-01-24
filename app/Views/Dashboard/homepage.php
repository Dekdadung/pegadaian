<?php
$session = session();
?>

<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <?php if ($session->get('level') == 'superadmin') :  ?>
    <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-button">
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
        <div class="section-header-breadcrumb mt-3">
            <h6>Tanggal Hari Ini : <?= date('Y-m-d') ?></h6>
        </div>
    </div>
    <?php else : ?>
    <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb mt-3">
            <h6>Tanggal Hari Ini : <?= date('Y-m-d') ?></h6>
        </div>
    </div>
    <?php endif ?>


    <div class="section-body">
        <?php if ($session->get('level') == 'superadmin') :  ?>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sisa Saldo</h4>
                        </div>
                        <div class="card-body">
                            <h6><?php echo rupiah($saldo); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Akan Jatuh Tempo</h4>
                        </div>
                        <div class="card-body">
                            <h6><?php echo $jTempo; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Peminjaman Hari Ini</h4>
                        </div>
                        <div class="card-body">
                            <h6><?php echo rupiah($totalpinjam); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pendapatan Hari Ini</h4>
                        </div>
                        <div class="card-body">
                            <h6><?php echo rupiah($totaldapat); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else : ?>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sisa Saldo</h4>
                        </div>
                        <div class="card-body">
                            <h6><?php echo rupiah($saldo); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Akan Jatuh Tempo</h4>
                        </div>
                        <div class="card-body">
                            <h6><?php echo $jTempo; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-striped table-sm">
            <tbody>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Nama Nasabah</th>
                    <th>Tgl. Gadai</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl. Lelang</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Bunga</th>
                    <th>Kode Cabang</th>
                </tr>
                <div>
                    <?php
                    $no = 1;
                    foreach ($home as $row) :
                    ?>
                    <tr class="text-center">
                        <td><?= $no++; ?></td>
                        <td><?= $row->kode_pinjaman; ?></td>
                        <td><?= $row->nama; ?></td>
                        <td><?= $row->tgl_gadai; ?></td>
                        <td><?= $row->tgl_jatuh_tempo; ?></td>
                        <td><?= $row->tgl_lelang; ?></td>
                        <td><?= rupiah($row->jumlah_pinjaman); ?></td>
                        <td><?= rupiah($row->bunga) ?></td>
                        <td><?= $row->kode_cabang; ?></td>
                        <textarea name="" hidden class="datarow-<?= $row->kode_pinjaman; ?>"
                            id=""><?= json_encode($row); ?></textarea>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </div>
            </tbody>
        </table>
    </div>
    </div>
</section>
<?= $this->endSection(); ?>