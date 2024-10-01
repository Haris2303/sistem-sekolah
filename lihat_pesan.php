<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/pemberitahuan.php';

if ($_SESSION['role'] === 'guru') {
    http_response_code(404);
    include(__DIR__ . '/404.php');
    exit;
}

$id_pemberitahuan = 0;
if (isset($_GET['id_pemberitahuan'])) {
    $id_pemberitahuan = $_GET['id_pemberitahuan'];
}

if (cekAksesPemberitahuanByIdPengguna($_SESSION['id_pengguna'], $id_pemberitahuan)) {
    http_response_code(404);
    include(__DIR__ . '/404.php');
    exit;
}

$pemberitahuan = selectPemberitahuanById($id_pemberitahuan);

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

$title = 'Pemberitahuan';
require_once __DIR__ . '/template/dashboard_navbar.php';

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Detail Pesan</h1>
    </div>

    <div class="card p-4">
        <div class="mb-3">
            <span>Kepada : <?= $pemberitahuan['nama'] ?></span>
        </div>
        <div class="mb-3">
            <h5>Subjek : <?= $pemberitahuan['subjek'] ?></h5>
        </div>
        <div class="mb-3">
            <p>Status : <?= ($pemberitahuan['dibaca']) ? 'Telah dibaca' : 'Belum dibaca' ?></p>
        </div>
        <div class="mb-3">
            <span>Pesan:</span>
            <p><?= $pemberitahuan['pesan'] ?></p>
        </div>
        <div class="my-3">
            <span><?= $pemberitahuan['waktu'] ?></span>
        </div>
        <form action="" method="post">
            <input type="hidden" name="id_pemberitahuan" value="<?= $pemberitahuan['id_pemberitahuan'] ?>">
            <button type="submit" name="hapus" class="btn btn-danger">Hapus Pesan</button>
        </form>
    </div>

</main>

<script src="vendor/simple-datatables/simple-datatables.js"></script>
<script src="vendor/tinymce/tinymce.min.js"></script>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>