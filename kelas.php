<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/kelas.php';

// ketika tambah ditekan
if (isset($_POST['tambah'])) {
    if (tambahKelas($_POST)) {
        echo "
        <script>
        alert('Kelas berhasil ditambahkan')
        document.location.href = '" . BASE_URL . "/kelas.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
        alert('Kelas gagal ditambahkan')
        document.location.href = '" . BASE_URL . "/kelas.php'
        </script>";
        exit;
    }
}

// ketika hapus ditekan
if (isset($_POST['hapus'])) {
    if (hapusKelasById($_POST['id_kelas'])) {
        echo "
        <script>
        alert('Kelas berhasil dihapus')
        document.location.href = '" . BASE_URL . "/kelas.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
        alert('Kelas gagal dihapus')
        document.location.href = '" . BASE_URL . "/kelas.php'
        </script>";
        exit;
    }
}

$title = 'Kelas';
require_once __DIR__ . '/template/dashboard_navbar.php';

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Kelas</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (listKelas() as $row): ?>
                        <tr>
                            <td><?= $row['nama'] ?></td>
                            <td>
                                <form action="" method="post" class="d-inline">
                                    <input type="hidden" name="id_kelas" value="<?= $row['id_kelas'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" name="hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <div class="card p-3">
                <h4>Tambah Kelas</h4>
                <form action="" method="post">
                    <div class="col-12">
                        <label for="name" class="form-label">Nama kelas</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

<?php require_once __DIR__ . '/template/dashboard_footer.php' ?>