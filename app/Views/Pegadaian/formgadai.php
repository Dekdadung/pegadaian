<?php
$session = session();
?>

<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datagadai') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Data Gadai</h1>
        <div class="section-header-button">

        </div>
        <?php if ($session->get('level') == 'superadmin') :  ?>
        <div class="section-header-breadcrumb">
            <form action="" method="get">
                <div class="form-control">
                    <label>Pilih Cabang</label>
                    <select class="form-floating mb-3" name="kode_cabang" required onchange="this.form.submit()">
                        <option value="">Pilih Cabang!</option>
                        <?php foreach ($cabang as $row) : ?>
                        <option value="<?= $row['kode_cabang']; ?>"
                            <?= ($row['kode_cabang'] == $kode_cabang) ? 'selected' : ''; ?>>
                            <?= $row['nama_cabang']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
        <?php else : ?>
        <?php endif ?>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="/pegadaian/save" method="post" id="myForm">
                <input hidden type="text" name="kode_cabang" value="<?= $kode_cabang ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kode Pinjaman</label>
                        <input type="hidden" name="kode_pinjaman" value="<?= $kode_pinjaman ?>">
                        <input type="text" class="form-control" id="inputtext4" name="kode_pinjaman" disabled
                            value="<?= $kode_pinjaman ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal Gadai</label>
                        <input type="date" class="form-control" id="inputtext4" name="tgl_gadai"
                            value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Nama Nasabah</label>
                        <div class="form-label-group">
                            <select class="form-control" name="id_nasabah">
                                <?php foreach ($nasabah as $row) : ?>
                                <option value="<?= $row->id_nasabah; ?>">
                                    <?= $row->nama; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tgl. Jatuh Tempo</label>
                        <input type="date" class="form-control" id="inputtext4" name="tgl_jatuh_tempo"
                            value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">No. Telpon</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>"
                            id="inputtext4" name="no_telp">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telp'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tgl. Lelang</label>
                        <input type="date" class="form-control" id="inputtext4" name="tgl_lelang"
                            value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Jumlah Pinjaman</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('jumlah_pinjaman')) ? 'is-invalid' : ''; ?>"
                            id="rupiah" name="jumlah_pinjaman">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah_pinjaman'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Bunga</label>
                        <div class="form-label-group">
                            <select class="form-control" name="bungaP">
                                <?php foreach ($aturan as $row) : ?>
                                <option value="<?= $row['bunga']; ?>">
                                    <?= $row['bunga']; ?>%
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4" hidden>
                        <label for="inputtext4">Bunga</label>
                        <input type="number" hidden class="form-control" id="inputtext4" name="bunga">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Jenis Barang</label>
                        <div class="form-label-group">
                            <select class="form-control" name="jenis_barang">
                                <?php foreach ($barang as $row) : ?>
                                <option value="<?= $row['nama_barang']; ?>">
                                    <?= $row['nama_barang']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">No. IMEI/Seri</label>
                        <input type="text" class="form-control" id="inputSeri" name="seri">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Jumlah Barang</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>"
                            id="inputZip" name="jumlah">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kelengkapan</label>
                        <textarea class="form-control" id="" name="kelengkapan"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kondisi</label>
                        <div class="form-label-group">
                            <select class="form-control" name="kondisi">
                                <option value="Baru">Baru</option>
                                <option value="Bekas">Bekas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>