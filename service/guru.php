<?php

require_once __DIR__ . '/../config/utilities.php';
require_once __DIR__ . '/auth.php';

// fungsi tambah data guru
function tambahGuru($data, $id_pengguna)
{
    global $conn;

    // deklarasi data dari form
    $nip = $data['nip'];
    $nuptk = $data['nuptk'];
    $nrg = $data['nrg'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $bidang_studi = $data['bidang_studi'];
    $bidang_sertifikasi = $data['bidang_sertifikasi'];
    $jabatan = $data['jabatan'];
    $tugas_tambahan = $data['tugas_tambahan'];

    // upload gambar
    $photo = upload('guru');

    if (!$photo) {
        return false;
    }

    // tambah data guru
    $sql = "INSERT INTO guru VALUES (NULL, '$photo', '$nip', '$nuptk', '$nrg', '$jenis_kelamin', '$bidang_studi', '$bidang_sertifikasi', '$jabatan', '$tugas_tambahan', '$id_pengguna')";
    $conn->query($sql);
}

function listGuru()
{
    global $conn;
    $sql = "SELECT * FROM guru JOIN pengguna ON pengguna.id_pengguna = guru.id_pengguna";
    return $conn->query($sql);
}

function selectGuruById($id_pengguna)
{
    global $conn;
    $sql = "SELECT * FROM guru JOIN pengguna ON guru.id_pengguna = pengguna.id_pengguna WHERE guru.id_pengguna = $id_pengguna";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function editGuruById($id_pengguna, $data)
{
    global $conn;

    // deklarasi data dari form
    $nip = $data['nip'];
    $nuptk = $data['nuptk'];
    $nrg = $data['nrg'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $bidang_studi = $data['bidang_studi'];
    $bidang_sertifikasi = $data['bidang_sertifikasi'];
    $jabatan = $data['jabatan'];
    $tugas_tambahan = $data['tugas_tambahan'];
    $photo_lama = $data['photo_lama'];

    if ($_FILES['photo']['error'] === 4) {
        $photo = $photo_lama;
    } else {
        $photo = upload('guru');
        unlink(__DIR__ . '/../img/guru/' . $photo_lama);
    }

    $record = 0;
    try {
        $conn->autocommit(false);

        $redirect = '/guru_edit.php?id_pengguna=' . $id_pengguna;
        $record = editPenggunaById($id_pengguna, $data, $redirect);

        $sql = "UPDATE guru SET 
                photo = '$photo',
                nip = '$nip',
                nuptk = '$nuptk',
                nrg = '$nrg',
                jenis_kelamin = '$jenis_kelamin',
                bidang_studi = '$bidang_studi',
                bidang_sertifikasi = '$bidang_sertifikasi',
                jabatan = '$jabatan',
                tugas_tambahan = '$tugas_tambahan'
                WHERE id_pengguna = $id_pengguna";

        $conn->query($sql);

        $record .= $conn->affected_rows;

        $conn->commit();
    } catch (Exception $e) {
        echo "
        <script>
            alert('Error: " . $e->getMessage() . "')
           document.location.href = '" . BASE_URL . "/guru_edit.php?id_pengguna=" . $id_pengguna . "'
        </script>";
        exit;
    }

    return $record;
}

function hapusGuruById($id_pengguna)
{
    global $conn;

    // pastikan data guru dan pengguna terhapus
    try {
        $conn->autocommit(false);

        // dapatkan data foto
        $photo = selectGuruById($id_pengguna)['photo'];

        // hapus data guru
        $sql = "DELETE FROM guru WHERE id_pengguna = $id_pengguna";
        $conn->query($sql);

        // hapus data pengguna
        hapusPenggunaById($id_pengguna);

        $record = $conn->affected_rows;

        $conn->commit();
    } catch (Exception $e) {
        echo "
        <script>
            alert('Error: " . $e->getMessage() . "')
            document.location.href = '" . BASE_URL . "/guru.php'
        </script>";
        exit;
    }

    // hapus file foto pada folder img/guru
    unlink(__DIR__ . '/../img/guru/' . $photo);

    return $record;
}

function editPhotoGuruById($id_pengguna, $files)
{
    global $conn;

    $guru = selectGuruById($id_pengguna);
    $photo_lama = $guru['photo'];

    if ($files['photo']['error'] === 4) {
        $photo = $photo_lama;
    } else {
        $photo = upload('guru');
        unlink(__DIR__ . '/../img/guru/' . $photo_lama);
    }

    $sql = "UPDATE guru SET photo = '$photo' WHERE id_pengguna = $id_pengguna";
    $conn->query($sql);
}
