<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/tugas.php';
require_once __DIR__ . '/service/pengumpulan.php';

// jika yang akses adalah guru tampilkan 404
if ($_SESSION['role'] === 'siswa') {
    include(__DIR__ . '/404.php');
    exit;
}

$id_tugas = 0;
if (isset($_GET['id_tugas'])) {
    $id_tugas = $_GET['id_tugas'];
}

if (cekAksesTugasByIdPengguna($_SESSION['id_pengguna'], $id_tugas)) {
    http_response_code(404);
    include(__DIR__ . '/404.php');
    exit;
}

$tugas = selectTugasById($id_tugas);

// ketika kirim ditekan
if (isset($_POST['kirim_nilai'])) {
    if (menilaiPengumpulanById($_POST)) {
        echo "
        <script>
        alert('Nilai telah diberikan')
        document.location.href = '" . BASE_URL . "/penilaian_test.php?id_tugas=" . $id_tugas . "'
        </script>";
        exit;
    } else {
        echo "
        <script>
        alert('Nilai gagal diberikan')
        document.location.href = '" . BASE_URL . "/penilaian_test.php?id_tugas=" . $id_tugas . "'
        </script>";
        exit;
    }
}

$title = 'Penilaian';
require_once __DIR__ . '/template/dashboard_navbar.php';

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Penilaian | <?= $tugas['judul'] ?></h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="row text-end">
        <div class="col">
            <a href="detail_ruang.php?id_ruang=<?= $tugas['id_ruang'] ?>" class="btn btn-secondary">Kembali</a>
            <a href="lihat_file.php?file=<?= $tugas['file'] ?>&folder=tugas" class="btn btn-primary">Lihat File</a>
        </div>
    </div>

    <div class="row mt-3">
        <?php foreach (selectPengumpulanByIdTugas($id_tugas) as $row): ?>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="d-flex gap-3">
                                <img src="img/guru/66f92d827da2b.jpg" class="rounded-circle" alt="" width="50" height="50">
                                <div>
                                    <span class="card-title"><?= $row['nama'] ?></span>
                                    <?php if ($row['status'] === 'diserahkan'): ?>
                                        <a href="lihat_file.php?file=<?= $row['file'] ?>&folder=pengumpulan" class="btn btn-secondary badge mb-3">Lihat Hasil</a>
                                    <?php else: ?>
                                        <button class="btn badge mb-3" disabled>Belum Diserahkan</butt>
                                        <?php endif ?>
                                </div>
                            </div>
                            <div class="w-100">

                                <?php if ($row['status'] === 'diserahkan' && $row['nilai'] == 0): ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_pengumpulan" value="<?= $row['id_pengumpulan'] ?>">
                                        <label for="nilai" class="form-label">Beri Nilai</label>
                                        <div class="input-group">
                                            <div class="d-flex gap-3 align-items-center">
                                                <input type="range" class="form-range" name="nilai" id="nilai" min="0" max="100" step="1" oninput="document.getElementById('rangeValue').innerText = this.value;">
                                                <span id="rangeValue" class="input-group-text">50</span>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <button type="submit" name="kirim_nilai" class="btn btn-success btn-sm w-100">Kirim</button>
                                            </div>
                                        </div>
                                    </form>
                                <?php elseif ($row['nilai'] > 0): ?>
                                    <strong>Nilai</strong> : <span class="badge text-bg-success"><?= $row['nilai'] ?></span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

</main>

<script src="vendor/simple-datatables/simple-datatables.js"></script>
<script src="vendor/tinymce/tinymce.min.js"></script>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>