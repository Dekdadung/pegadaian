<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Layout &rsaquo; Top Navigation &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="template/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="template/assets/@fortawesome/fontawesome-free/css/all.min.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="template/assets/css/style.css">
    <link rel="stylesheet" href="template/assets/css/components.css">
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
    <script src="template/assets/jquery/dist/jquery.min.js"></script>
    <script src="template/assets/popper.js/dist/popper.min.js"></script>
    <!-- <script src="template/assets/modules/tooltip.js"></script> -->
    <script src="template/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="template/assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="template/assets/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <!-- <script src="template/assets/modules/moment.min.js"></script> -->
    <script src="template/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="template/assets/js/scripts.js"></script>
    <script src="template/assets/js/custom.js"></script>
</body>

</html>