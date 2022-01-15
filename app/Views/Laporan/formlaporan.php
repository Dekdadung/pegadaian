<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datalaporan') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Laporan</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtext4">Kode Pinjaman</label>
                    <input type="text" class="form-control" id="inputtext4">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputtext4">Tanggal Gadai</label>
                    <input type="date" class="form-control" id="inputtext4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtext4">Nama Nasabah</label>
                    <input type="text" class="form-control" id="inputtext4">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputtext4">Tgl. Jatuh Tempo</label>
                    <input type="date" class="form-control" id="inputtext4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtext4">No. Telpon</label>
                    <input type="text" class="form-control" id="inputtext4">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputtext4">Tgl. Lelang</label>
                    <input type="date" class="form-control" id="inputtext4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtext4">Jumlah Pinjaman</label>
                    <input type="text" class="form-control" id="inputtext4">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputtext4">Bunga</label>
                    <input type="text" class="form-control" id="inputtext4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Jenis Barang</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">No. IMEI/Seri</label>
                    <input type="text" class="form-control" id="inputSeri">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Jumlah Barang</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtext4">Kelengkapan</label>
                    <textarea class="form-control" name="" id=""></textarea>
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
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</section>
<?= $this->endSection() ?>