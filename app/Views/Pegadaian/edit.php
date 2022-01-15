<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datagadai') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Pegadaian</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="/pegadaian/update/<?= $gadai['kode_pinjaman']; ?>" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kode Pinjaman</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('kode_pinjaman')) ? 'is-invalid' : ''; ?>"
                            id="inputtext4" name="kode_pinjaman" value="<?= $gadai['kode_pinjaman']; ?>" disabled>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kode_pinjaman'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tanggal Gadai</label>
                        <input type="date"
                            class="form-control <?= ($validation->hasError('tgl_gadai')) ? 'is-invalid' : ''; ?>"
                            id="inputtext4" name="tgl_gadai" value="<?= $gadai['tgl_gadai']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_gadai'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Nama Nasabah</label>
                        <div class="form-label-group">
                            <select class="form-control" name="id_nasabah">
                                <?php foreach ($nasabah as $row) : ?>
                                <option value="<?= $row['id_nasabah']; ?>"
                                    <?= ($row['id_nasabah'] == $gadai['id_nasabah']) ? 'selected' : ''; ?>>
                                    <?= $row['nama']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tgl. Jatuh Tempo</label>
                        <input type="date" class="form-control" id="inputtext4" name="tgl_jatuh_tempo"
                            value="<?= $gadai['tgl_jatuh_tempo']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">No. Telpon</label>
                        <input type="text" class="form-control" id="inputtext4" name="no_telp"
                            value="<?= $gadai['no_telp']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Tgl. Lelang</label>
                        <input type="date" class="form-control" id="inputtext4" name="tgl_lelang"
                            value="<?= $gadai['tgl_lelang']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Jumlah Pinjaman</label>
                        <input type="text" class="form-control" id="rupiah" name="jumlah_pinjaman"
                            value="<?= $gadai['jumlah_pinjaman']; ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputtext4">Bunga %</label>
                        <input type="number" class="form-control" min="1" max="100" id="myPercent" name="bungaP">
                    </div>
                    <div class="form-group col-md-4" hidden>
                        <label for="inputtext4">Bunga</label>
                        <input type="number" hidden class="form-control" id="inputtext4" name="bunga">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Jenis Barang</label>
                        <input type="text" class="form-control" id="inputCity" name="jenis_barang"
                            value="<?= $gadai['jenis_barang']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">No. IMEI/Seri</label>
                        <input type="text" class="form-control" id="inputSeri" name="seri"
                            value="<?= $gadai['seri']; ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Jumlah Barang</label>
                        <input type="text" class="form-control" id="inputZip" name="jumlah"
                            value="<?= $gadai['jumlah']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kelengkapan</label>
                        <textarea class="form-control" id="" name="kelengkapan"><?= $gadai['jumlah']; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kondisi</label>
                        <div class="form-label-group">
                            <select class="form-control" name="kondisi">
                                <option hidden selected=""><?= $gadai['kondisi']; ?></option>
                                <option value="Baru">Baru</option>
                                <option value="Bekas">Bekas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kode Cabang</label>
                        <div class="form-label-group">
                            <select class="form-control" name="kode_cabang">
                                <option hidden selected=""><?= $gadai['kode_cabang']; ?></option>
                                <?php foreach ($cabang as $row) : ?>
                                <option value="<?= $row['kode_cabang']; ?>">
                                    <?= $row['nama_cabang']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Satus Bayar</label>
                        <div class="form-label-group">
                            <select class="form-control" name="status_bayar">
                                <option hidden selected=""><?= $gadai['status_bayar']; ?></option>
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                            </select>
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