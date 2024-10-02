<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/auth.php';
require_once __DIR__ . '/service/guru.php';
require_once __DIR__ . '/service/siswa.php';

$id_pengguna = $_SESSION['id_pengguna'];

$pengguna = selectPenggunaById($id_pengguna);

// jika pengguna adalah guru
if ($_SESSION['role'] === 'guru') {
    $pengguna = selectGuruById($id_pengguna);
}

// jika pengguna adalah siswa
if ($_SESSION['role'] === 'siswa') {
    $pengguna = selectSiswaById($id_pengguna);
}

// ketika tombol simpan ditekan
if (isset($_POST['ubah_profile'])) {
    if (editProfile($id_pengguna, $_POST)) {
        echo "
        <script>
        alert('Profil kamu telah disimpan')
        document.location.href = '" . BASE_URL . "/profile.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
        alert('Profil kamu gagal disimpan')
        document.location.href = '" . BASE_URL . "/profile.php'
        </script>";
        exit;
    }
}

$title = 'Profile';
require_once __DIR__ . '/template/dashboard_navbar.php';

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>My Profile</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body pt-3">
                <form action="profile.php" class="row g-3" method="POST" enctype="multipart/form-data">
                    <?php if ($_SESSION['role'] !== 'admin'): ?>
                        <div class="col-12">
                            <label for="photo_lama" class="form-label">Photo Lama</label>
                            <img src="img/<?= ($_SESSION['role'] === 'guru') ? 'guru' : 'siswa' ?>/<?= $pengguna['photo'] ?>" alt="profile lama" class="img-thumbnail form-control" style="width: 10rem;">
                            <input type="hidden" name="photo_lama" value="<?= $pengguna['photo'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                        </div>
                    <?php endif ?>
                    <div class="col-12">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= $pengguna['nama'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $pengguna['email'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $pengguna['username'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="password_lama" class="form-label">Password Lama</label>
                        <input type="password" class="form-control" name="password_lama" id="password_lama">
                    </div>
                    <div class="col-12">
                        <label for="password_baru" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" name="password_baru" id="password_baru">
                    </div>
                    <div class="col-12">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="ubah_profile">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>