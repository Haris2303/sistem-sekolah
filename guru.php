<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/guru.php';

// jika yang akses adalah guru tampilkan 404
if ($_SESSION['role'] === 'siswa') {
    include(__DIR__ . '/404.php');
    exit;
}

// ketika hapus ditekan
if (isset($_POST['hapus'])) {
    if (hapusGuruById($_POST['id_pengguna'])) {
        echo "
        <script>
            alert('User berhasil dihapus')
            document.location.href = '" . BASE_URL . "/guru.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('User gagal dihapus')
            document.location.href = '" . BASE_URL . "/guru.php'
        </script>";
        exit;
    }
}

$title = 'Guru';
require_once __DIR__ . '/template/dashboard_navbar.php';

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Guru</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="row text-end">
        <div class="col">
            <a href="#" class="btn btn-secondary">Generate</a>
            <a href="guru_tambah.php" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>

    <table class="table datatable">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Bidang Studi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (listGuru() as $row): ?>
                <tr class="align-middle">
                    <td><img src="img/guru/<?= $row['photo'] ?>" alt="Profil" style="width: 5rem;"></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['jenis_kelamin'] ?></td>
                    <td><?= $row['bidang_studi'] ?></td>
                    <td>
                        <a href="guru_edit.php?id_pengguna=<?= $row['id_pengguna'] ?>" class="btn btn-success btn-sm">Edit</a>
                        <form action="" method="post" class="d-inline">
                            <input type="hidden" name="id_pengguna" value="<?= $row['id_pengguna'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm" name="hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>