<?php

$title = 'Tambah Guru';

require_once __DIR__ . '/template/dashboard_navbar.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/tugas.php';

// // jika ada id ruang dari method get
if (isset($_GET['id_ruang'])) {
    $_SESSION['id_ruang'] = $_GET['id_ruang'];
}
// set id ruang pada session
$id_ruang = $_SESSION['id_ruang'];

// ketika tombol buat ditekan
if (isset($_POST['buat_test'])) {
    if (tambahTugas($_POST)) {
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
        <h1>Buat Tugas Test</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Isi Form</h5>

                <form action="" class="row g-3" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_ruang" value="<?= $id_ruang ?>">
                    <div class="col-12">
                        <label for="judul" class="form-label">Judul Tugas</label>
                        <input type="text" class="form-control" name="judul" id="judul" required>
                    </div>
                    <div class="col-12">
                        <label for="date" class="form-label">Deadline</label>

                        <input type="date" class="form-control" name="date" id="date" required>
                        <input type="time" name="time" class="form-control" id="time" required>
                    </div>
                    <div class="col-12">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" name="file" id="file">
                        <small class="text-muted">File harus berupa pdf</small>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="buat_test">Buat</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>