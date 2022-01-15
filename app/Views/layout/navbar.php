<?php
$session = session();
?>

<nav class="navbar navbar-reverse navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand smooth" href="<?= site_url('homepage') ?>">FLOBAMORA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <?php if ($session->get('level') == 'superadmin') :  ?>
            <ul class="navbar-nav mr-auto ml-lg-3 align-items-lg-center">
                <li class="nav-item"><a href="<?= site_url('dashboard') ?>" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item"><a href="<?= site_url('datagadai') ?>" class="nav-link">Pegadaian</a>
                <li class="nav-item"><a href="<?= site_url('saldo') ?>" class="nav-link">Saldo</a></li>
                <li class="nav-item"><a href="<?= site_url('datacabang') ?>" class="nav-link">Cabang</a>
                <li class="nav-item dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle"
                        aria-expanded="false">Pengaturan</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url('datanasabah') ?>" class="dropdown-item">Data
                                Nasabah</a></li>
                        <li><a href="<?= site_url('datauser') ?>" class="dropdown-item">Data
                                User</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="<?= site_url('laporan') ?>" class="nav-link">Laporan</a>
                </li>
            </ul>
            <?php else : ?>
            <ul class="navbar-nav mr-auto ml-lg-3 align-items-lg-center">
                <li class="nav-item"><a href="<?= site_url('dashboard') ?>" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item"><a href="<?= site_url('datagadai') ?>" class="nav-link">Pegadaian</a>
                <li class="nav-item"><a href="<?= site_url('datacabang') ?>" class="nav-link">Cabang</a>
                <li class="nav-item dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle"
                        aria-expanded="false">Pengaturan</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url('datanasabah') ?>" class="dropdown-item">Data
                                Nasabah</a></li>
                        <li><a href="<?= site_url('datauser') ?>" class="dropdown-item">Data
                                User</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="<?= site_url('laporan') ?>" class="nav-link">Laporan</a>
                </li>
            </ul>
            <?php endif ?>

            <ul class="navbar-nav ml-auto align-items-lg-center d-none d-lg-block">
                <li class="ml-lg-3 nav-item">
                    <a href="<?= site_url('login/logout') ?>" class="btn btn-round smooth btn-icon icon-left">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>