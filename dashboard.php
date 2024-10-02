<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/guru.php';
require_once __DIR__ . '/service/ruang.php';

$role = $_SESSION['role'];
$id_pengguna = $_SESSION['id_pengguna'];

if ($role === 'admin') {
    $jumlahGuru = listGuru()->num_rows;
    $jumlahSiswa = listSiswa()->num_rows;
}

if ($role === 'guru') {
    $id_guru = selectGuruById($id_pengguna)['id_guru'];
    $jumlahRuang = listRuangByIdGuru($id_guru)->num_rows;
}

if ($role === 'siswa') {
    $id_kelas = selectSiswaById($id_pengguna)['id_kelas'];
    $jumlahRuang = listRuangByIdKelas($id_kelas)->num_rows;
}

$title = 'Home';
require_once __DIR__ . '/template/dashboard_navbar.php';
?>

<main id="main" class="main">

    <div class="pagetitle mb-3">
        <h1>Dashboard</h1>
    </div>

    <section class="section dashboard">
        <div class="row">

            <?php if ($role === 'admin'): ?>
                <!-- Guru Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card blue-card">

                        <div class="card-body">
                            <h5 class="card-title">Guru</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $jumlahGuru ?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Siswa Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card green-card">

                        <div class="card-body">
                            <h5 class="card-title">Siswa</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $jumlahSiswa ?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif ?>

            <?php if ($role !== 'admin'): ?>
                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card orange-card">
                        <div class="card-body">
                            <h5 class="card-title">Ruang Pembelajaran</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $jumlahRuang ?></h6>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            <?php endif ?>

        </div>
    </section>

</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>