<?php
$session = session();
?>
<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="card-body table-responsive">
        <table class="table table-striped table-md" id="tabelLaporan">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Nama Nasabah</th>
                    <th>Tgl. Gadai</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl. Lelang</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Bunga</th>
                    <th>Denda</th>
                    <th>Lelang</th>
                    <th>Total Pendapatan</th>
                    <th>Kode Cabang</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <div>
                    <?php
                    $no = 1;
                    foreach ($gadai as $row) :
                    ?>
                        <tr class="text-center <?= 'bg-' . $row->jatuh_tempo_now; ?>">
                            <td><?= $no++; ?></td>
                            <td><?= $row->kode_pinjaman; ?></td>
                            <td class="white_space"><?= $row->nama ?></td>
                            <td><?= $row->tgl_gadai ?></td>
                            <td><?= $row->tgl_jatuh_tempo ?></td>
                            <td><?= $row->tgl_lelang ?></td>
                            <td><?= $row->jumlah_pinjaman; ?></td>
                            <td><?= $row->bunga ?></td>
                            <td><?= (!empty($row->pendapatan_denda)) ? $row->pendapatan_denda : '-';  ?> </td>
                            <td><?= (!empty($row->pendapatan_lelang)) ? $row->pendapatan_lelang : '-'; ?></td>
                            <td><?= $row->total_pendapatan_bersih ?> </td>
                            <td><?= $row->kode_cabang ?></td>
                            <td><?= $row->status_bayar ?></td>
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