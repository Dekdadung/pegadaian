<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row1">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="/login/login" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" type="text" class="form-control" name="username"
                                            tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your Username
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password"
                                            tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="<?= base_url('template') ?>/assets/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/popper.js/dist/popper.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/moment/moment.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url('template') ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>