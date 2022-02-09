<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datagadai') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Edit Data Pegadaian</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="/pegadaian/update/<?= $gadai['kode_pinjaman']; ?>" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kode Pinjaman</label>
                        <input type="text" class="form-control <?= ($validation->hasError('kode_pinjaman')) ? 'is-invalid' : ''; ?>" id="inputtext4" name="kode_pinjaman" value="<?= $gadai['kode_pinjaman']; ?>" disabled>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kode_pinjaman'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Nama Nasabah</label>
                        <div class="form-label-group">
                            <select class="form-control" name="id_nasabah">
                                <?php foreach ($nasabah as $row) : ?>
                                    <option value="<?= $row['id_nasabah']; ?>" <?= ($row['id_nasabah'] == $gadai['id_nasabah']) ? 'selected' : ''; ?> disabled>
                                        <?= $row['nama']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputtext4">Tanggal Gadai</label>
                        <input type="date" class="form-control <?= ($validation->hasError('tgl_gadai')) ? 'is-invalid' : ''; ?>" id="inputtext4" name="tgl_gadai" value="<?= $gadai['tgl_gadai']; ?>" disabled>
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_gadai'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputtext4">Tgl. Jatuh Tempo</label>
                        <input type="date" class="form-control" id="inputtext4" name="tgl_jatuh_tempo" value="<?= $gadai['tgl_jatuh_tempo']; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputtext4">Tgl. Lelang</label>
                        <input type="date" class="form-control" id="inputtext4" name="tgl_lelang" value="<?= $gadai['tgl_lelang']; ?>" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputtext4">Jumlah Pinjaman</label>
                        <input type="text" class="form-control" id="rupiah" name="jumlah_pinjaman" value="<?= $gadai['jumlah_pinjaman']; ?>" hidden>
                        <input type="text" class="form-control" id="rupiah" name="jumlah_pinjaman" value="<?= rupiah($gadai['jumlah_pinjaman']); ?>" disabled>
                    </div>
                    <div class="form-group col-md-6" hidden>
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
                            <select class="form-control" name="jenis_barang" required>
                                <?php foreach ($barang as $row) : ?>
                                    <option value="<?= $row['id_barang']; ?>" <?= ($gadai['jenis_barang'] == $row['id_barang']) ? 'selected' : ''; ?>>
                                        <?= $row['nama_barang']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">No. IMEI/Seri</label>
                        <input type="text" class="form-control" id="inputSeri" name="seri" value="<?= $gadai['seri']; ?>" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Jumlah Barang</label>
                        <input type="text" class="form-control" id="inputZip" name="jumlah" value="<?= $gadai['jumlah']; ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kelengkapan</label>
                        <textarea class="form-control" id="" name="kelengkapan" required><?= $gadai['kelengkapan']; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kondisi</label>
                        <textarea class="form-control <?= ($validation->hasError('kondisi')) ? 'is-invalid' : ''; ?>" id="" name="kondisi" required><?= $gadai['kondisi']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kondisi'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <button class="btn btn-primary">Simpan Perubahan</button>
                    <a href="<?= site_url('datagadai') ?>" class="btn btn-danger ml-3">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>