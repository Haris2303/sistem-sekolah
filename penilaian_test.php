<?php
$title = 'Pemberitahuan';

require_once __DIR__ . '/template/dashboard_navbar.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/tugas.php';
require_once __DIR__ . '/service/pengumpulan.php';

$id_tugas = $_GET['id_tugas'];
$tugas = selectTugasById($id_tugas);

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
                                <?php if ($row['status'] === 'diserahkan'): ?>
                                    <label for="nilai3" class="form-label">Beri Nilai</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nilai3">
                                        <button class="btn btn-success btn-sm">Kirim</button>
                                    </div>
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