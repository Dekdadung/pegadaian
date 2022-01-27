<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('datalaporan') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Form Upload</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="section-title">Upload File</div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file" onchange="previewFile()">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</section>
<?= $this->endSection() ?>