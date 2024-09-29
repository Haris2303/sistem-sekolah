<?php
$title = 'Tambah Guru';

require_once __DIR__ . '/template/dashboard_navbar.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/auth.php';
require_once __DIR__ . '/service/kelas.php';
require_once __DIR__ . '/service/guru.php';
require_once __DIR__ . '/service/ruang.php';

// ketika tombol buat ditekan
if (isset($_POST['tambah_ruang'])) {
    if (tambahRuang($_POST)) {
        echo "
        <script>
            alert('Ruang pembelajaran berhasil dibuat');
            document.location.href = '" . BASE_URL . "/ruang_pembelajaran.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal menambahkan ruang pembelajaran');
            document.location.href = '" . BASE_URL . "/ruang_tambah.php';
        </script>";
    }
}

$guru = selectGuruById($_SESSION['id_pengguna']);

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Buat Ruang Pembelajaran</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Isi Form</h5>

                <form action="ruang_tambah.php" class="row g-3" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_guru" value="<?= $guru['id_guru'] ?>">
                    <!-- Pilihan gambar menggunakan radio button -->
                    <div class="col-12">
                        <label for="pilih_gambar" class="form-label">Pilih Gambar</label><br>

                        <!-- Opsi 1 -->
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pilih_gambar" id="gambar1" value="image1.jpg" checked>
                            <label for="gambar1" class="form-check-label">
                                <img src="img/slides/slide1.jpg" alt="Image 1" style="max-width:100px;">
                            </label>
                        </div>
                        <!-- Opsi 1 -->
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pilih_gambar" id="gambar1" value="image1.jpg">
                            <label for="gambar1" class="form-check-label">
                                <img src="img/slides/slide1.jpg" alt="Image 1" style="max-width:100px;">
                            </label>
                        </div>
                        <!-- Opsi 1 -->
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="pilih_gambar" id="gambar1" value="image1.jpg">
                            <label for="gambar1" class="form-check-label">
                                <img src="img/slides/slide1.jpg" alt="Image 1" style="max-width:100px;">
                            </label>
                        </div>

                    </div>

                    <!-- Input untuk upload gambar baru -->
                    <div class="col-12">
                        <label for="gambar" class="form-label">Atau Upload Gambar Baru</label>
                        <input type="file" class="form-control" name="photo" id="gambar">
                        <small class="text-muted">Opsional, jika tidak memilih gambar di atas</small>
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label">Nama Ruang</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="col-12">
                        <label for="id_kelas" class="form-label">Kelas</label>
                        <select name="id_kelas" id="id_kelas" class="form-control" required>
                            <option disabled selected>-- Pilih Kelas --</option>
                            <!-- Loop kelas dari database -->
                            <?php foreach (listKelas() as $k): ?>
                                <option value="<?= $k['id_kelas'] ?>"><?= $k['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="tambah_ruang">Buat</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>