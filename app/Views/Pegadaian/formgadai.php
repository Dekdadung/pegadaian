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
                                <option value="<?= $row['kode_cabang']; ?>" <?= ($row['kode_cabang'] == $kode_cabang) ? 'selected' : ''; ?>>
                                    <?= $row['nama_cabang']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="section-header-breadcrumb mt-3">
                <h6>Tanggal Hari Ini : <?= date('Y-m-d') ?></h6>
            </div>
        <?php else : ?>
            <div class="section-header-breadcrumb mt-3">
                <h6>Saldo Sekarang : <?= rupiah($saldo_akhir) ?></h6>
            </div>
        <?php endif ?>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('/pegadaian/save') ?>" method="post" id="formgadai">
                <div class="fokus_layer"></div>
                <input hidden type="text" name="kode_cabang" value="<?= $kode_cabang ?>">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputtext4">Kode Pinjaman</label>
                        <input type="hidden" name="kode_pinjaman" value="<?= $kode_pinjaman ?>">
                        <input type="text" class="form-control" id="inputtext4" name="kode_pinjaman" disabled value="<?= $kode_pinjaman ?>">
                    </div>
                    <div class="form-group col-md-6 pilih_nasabah">
                        <label for="inputtext4">Nama Nasabah</label>
                        <!-- <div class="input-group">
                            <input type="text" class="form-control" name="guest_nama" value="Guest">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kt_modal_search_pelanggan">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div> -->
                        <div class="form-label-group">
                            <select class="form-control mr-1 select2_" name="id_nasabah" required>
                                <option value="">Pilih Nasabah</option>
                                <?php foreach ($nasabah as $row) : ?>
                                    <option value="<?= $row->id_nasabah; ?>" title="<?= $row->nik; ?>"><?= $row->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-2" style="margin-top:30px">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" style="height:100%" data-target="#exampleModal">Tambah
                            Nasabah</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputtext4">Tanggal Gadai</label>
                        <input type="date" class="form-control" id="inputtext4" name="tgl_gadai" value="<?= date('Y-m-d') ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputtext4">Tgl. Jatuh Tempo</label>
                        <input type="date" class="form-control" id="inputtext4" name="tgl_jatuh_tempo" value="<?= date('Y-m-d') ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputtext4">Tgl. Lelang</label>
                        <input type="date" class="form-control" id="inputtext4" name="tgl_lelang" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input hidden class="sisa_saldo_akhir" value="<?= $saldo_akhir ?>">
                        <label for="inputtext4">Jumlah Pinjaman</label>
                        <input type="text" class="jumlah_pinjaman_input form-control <?= ($validation->hasError('jumlah_pinjaman')) ? 'is-invalid' : ''; ?>" id="rupiah" name="jumlah_pinjaman" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah_pinjaman'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Bunga</label>
                        <div class="form-label-group">
                            <select class="form-control" name="bungaP" required>
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
                                    <option value="<?= $row['id_barang']; ?>">
                                        <?= $row['nama_barang']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">No. IMEI/Seri</label>
                        <input type="text" class="form-control <?= ($validation->hasError('seri')) ? 'is-invalid' : ''; ?>" id="inputSeri" name="seri" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('seri'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Jumlah Barang</label>
                        <input type="text" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="inputZip" name="jumlah" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtext4">Kelengkapan</label>
                        <textarea class="form-control <?= ($validation->hasError('kelengkapan')) ? 'is-invalid' : ''; ?>" id="" name="kelengkapan" required></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kelengkapan'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputtext4">kondisi</label>
                        <textarea class="form-control <?= ($validation->hasError('kondisi')) ? 'is-invalid' : ''; ?>" id="" name="kondisi" required></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kondisi'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <button class="btn btn-primary" type="submit" id="button_submit">Buat Pinjaman</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/nasabah/save2" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Nama Nasabah</label>
                            <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="
                            inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Alamat</label>
                            <textarea type="text" name="alamat_nasabah" class="form-control <?= ($validation->hasError('alamat_nasabah')) ? 'is-invalid' : ''; ?>" id="inputtext4"></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat_nasabah'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Telpon</label>
                            <input type="text" name="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" id="inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_telp'); ?>
                            </div>
                        </div>
                        <!-- <div class="form-group col-md-6">
                            <label for="inputtext4">Kode Cabang</label>
                            <input type="text" name="kode_cabang" disabled class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>" id="inputtext4" value="<?= $kode_cabang ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('kode_cabang'); ?>
                            </div>
                        </div> -->
                        <div class="form-group col-md-6">
                            <input type="text" name="kode_cabang" hidden class="form-control <?= ($validation->hasError('kode_cabang')) ? 'is-invalid' : ''; ?>" id="inputtext4" value="<?= $kode_cabang ?>">
                            <input type="hidden" name="status" value="aktif">
                            <label for="inputtext4">NIK Nasabah</label>
                            <input type="text" name="nik" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="
                            inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nik'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputtext4">NIK Nasabah</label>
                            <input type="text" name="nik" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="
                            inputtext4">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nik'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtext4">Status</label>
                            <div class="form-label-group">
                                <select class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>" name="status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('status'); ?>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>