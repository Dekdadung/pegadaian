<?php
$session = session();
?>

<nav class="navbar navbar-reverse navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand smooth" href="https://getstisla.com">Pegadaian</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ml-lg-3 align-items-lg-center">
                <li class="nav-item"><a href="<?= site_url('homepage') ?>" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item"><a href="<?= site_url('datagadai') ?>" class="nav-link">Pegadaian</a>
                <li class="nav-item"><a href="<?= site_url('saldo') ?>" class="nav-link">Saldo</a></li>
                <li class="nav-item"><a href="<?= site_url('cabang') ?>" class="nav-link">Cabang</a>
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

            <div class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="<?= site_url('login/logout') ?>" class="nav-link">Logout</a></li>
                </ul>
            </div>
            <!-- <ul class="navbar-nav ml-auto align-items-lg-center d-none d-lg-block">
                            <li class="ml-lg-3 nav-item">
                                <a href="https://getstisla.com/download" class="btn btn-round smooth btn-icon icon-left"
                                    target="_blank">
                                    <i class="fas fa-shopping-cart"></i> Download
                                </a>
                            </li>
                        </ul> -->
        </div>
    </div>
</nav>