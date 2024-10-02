<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/pemberitahuan.php';
require_once __DIR__ . '/service/siswa.php';

$role = $_SESSION['role'];

// jika yang akses adalah guru tampilkan 404
if ($role === 'guru') {
    include(__DIR__ . '/404.php');
    exit;
}

// dapatkan id siswa jika pengguna adalah siswa
$id_siswa = ($role === 'siswa') ? selectSiswaById($_SESSION['id_pengguna'])['id_siswa'] : null;

// jika role siswa
if ($role === 'siswa') {
    $pemberitahuan = selectPemberitahuanByIdSiswa($id_siswa, 'true');
}

if ($role === 'admin') {
    $pemberitahuan = listPemberitahuan();
}

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

// jika tombol lihat ditekan
if (isset($_POST['edit_dibaca'])) {
    editDibacaById($_POST['id_pemberitahuan']);
    echo "<script>window.location.href = 'lihat_pesan.php?id_pemberitahuan=" . $_POST['id_pemberitahuan'] . "';</script>";
    exit;
}

$title = 'Pemberitahuan';
require_once __DIR__ . '/template/dashboard_navbar.php';

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Pemberitahuan</h1>
        <span>Sistem kami mengirimkan pemberitahuan penting terkait pembayaran, keaktifan, dll. Pastikan Anda memeriksa setiap pesan yang masuk untuk informasi lebih lanjut. Jika ada pertanyaan, hubungi bagian administrasi sekolah.</span>
    </div>

    <?php if ($_SESSION['role'] === 'admin'): ?>
        <div class="row text-end">
            <div class="col">
                <a href="pemberitahuan_tambah.php" class="btn btn-primary">Buat Pemberitahuan</a>
            </div>
        </div>
    <?php endif ?>

    <table class="table datatable">
        <thead>
            <tr>
                <th>Kepada</th>
                <th>Subject</th>
                <th>Tanggal Kirim</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pemberitahuan as $row): ?>
                <tr class="align-middle">
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['subjek'] ?></td>
                    <td><?= $row['waktu'] ?></td>
                    <td><?= ($row['dibaca']) ? 'Telah dibaca' : 'Belum dibaca' ?></td>
                    <td>
                        <?php if ($_SESSION['role'] === 'siswa'): ?>
                            <form action="" method="post" class="d-inline">
                                <input type="hidden" name="id_pemberitahuan" value="<?= $row['id_pemberitahuan'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm" name="edit_dibaca">Lihat</button>
                            </form>
                        <?php else: ?>
                            <a href="lihat_pesan.php?id_pemberitahuan=<?= $row['id_pemberitahuan'] ?>" class="btn btn-primary btn-sm">Lihat</a>
                        <?php endif ?>
                        <form action="" method="post" class="d-inline">
                            <input type="hidden" name="id_pemberitahuan" value="<?= $row['id_pemberitahuan'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm" name="hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</main>

<script src="vendor/simple-datatables/simple-datatables.js"></script>
<script src="vendor/tinymce/tinymce.min.js"></script>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>