<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/pengumpulan.php';

$id_ruang = $_SESSION['id_ruang'];

// ketika tombol serahkan ditekan
if (isset($_POST['serahkan'])) {
    if (serahkanPengumpulan($_POST)) {
        echo "
        <script>
        alert('Tugas berhasil diserahkan');
        document.location.href = '" . BASE_URL . "/detail_ruang.php?id_ruang=" . $id_ruang . "';
        </script>";
    } else {
        echo "
        <script>
        alert('Tugas gagal diserahkan');
        document.location.href = '" . BASE_URL . "/detail_ruang.php?id_ruang=" . $id_ruang . "';
        </script>";
    }
}

$id_pengumpulan = $_GET['id_pengumpulan'];
$pengumpulan = selectPengumpulanById($id_pengumpulan);

$title = 'Tambah Guru';
require_once __DIR__ . '/template/dashboard_navbar.php';

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Kumpul Tugas | <?= "test" ?></h1>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body p-3">

                <div class="d-flex gap-3">
                    <p>Deadline: </p>
                    <span><?= $pengumpulan['deadline'] ?></span>
                </div>

                <div class="d-flex gap-3">
                    <p>Status: </p>
                    <span><?= $pengumpulan['status'] ?></span>
                </div>

                <div class="d-flex gap-3">
                    <p>Nilai: </p>
                    <span><?= $pengumpulan['nilai'] ?></span>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_pengumpulan" value="<?= $pengumpulan['id_pengumpulan'] ?>">
                    <div class="col-12 mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" name="file" id="file">
                        <small class="text-muted">File harus berupa pdf</small>
                    </div>
                    <button type="submit" class="btn btn-primary" name="serahkan">Serahkan</button>
                </form>

            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>