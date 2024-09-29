<?php
$title = 'Edit Data Guru';

require_once 'template/dashboard_navbar.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/guru.php';
require_once __DIR__ . '/config/utilities.php';

// ambil id get method
$id_pengguna = $_GET['id_pengguna'];

$data = selectGuruById($id_pengguna);

if (isset($_POST['edit_guru'])) {
    if (editGuruById($id_pengguna, $_POST)) {
        echo "
        <script>
            alert('User berhasil diubah')
            document.location.href = '" . BASE_URL . "/guru_edit.php?id_pengguna=" . $id_pengguna . "'
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('User gagal diubah')
            document.location.href = '" . BASE_URL . "/guru_edit.php?id_pengguna=" . $id_pengguna . "'
        </script>";
        exit;
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Edit Data Guru</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Isi Form</h5>

                <form action="" class="row g-3" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_pengguna" value="<?= $id_pengguna ?>">
                    <div class="col-12">
                        <label for="photo_lama" class="form-label">Photo Lama</label>
                        <img src="img/guru/<?= $data['photo'] ?>" alt="profile lama" class="img-thumbnail form-control" style="width: 10rem;">
                        <input type="hidden" name="photo_lama" value="<?= $data['photo'] ?>">
                    </div>
                    <div class="col-12">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                    </div>
                    <div class="col-12">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= $data['nama'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" name="nip" id="nip" value="<?= $data['nip'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="nuptk" class="form-label">NUPTK</label>
                        <input type="text" class="form-control" name="nuptk" id="nuptk" value="<?= $data['nuptk'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="nrg" class="form-label">NRG</label>
                        <input type="text" class="form-control" name="nrg" value="<?= $data['nrg'] ?>" id="nrg">
                    </div>
                    <div class="col-12">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label><br>
                        <div class="form-check">
                            <label for="laki-laki" class="form-check-label">Laki-laki</label>
                            <input type="radio" class="form-check-input" name="jenis_kelamin" id="laki-laki" value="L" <?= ($data['jenis_kelamin'] == 'L') ? 'checked' : '' ?> required>
                        </div>
                        <div class="form-check">
                            <label for="perempuan" class="form-check-label">Perempuan</label>
                            <input type="radio" class="form-check-input" name="jenis_kelamin" id="perempuan" value="P" <?= ($data['jenis_kelamin'] == 'P') ? 'checked' : '' ?> required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="bidang-studi" class="form-label">Bidang Studi</label>
                        <select name="bidang_studi" id="bidang-studi" class="form-control" required>
                            <option disabled>-- Pilih studi --</option>
                            <?php foreach ($bidang as $row): ?>
                                <option value="<?= $row ?>" <?= ($data['bidang_studi'] == $row) ? 'selected' : '' ?>><?= $row ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="bidang-sertifikasi" class="form-label">Bidang Sertifikasi</label>
                        <select name="bidang_sertifikasi" id="bidang-sertifikasi" class="form-control" required>
                            <option disabled>-- Pilih sertifikasi --</option>
                            <?php foreach ($bidang as $row): ?>
                                <option value="<?= $row ?>" <?= ($data['bidang_sertifikasi'] == $row) ? 'selected' : '' ?>><?= $row ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control" required>
                            <option disabled selected>-- Pilih jabatan --</option>
                            <?php foreach ($jabatan as $row): ?>
                                <option value="<?= $row ?>" <?= ($data['jabatan'] == $row) ? 'selected' : '' ?>><?= $row ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="tugas_tambahan" class="form-label">Tugas Tambahan (Optional)</label>
                        <select name="tugas_tambahan" id="tugas_tambahan" class="form-control">
                            <option disabled selected>-- Pilih tugas tambahan --</option>
                            <?php foreach ($tugas_tambahan as $row): ?>
                                <option value="<?= $row ?>" <?= ($data['tugas_tambahan'] == $row) ? 'selected' : '' ?>><?= $row ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $data['email'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $data['username'] ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="col-12">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="edit_guru">Ubah</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<?php require_once 'template/dashboard_footer.php' ?>