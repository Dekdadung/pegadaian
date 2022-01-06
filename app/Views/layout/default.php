<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Layout &rsaquo; Top Navigation &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/@fortawesome/fontawesome-free/css/all.min.css">

    <!-- CSS Libraries -->

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
    <script src="<?= base_url() ?>/template/assets/jquery/dist/jquery.min.js"></script>
    <!-- <script src="<?= base_url() ?>/template/assets/jquery/dist/jquery.slim.js"></script>
    <script src="<?= base_url() ?>/template/assets/jquery/dist/jquery.js"></script>
    <script src="<?= base_url() ?>/template/assets/jquery/dist/core.js"></script> -->
    <script src="<?= base_url() ?>/template/assets/popper.js/dist/popper.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/bootstrap/dist/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>/template/assets/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>
</body>

</html>