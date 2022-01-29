<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Lelang</h1>
    </div>

    <div class="card-body table-responsive">
        <?php if (session()->getFlashdata('Pesan')) : ?>
        <script type="text/javascript">
        $(document).ready(function() {
            swal({
                title: "Berhasil !",
                text: "<?= session()->getFlashdata('Pesan'); ?>",
                timer: 1500,
                icon: "success"
            });
        });
        </script>
        <?php endif; ?>
        <table class="table table-striped table-md">
            <tbody>
                <tr>
                    <th>No</th>
                    <th>Kode Pinjaman</th>
                    <th>Hasil Lelang</th>
                    <th>Tanggal Lelang</th>
                    <th>Kode Cabang</th>
                </tr>
                <div class="text-center">
                    <?php
                    $no = 1;
                    foreach ($lelang as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->kode_pinjaman; ?></td>
                        <td><?= rupiah($row->hasil_lelang); ?></td>
                        <td><?= $row->tgl_lelang; ?></td>
                        <td><?= $row->kodeCabang; ?></td>
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