<?php
$title = 'Guru';

require_once __DIR__ . '/template/dashboard_navbar.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/siswa.php';
require_once __DIR__ . '/service/ruang.php';
require_once __DIR__ . '/service/materi.php';

$id_ruang = $_GET['id_ruang'];
$ruang = selectRuangById($id_ruang);
$siswa = selectSiswaByKelas($ruang['id_kelas']);

// ketika hapus ditekan
if (isset($_POST['hapus_ruang'])) {
    if (hapusRuangById($_POST['id_ruang'])) {
        echo "
        <script>
            alert('Ruang berhasil dihapus')
            document.location.href = '" . BASE_URL . "/ruang_pembelajaran.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('Ruang gagal dihapus')
            document.location.href = '" . BASE_URL . "/ruang_pembelajaran.php'
        </script>";
        exit;
    }
}

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Ruang Pembelajaran | <?= $ruang['nama'] ?></h1>
            <form action="" method="POST">
                <input type="hidden" name="id_ruang" value="<?= $id_ruang ?>">
                <button type="submit" name="hapus_ruang" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus ruang ini?')">Hapus Ruang</button>
            </form>
        </div>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Test Siswa</h5>
                    <div class="text-end">
                        <a href="ruang_tambah.php" class="btn btn-primary">Buat Test</a>
                    </div>
                </div>

                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deadline</th>
                            <th>Siswa Kerjakan</th>
                            <th>Aksi</th>
                            <th class="d-none">Column Tambahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (listGuru() as $row): ?>
                            <tr class="align-middle">
                                <td>test</td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['jenis_kelamin'] ?></td>
                                <td>
                                    <a href="guru_edit.php?id_pengguna=<?= $row['id_pengguna'] ?>" class="btn btn-success badge">Edit</a>
                                    <form action="" method="post" class="d-inline">
                                        <input type="hidden" name="id_pengguna" value="<?= $row['id_pengguna'] ?>">
                                        <button type="submit" class="btn btn-danger badge" name="hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                                <th class="d-none">Column Tambahan</th>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Materi</h5>
                    <div class="text-end">
                        <a href="share_materi.php?id_ruang=<?= $id_ruang ?>" class="btn btn-primary">Share Materi</a>
                    </div>
                </div>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                            <th class="d-none">Column Tambahan</th>
                            <th class="d-none">Column Tambahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (selectMateriByIdRuang($id_ruang) as $row): ?>
                            <tr class="align-middle">
                                <td><?= $row['judul'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td>
                                    <a href="lihat_file.php?file=<?= $row['file'] ?>" class="btn btn-primary badge">Lihat</a>
                                    <form action="" method="post" class="d-inline">
                                        <input type="hidden" name="id_materi" value="<?= $row['id_materi'] ?>">
                                        <button type="submit" class="btn btn-danger badge" name="hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                                <th class="d-none">Column Tambahan</th>
                                <th class="d-none">Column Tambahan</th>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3">
                <div class="mb-3">
                    <h5>Anggota Siswa</h5>
                </div>
                <ul class="list-group">
                    <?php foreach ($siswa as $row): ?>
                        <li class="list-group-item d-flex align-items-center border-0">
                            <img src="img/siswa/<?= $row['photo_siswa'] ?>" class="rounded-circle bg-light" style="width: 40px; height: 40px;"></img>
                            <span class="ms-3"><?= $row['nama_pengguna'] ?></span>
                        </li>
                        <li class="list-group-item d-flex align-items-center border-0">
                            <img src="img/siswa/<?= $row['photo_siswa'] ?>" class="rounded-circle bg-light" style="width: 40px; height: 40px;"></img>
                            <span class="ms-3"><?= $row['nama_pengguna'] ?></span>
                        </li>
                        <li class="list-group-item d-flex align-items-center border-0">
                            <img src="img/siswa/<?= $row['photo_siswa'] ?>" class="rounded-circle bg-light" style="width: 40px; height: 40px;"></img>
                            <span class="ms-3"><?= $row['nama_pengguna'] ?></span>
                        </li>
                        <li class="list-group-item d-flex align-items-center border-0">
                            <img src="img/siswa/<?= $row['photo_siswa'] ?>" class="rounded-circle bg-light" style="width: 40px; height: 40px;"></img>
                            <span class="ms-3"><?= $row['nama_pengguna'] ?></span>
                        </li>
                        <li class="list-group-item d-flex align-items-center border-0">
                            <img src="img/siswa/<?= $row['photo_siswa'] ?>" class="rounded-circle bg-light" style="width: 40px; height: 40px;"></img>
                            <span class="ms-3"><?= $row['nama_pengguna'] ?></span>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>

</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>