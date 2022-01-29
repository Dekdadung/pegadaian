<?php
$session = session();
?>
<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Akan Di Lelang</h1>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-md" id="tabelLelang">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Nama Nasabah</th>
                    <th>Tgl. Lelang</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Kode Cabang</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <div>
                    <?php
                    $no = 1;
                    foreach ($gadai as $row) :
                    ?>
                    <tr class="text-center">
                        <td><?= $no++; ?></td>
                        <td><?= $row->kode_pinjaman; ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= $row->tgl_lelang ?></td>
                        <td><?= rupiah($row->jumlah_pinjaman); ?></td>
                        <td><?= $row->kode_cabang ?></td>
                        <td>
                            <textarea name="" class="datarow-<?= $row->kode_pinjaman ?>" id=""
                                hidden><?= json_encode($row); ?></textarea>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">Kirim Notifikasi</a>
                                    <a class="dropdown-item btn-detail" href=""
                                        data-kdpinjaman="<?= $row->kode_pinjaman ?>">Detail</a>
                                    <a class="dropdown-item"
                                        href="/pegadaian/createDenda/<?= $row->kode_pinjaman ?>">Denda</a>
                                    <a class="dropdown-item"
                                        href="/pegadaian/createLelang/<?= $row->kode_pinjaman ?>">Lelang</a>
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
<script>
$(document).ready(function() {
    $('#tabelLelang').DataTable();
});
</script>

<?= $this->endSection(); ?>