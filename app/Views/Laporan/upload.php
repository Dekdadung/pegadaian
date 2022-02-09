<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datalaporan') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Upload</h1>
    </div>
    <?php
    $nmonth = '02-Jan-2022';
    echo tanggalbaru($nmonth);
    ?>
    <div class="card">
        <form action="<?= site_url('importdata'); ?>" enctype="multipart/form-data" method="post">
            <div class="card-body">
                <div class="section-title">Upload File</div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file" name="file_import" onchange="previewFile()">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>