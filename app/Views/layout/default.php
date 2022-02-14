<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="googlebot" content="noindex">
    <meta name="robots" content="noindex, nofollow">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?></title>
    <?php
    $versions_ = '?ver=1.1.0';
    ?>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/datatables/css/datatables.min.css<?= $versions_ ?>">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css<?= $versions_ ?>">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/datatables.net-select-bs4/css/select.bootstrap4.min.css<?= $versions_ ?>">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css<?= $versions_ ?>">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/bootstrap/scss/_navbar.scss">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/bootstrap/scss/_reboot.scss">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/bootstrap/dist/css/bootstrap.min.css<?= $versions_ ?>">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/@fortawesome/fontawesome-free/css/all.min.css<?= $versions_ ?>">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/jquery/jquery.dataTables.min.css<?= $versions_ ?>">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/select2/dist/css/select2.min.css<?= $versions_ ?>" />

    <script src="<?= base_url() ?>/template/assets/jquery/dist/jquery.min.js"></script>

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css<?= $versions_ ?>">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/custom.css<?= $versions_ ?>">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css<?= $versions_ ?>">
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <?= $this->include('layout/navbar') ?>
            <!-- Main Content -->
            <div class="main-content">
                <div class="loading_screen">
                    <div class="text">Tunggu Bentar...</div>
                    <div class="lds-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->

    <!-- <script src="<?= base_url() ?>/template/assets/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
     -->
    <script src="<?= base_url() ?>/template/assets/datatables/js/datatables.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/bootstrap/dist/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>/template/assets/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>
    <script src="<?= base_url() ?>/template/assets/jquery-ui-dist/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- <script src="<?= base_url() ?>/template/assets/jquery/jquery-3.5.1.slim.min.js"></script> -->
    <!-- <script src="<?= base_url() ?>/template/assets/jquery/jquery.dataTables.min.js"></script> -->
    <script src="<?= base_url() ?>/template/assets/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/select2/dist/js/select2.min.js"></script>

    <!-- JS Libraies -->
    <script>
        function previewFile() {
            const file = document.querySelector('#file');
            const fileLabel = document.querySelector('.custom-file-label');

            fileLabel.textContent = file.files[0].name;
        }
    </script>
    <!-- Page Specific JS File -->
    <!-- <script src="<?= base_url() ?>/template/assets/js/page/modules-datatables.js"></script> -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/template/assets/js/my-datatable.js<?= $versions_ ?>"></script>
    <script src="<?= base_url() ?>/template/assets/js/scripts.js<?= $versions_ ?>"></script>
    <script src="<?= base_url() ?>/template/assets/js/custom.js<?= $versions_ ?>"></script>
</body>

</html>