<?php

$title = 'Guru';

require_once __DIR__ . '/template/dashboard_navbar.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/siswa.php';
require_once __DIR__ . '/service/ruang.php';
require_once __DIR__ . '/service/materi.php';
require_once __DIR__ . '/service/tugas.php';

$id_ruang = $_GET['id_ruang'];
$ruang = selectRuangById($id_ruang);
$siswa = selectSiswaByKelas($ruang['id_kelas']);

// membuat session id ruang
$_SESSION['id_ruang'] = $id_ruang;

if ($_SESSION['role'] === 'guru') {
    $listTugas = selectTugasByIdRuang($id_ruang);
}

if ($_SESSION['role'] === 'siswa') {
    $id_siswa = selectSiswaById($_SESSION['id_pengguna'])['id_siswa'];
    $listTugas = selectPengumpulanByIdSiswa($id_siswa);
}

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

// ketika hapus tugas ditekan
if (isset($_POST['hapus_tugas'])) {
    if (hapusTugas($_POST['id_tugas'])) {
        echo "
        <script>
            alert('Tugas berhasil dihapus')
            document.location.href = '" . BASE_URL . "/detail_ruang.php?id_ruang=" . $id_ruang . "'
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('Tugas gagal dihapus')
            document.location.href = '" . BASE_URL . "/ruang_pembelajaran.php?id_ruang=" . $id_ruang . "'
        </script>";
        exit;
    }
}

// ketika hapus materi ditekan
if (isset($_POST['hapus_materi'])) {
    if (hapusMateri($_POST['id_materi'])) {
        echo "
        <script>
            alert('Materi berhasil dihapus')
            document.location.href = '" . BASE_URL . "/detail_ruang.php?id_ruang=" . $id_ruang . "'
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('Materi gagal dihapus')
            document.location.href = '" . BASE_URL . "/ruang_pembelajaran.php?id_ruang=" . $id_ruang . "'
        </script>";
        exit;
    }
}

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Ruang Pembelajaran | <?= $ruang['nama'] ?></h1>

            <?php if ($_SESSION['role'] === 'guru'): ?>
                <form action="" method="POST">
                    <input type="hidden" name="id_ruang" value="<?= $id_ruang ?>">
                    <button type="submit" name="hapus_ruang" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus ruang ini?')">Hapus Ruang</button>
                </form>
            <?php endif ?>
        </div>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card p-3">

                <?php if ($_SESSION['role'] === 'guru'): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Test Siswa</h5>
                        <div class="text-end">
                            <a href="buat_test.php?id_ruang=<?= $id_ruang ?>" class="btn btn-primary">Buat Test</a>
                        </div>
                    </div>
                <?php endif ?>

                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deadline</th>

                            <?php if ($_SESSION['role'] === 'guru'): ?>
                                <th>Siswa Kerjakan</th>
                            <?php endif ?>

                            <?php if ($_SESSION['role'] === 'siswa'): ?>
                                <th>Nilai</th>
                                <th>Status</th>
                            <?php endif ?>
                            <th class="text-center">Aksi</th>
                            <th class="d-none">Column Tambahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listTugas as $row): ?>
                            <tr class="align-middle">
                                <td><?= $row['judul'] ?></td>
                                <td><?= $row['deadline'] ?></td>

                                <?php if ($_SESSION['role'] === 'guru'): ?>
                                    <td><?= $row['jumlah_diserahkan'] ?></td>
                                <?php endif ?>

                                <?php if ($_SESSION['role'] === 'siswa'): ?>
                                    <td class="text-center"><?= $row['nilai'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                <?php endif ?>

                                <td>
                                    <?php if ($_SESSION['role'] === 'guru'): ?>
                                        <a href="penilaian_test.php?id_tugas=<?= $row['id_tugas'] ?>" class="btn btn-primary badge">Penilaian</a>
                                    <?php elseif ($_SESSION['role'] === 'siswa'): ?>
                                        <?php if ($row['status'] === 'belum diserahkan'): ?>
                                            <a href="kumpul_tugas.php?id_pengumpulan=<?= $row['id_pengumpulan'] ?>" class="btn btn-primary badge">Kumpul</a>
                                        <?php elseif ($row['status'] === 'diserahkan'): ?>
                                            <a href="lihat_file.php?file=<?= $row['file_pengumpulan'] ?>&folder=pengumpulan" class="btn btn-primary badge">Lihat Hasil</a>
                                        <?php endif ?>
                                    <?php endif ?>
                                    <?php if ($_SESSION['role'] === 'guru'): ?>
                                        <form action="" method="post" class="d-inline">
                                            <input type="hidden" name="id_tugas" value="<?= $row['id_tugas'] ?>">
                                            <button type="submit" class="btn btn-danger badge" name="hapus_tugas" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    <?php endif ?>
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
                    <?php if ($_SESSION['role'] === 'guru'): ?>
                        <div class="text-end">
                            <a href="share_materi.php?id_ruang=<?= $id_ruang ?>" class="btn btn-primary">Share Materi</a>
                        </div>
                    <?php endif ?>
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
                                    <a href="lihat_file.php?file=<?= $row['file'] ?>&folder=materi" class="btn btn-primary badge">Lihat</a>
                                    <?php if ($_SESSION['role'] === 'guru'): ?>
                                        <form action="" method="post" class="d-inline">
                                            <input type="hidden" name="id_materi" value="<?= $row['id_materi'] ?>">
                                            <button type="submit" class="btn btn-danger badge" name="hapus_materi" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    <?php endif ?>
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
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>

</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>