<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/auth.php';

function listSiswa()
{
    global $conn;
    $sql = "SELECT siswa.*, pengguna.*, kelas.nama as `nama_kelas`
            FROM siswa
            JOIN pengguna ON pengguna.id_pengguna = siswa.id_pengguna 
            JOIN kelas ON kelas.id_kelas = siswa.id_kelas";
    return $conn->query($sql);
}

function selectSiswaById($id_pengguna)
{
    global $conn;
    $sql = "SELECT * FROM siswa JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna WHERE siswa.id_pengguna = $id_pengguna";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function selectSiswaByKelas($id_kelas)
{
    global $conn;
    $sql = "SELECT 
            pengguna.id_pengguna AS id_pengguna,
            pengguna.nama AS nama_pengguna,
            pengguna.email AS email_pengguna,
            pengguna.username AS username_pengguna,
            siswa.id_siswa AS id_siswa,
            siswa.photo AS photo_siswa,
            siswa.nipd AS nipd_siswa,
            siswa.jenis_kelamin AS jenis_kelamin_siswa,
            siswa.id_kelas AS id_kelas_siswa,
            kelas.id_kelas AS id_kelas,
            kelas.nama AS nama_kelas 
            FROM pengguna 
            JOIN siswa ON siswa.id_pengguna = pengguna.id_pengguna
            JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            WHERE kelas.id_kelas = $id_kelas";
    return $conn->query($sql);
}

function tambahSiswa($data, $id_pengguna)
{
    global $conn;

    // deklarasi data dari form
    $nipd = $data['nipd'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $id_kelas = $data['id_kelas'];

    // upload gambar
    $photo = upload('siswa');

    if (!$photo) {
        return false;
    }

    // tambah data 
    $sql = "INSERT INTO siswa VALUES (NULL, '$photo', '$nipd', '$jenis_kelamin', '$id_pengguna', '$id_kelas')";
    $conn->query($sql);
}

function editSiswaById($id_pengguna, $data)
{
    global $conn;

    // deklarasi data dari form
    $nipd = $data['nipd'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $id_kelas = $data['id_kelas'];
    $photo_lama = $data['photo_lama'];

    if ($_FILES['photo']['error'] === 4) {
        $photo = $photo_lama;
    } else {
        $photo = upload('siswa');
        unlink(__DIR__ . '/../img/siswa/' . $photo_lama);
    }

    try {
        $conn->autocommit(false);

        $redirect = '/siswa_edit.php?id_pengguna=' . $id_pengguna;
        editPenggunaById($id_pengguna, $data, $redirect);

        $sql = "UPDATE siswa SET 
                photo = '$photo',
                nipd = '$nipd',
                jenis_kelamin = '$jenis_kelamin',
                id_kelas = '$id_kelas'
                WHERE id_pengguna = $id_pengguna";

        $conn->query($sql);

        $record = $conn->affected_rows;

        $conn->commit();
    } catch (Exception $e) {
        echo "
        <script>
            alert('Error: " . $e->getMessage() . "')
           document.location.href = '" . BASE_URL . "/siswa_edit.php?id_pengguna=" . $id_pengguna . "'
        </script>";
        exit;
    }

    return $record;
}

function hapusSiswaById($id_pengguna)
{
    global $conn;

    // pastikan data siswa dan pengguna terhapus
    try {
        $conn->autocommit(false);

        // dapatkan data foto
        $photo = selectSiswaById($id_pengguna)['photo'];

        // hapus data siswa
        $sql = "DELETE FROM siswa WHERE id_pengguna = $id_pengguna";
        $conn->query($sql);

        // hapus data pengguna
        hapusPenggunaById($id_pengguna);

        $record = $conn->affected_rows;

        $conn->commit();
    } catch (Exception $e) {
        echo "
        <script>
            alert('Error: " . $e->getMessage() . "')
            document.location.href = '" . BASE_URL . "/siswa.php'
        </script>";
        exit;
    }

    // hapus file foto pada folder img/siswa
    unlink(__DIR__ . '/../img/siswa/' . $photo);

    return $record;
}

function editPhotoSiswaById($id_pengguna, $files)
{
    global $conn;

    $siswa = selectSiswaById($id_pengguna);
    $photo_lama = $siswa['photo'];

    if ($files['photo']['error'] === 4) {
        $photo = $photo_lama;
    } else {
        $photo = upload('siswa');
        unlink(__DIR__ . '/../img/siswa/' . $photo_lama);
    }

    $sql = "UPDATE siswa SET photo = '$photo' WHERE id_pengguna = $id_pengguna";
    $conn->query($sql);
}
