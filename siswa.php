<?php
$title = 'Siswa';

require_once __DIR__ . '/template/dashboard_navbar.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/siswa.php';

// ketika hapus ditekan
if (isset($_POST['hapus'])) {
    if (hapusSiswaById($_POST['id_pengguna'])) {
        echo "
        <script>
            alert('Siswa berhasil dihapus')
            document.location.href = '" . BASE_URL . "/siswa.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('Siswa gagal dihapus')
            document.location.href = '" . BASE_URL . "/siswa.php'
        </script>";
        exit;
    }
}

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Siswa</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="row text-end">
        <div class="col">
            <a href="#" class="btn btn-secondary">Generate</a>
            <a href="siswa_tambah.php" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>

    <table class="table datatable">
        <thead>
            <tr>
                <th>Foto</th>
                <th>NIPD</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (listSiswa() as $row): ?>
                <tr class="align-middle">
                    <td><img src="img/siswa/<?= $row['photo'] ?>" alt="Profil" style="width: 5rem;"></td>
                    <td><?= $row['nipd'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['jenis_kelamin'] ?></td>
                    <td><?= $row['nama_kelas'] ?></td>
                    <td>
                        <a href="siswa_edit.php?id_pengguna=<?= $row['id_pengguna'] ?>" class="btn btn-success btn-sm">Edit</a>
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

<script src="vendor/simple-datatables/simple-datatables.js"></script>
<script src="vendor/tinymce/tinymce.min.js"></script>

<?php require_once 'template/dashboard_footer.php' ?>