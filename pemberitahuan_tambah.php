<?php
$title = 'Tambah Guru';

require_once __DIR__ . '/template/dashboard_navbar.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/auth.php';
require_once __DIR__ . '/service/siswa.php';
require_once __DIR__ . '/service/pemberitahuan.php';

// ketika tombol kirim ditekan
if (isset($_POST['kirim'])) {
    if (tambahPemberitahuan($_POST)) {
        echo "
        <script>
            alert('Pemberitahuan berhasil dikirim')
            document.location.href = '" . BASE_URL . "/pemberitahuan.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('Pemberitahuan gagal dikirim')
            document.location.href = '" . BASE_URL . "/pemberitahuan.php'
        </script>";
        exit;
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Buat Pemberitahuan</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Isi Form</h5>

                <form action="pemberitahuan_tambah.php" class="row g-3" method="POST" enctype="multipart/form-data">
                    <div class="col-12">
                        <label for="kepada" class="form-label">Kepada</label>
                        <input list="siswa" class="form-control" name="id_siswa" id="kepada" required>
                        <datalist id="siswa">
                            <?php foreach (listSiswa() as $row): ?>
                                <option value="<?= $row['id_siswa'] ?>"><?= $row['nama'] ?></option>
                            <?php endforeach ?>
                        </datalist>
                    </div>
                    <div class="col-12">
                        <label for="subjek" class="form-label">Subjek</label>
                        <input type="text" class="form-control" name="subjek" id="subjek" required>
                    </div>
                    <div class="col-12">
                        <label for="pesan">Pesan</label>
                        <textarea name="pesan" id="pesan" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="kirim">Kirim</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>