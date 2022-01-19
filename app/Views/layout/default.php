<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Layout &rsaquo; Top Navigation &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/datatables/css/datatables.min.css">
    <link rel="stylesheet"
        href="<?= base_url() ?>/template/assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/datatables.net-select-bs4/css/select.bootstrap4.min.css
">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/bootstrap/scss/_navbar.scss">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/bootstrap/scss/_reboot.scss">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/@fortawesome/fontawesome-free/css/all.min.css">

    <script src="<?= base_url() ?>/template/assets/jquery/dist/jquery.min.js"></script>
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <?= $this->include('layout/navbar') ?>
            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->

    <script src="<?= base_url() ?>/template/assets/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/datatables/js/datatables.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/popper.js/dist/popper.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/bootstrap/dist/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>/template/assets/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>
    <script src="<?= base_url() ?>/template/assets/jquery-ui-dist/jquery-ui.min.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
    <script src="<?= base_url() ?>/template/assets/js/page/modules-datatables.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>
</body>

</html>