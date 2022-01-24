<?= $this->extend('layout/default'); ?>
<title>Dashboard</title>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Data Cabang</h1>
        <div class="section-header-button">
            <a href="<?= site_url('formcabang') ?>" class="btn btn-primary">Tambah</a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <?php if (session()->getFlashdata('Pesan')) : ?>
        <div class="alert alert-success alert-has-icon">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Sukses !</div>
                <?= session()->getFlashdata('Pesan'); ?>
            </div>
        </div>
        <?php endif; ?>
        <table class="table table-striped table-md" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Cabang</th>
                    <th>Nama Cabang</th>
                    <th>Alamat</th>
                    <th>Kode Toko</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                <div class="text-center">

                </div>
            </tbody>
        </table>
    </div>
</section>
<script>
function myTable() {
    var table = $('#myTable').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= site_url('cabang/myTable') ?>",
            "type": "POST",
            "dataSrc": "errorLogList"
        },
        "columns": [{
                data: "errorCode"
            },
            {
                data: "rowNumber"
            },
            {
                data: "columnNumber"
            },
            {
                data: "description"
            },
            {
                data: "errorType"
            },
        ]

    })
}

$(document).ready(function() {
    myTable();
});
</script>
<?= $this->endSection(); ?>