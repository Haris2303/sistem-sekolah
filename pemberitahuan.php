<?php
$title = 'Pemberitahuan';

require_once __DIR__ . '/template/dashboard_navbar.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/pemberitahuan.php';

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

?>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1>Pemberitahuan</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, totam ducimus! Quidem harum quos recusandae sed nihil consequatur impedit esse quaerat. Quasi ad possimus cupiditate suscipit nulla. Molestias, earum impedit?</span>
    </div>

    <div class="row text-end">
        <div class="col">
            <a href="pemberitahuan_tambah.php" class="btn btn-primary">Buat Pemberitahuan</a>
        </div>
    </div>

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
            <?php foreach (listPemberitahuan() as $row): ?>
                <tr class="align-middle">
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['subjek'] ?></td>
                    <td><?= $row['waktu'] ?></td>
                    <td><?= ($row['dibaca']) ? 'Telah dibaca' : 'Belum dibaca' ?></td>
                    <td>
                        <a href="lihat_pesan.php?id_pemberitahuan=<?= $row['id_pemberitahuan'] ?>" class="btn btn-primary btn-sm">Lihat</a>
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