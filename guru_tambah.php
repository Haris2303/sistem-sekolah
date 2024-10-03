<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/utilities.php';
require_once __DIR__ . '/service/auth.php';

// jika yang akses adalah guru tampilkan 404
if ($_SESSION['role'] === 'siswa') {
    include(__DIR__ . '/404.php');
    exit;
}

// ketika daftar guru
if (isset($_POST['tambah_guru'])) {
    if (daftar($_POST, 'guru', '/guru_tambah.php')) {
        echo "
        <script>
        alert('User berhasil registrasi')
        document.location.href = '" . BASE_URL . "/guru.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
        alert('User gagal registrasi')
        document.location.href = '" . BASE_URL . "/guru.php'
        </script>";
        exit;
    }
}

$title = 'Tambah Guru';
require_once __DIR__ . '/template/dashboard_navbar.php';

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Tambah Data Guru</h1>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Isi Form</h5>

                <form action="guru_tambah.php" class="row g-3" method="POST" enctype="multipart/form-data">
                    <div class="col-12">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo" id="photo" required>
                    </div>
                    <div class="col-12">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="col-12">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" name="nip" id="nip" required>
                    </div>
                    <div class="col-12">
                        <label for="nuptk" class="form-label">NUPTK</label>
                        <input type="text" class="form-control" name="nuptk" id="nuptk" required>
                    </div>
                    <div class="col-12">
                        <label for="nrg" class="form-label">NRG</label>
                        <input type="text" class="form-control" name="nrg" id="nrg">
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
                        <label for="bidang-studi" class="form-label">Bidang Studi</label>
                        <select name="bidang_studi" id="bidang-studi" class="form-control" required>
                            <option disabled selected>-- Pilih studi --</option>
                            <?php foreach ($bidang as $row): ?>
                                <option value="<?= $row ?>"><?= $row ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="bidang-sertifikasi" class="form-label">Bidang Sertifikasi</label>
                        <select name="bidang_sertifikasi" id="bidang-sertifikasi" class="form-control" required>
                            <option disabled selected>-- Pilih sertifikasi --</option>
                            <?php foreach ($bidang as $row): ?>
                                <option value="<?= $row ?>"><?= $row ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control" required>
                            <option disabled selected>-- Pilih jabatan --</option>
                            <?php foreach ($jabatan as $row): ?>
                                <option value="<?= $row ?>"><?= $row ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="tugas_tambahan" class="form-label">Tugas Tambahan (Optional)</label>
                        <select name="tugas_tambahan" id="tugas_tambahan" class="form-control">
                            <option disabled selected>-- Pilih tugas tambahan --</option>
                            <?php foreach ($tugas_tambahan as $row): ?>
                                <option value="<?= $row ?>"><?= $row ?></option>
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
                        <button type="submit" class="btn btn-primary" name="tambah_guru">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>