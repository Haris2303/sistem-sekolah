<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/ruang.php';
require_once __DIR__ . '/service/guru.php';
require_once __DIR__ . '/service/siswa.php';

// ketika hapus ditekan
if (isset($_POST['hapus'])) {
    if (hapusPemberitahuan($_POST['id_pemberitahuan'])) {
        echo "
        <script>
        alert('Pesan berhasil dihapus')
        document.location.href = '" . BASE_URL . "/pemberitahuan.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
        alert('Pesan gagal dihapus')
        document.location.href = '" . BASE_URL . "/pemberitahuan.php'
        </script>";
        exit;
    }
}

if ($_SESSION['role'] === 'guru') {
    $id_guru = selectGuruById($_SESSION['id_pengguna'])['id_guru'];
    $listRuang = listRuangByIdGuru($id_guru);
}

if ($_SESSION['role'] === 'siswa') {
    $id_kelas = selectSiswaById($_SESSION['id_pengguna'])['id_kelas'];
    $listRuang = listRuangByIdKelas($id_kelas);
}

$title = 'Ruang Pembelajaran';
require_once __DIR__ . '/template/dashboard_navbar.php';

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Ruang Pembelajaran</h1>
        <span>Di ruang ini, siswa dapat mengakses sumber daya pembelajaran yang tersedia untuk mendukung kegiatan belajar seperti penugasan dan memberikan materi.</span>
    </div>

    <?php if ($_SESSION['role'] === 'guru'): ?>
        <div class="row text-end">
            <div class="col">
                <a href="ruang_tambah.php" class="btn btn-primary">Buat Ruang</a>
            </div>
        </div>
    <?php endif ?>

    <div class="row mt-3">
        <?php if ($listRuang->num_rows !== 0) : ?>
            <?php foreach ($listRuang as $row): ?>
                <div class="col-lg-3">
                    <a href="detail_ruang.php?id_ruang=<?= $row['id_ruang'] ?>">
                        <div class="card">
                            <img src="img/ruang_pembelajaran/<?= $row['image'] ?>" class="card-img-top" alt="Profile ruang">
                            <div class="card-body pt-3">
                                <p class="card-text mb-0"><?= $row['nama_ruang'] ?></p>
                                <span class="text-secondary">
                                    <small><?= $row['nama_kelas'] ?></small>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <div class="text-center mt-5 fs-5 text-secondary">
                <span>Data ruang masih kosong silahkan buat ruang</span>
            </div>
        <?php endif ?>
    </div>

</main>

<script src="vendor/simple-datatables/simple-datatables.js"></script>
<script src="vendor/tinymce/tinymce.min.js"></script>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>