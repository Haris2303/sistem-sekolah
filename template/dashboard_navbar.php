<?php

require_once __DIR__ . '/../config/const.php';
require_once __DIR__ . '/../service/pemberitahuan.php';
require_once __DIR__ . '/../service/siswa.php';

$jumlah_pemberitahuan = 0;
if ($_SESSION['role'] === 'siswa') {
    $data_siswa = selectSiswaById($_SESSION['id_pengguna']);
    $jumlah_pemberitahuan = selectPemberitahuanByIdSiswa($data_siswa['id_siswa'], 'false')->num_rows;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - <?= $title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" />
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block"><?= APP_NAME ?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="img/profile_kosong.jpeg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['nama'] ?></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= $_SESSION['nama'] ?></h6>
                            <span><?= $_SESSION['role'] ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php?id_pengguna=<?= $_SESSION['id_pengguna'] ?>">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <!-- Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link " href="dashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php if ($_SESSION['role'] === 'admin'): ?>
                <!-- Users Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="guru.php">
                                <i class="bi bi-circle"></i><span>Guru</span>
                            </a>
                        </li>
                        <li>
                            <a href="siswa.php">
                                <i class="bi bi-circle"></i><span>Siswa</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif ?>

            <?php if ($_SESSION['role'] !== 'guru'): ?>
                <!-- Pemberitahuan Page Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="pemberitahuan.php">
                        <i class="bi bi-app-indicator"></i>
                        <div class="d-flex gap-3">
                            <span>Pemberitahuan</span>
                            <?php if ($jumlah_pemberitahuan > 0): ?>
                                <span class="badge text-bg-danger rounded-circle"><?= $jumlah_pemberitahuan ?></span>
                            <?php endif ?>
                        </div>
                    </a>
                </li>
            <?php endif ?>

            <?php if ($_SESSION['role'] !== 'admin'): ?>
                <!-- Ruang Pembelajaran Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="ruang_pembelajaran.php">
                        <i class="bi bi-door-open"></i>
                        <span>Ruang Pembelajaran</span>
                    </a>
                </li>
            <?php endif ?>

            <?php if ($_SESSION['role'] === 'admin'): ?>
                <!-- Kelas Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="kelas.php">
                        <i class="bi bi-door-open"></i>
                        <span>Kelas</span>
                    </a>
                </li>
            <?php endif ?>

            <!-- Logout Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="users-profile.html">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>

    </aside>