<?php
$title = 'Tambah Guru';

require_once __DIR__ . '/template/dashboard_navbar.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/materi.php';

// jika ada id ruang dari method get
if (isset($_GET['id_ruang'])) {
    $_SESSION['id_ruang'] = $_GET['id_ruang'];
}
// set id ruang pada session
$id_ruang = $_SESSION['id_ruang'];

// ketika tombol buat ditekan
if (isset($_POST['tambah_materi'])) {
    if (tambahMateri($_POST)) {
        echo "
        <script>
            alert('Materi berhasil dishare');
            document.location.href = '" . BASE_URL . "/detail_ruang.php?id_ruang=" . $id_ruang . "';
        </script>";
    } else {
        echo "
        <script>
            alert('Materi gagal dishare');
            document.location.href = '" . BASE_URL . "/share_materi.php?id_ruang=" . $id_ruang . "';
        </script>";
    }
}

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Share Materi</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Materi</h5>

                <form action="share_materi.php" class="row g-3" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_ruang" value="<?= $id_ruang ?>">
                    <div class="col-12">
                        <label for="judul" class="form-label">Judul Materi</label>
                        <input type="text" class="form-control" name="judul" id="judul" required>
                    </div>
                    <div class="col-12">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" name="file" id="file">
                        <small class="text-muted">File harus berupa pdf</small>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="tambah_materi">Buat</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>