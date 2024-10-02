<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/auth.php';
require_once __DIR__ . '/service/kelas.php';

// jika yang akses adalah guru tampilkan 404
if ($_SESSION['role'] === 'siswa') {
    include(__DIR__ . '/404.php');
    exit;
}

// ketika tombol tambah ditekan
if (isset($_POST['tambah'])) {
    if (daftar($_POST, 'siswa', '/siswa_tambah.php')) {
        echo "
        <script>
        alert('User berhasil ditambahkan')
        document.location.href = '" . BASE_URL . "/siswa.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
        alert('User gagal ditambahkan')
        document.location.href = '" . BASE_URL . "/siswa.php'
        </script>";
        exit;
    }
}

$title = 'Tambah Siswa';
require_once __DIR__ . '/template/dashboard_navbar.php';

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Tambah Data Siswa</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Isi Form</h5>

                <form action="siswa_tambah.php" class="row g-3" method="POST" enctype="multipart/form-data">
                    <div class="col-12">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo" id="photo" required>
                    </div>
                    <div class="col-12">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="col-12">
                        <label for="nipd" class="form-label">NIPD</label>
                        <input type="text" class="form-control" name="nipd" id="nipd" required>
                    </div>
                    <div class="col-12">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label><br>
                        <div class="form-check">
                            <label for="laki-laki" class="form-check-label">Laki-laki</label>
                            <input type="radio" class="form-check-input" name="jenis_kelamin" id="laki-laki" value="L" required>
                        </div>
                        <div class="form-check">
                            <label for="perempuan" class="form-check-label">Perempuan</label>
                            <input type="radio" class="form-check-input" name="jenis_kelamin" id="perempuan" value="P" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="id_kelas" id="kelas" class="form-control" required>
                            <option disabled selected>-- Pilih Kelas --</option>
                            <?php foreach (listKelas() as $row): ?>
                                <option value="<?= $row['id_kelas'] ?>"><?= $row['nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="col-12">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>