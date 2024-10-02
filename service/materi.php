<?php

require_once __DIR__ . '/../config/utilities.php';

function selectMateriByIdRuang($id_ruang)
{
    global $conn;
    $sql = "SELECT * FROM materi WHERE id_ruang = $id_ruang";
    return $conn->query($sql);
}

function selectMateriById($id_materi)
{
    global $conn;
    $sql = "SELECT * FROM materi WHERE id_materi = $id_materi";
    return $conn->query($sql)->fetch_assoc();
}

function tambahMateri($data)
{
    global $conn;

    // deklarasi data dari form
    $judul = $data['judul'];
    $id_ruang = $data['id_ruang'];

    // upload file
    $file = uploadFilePDF('materi');

    if (!$file) {
        return false;
    }

    // tambah data ke database
    $sql = "INSERT INTO materi VALUES(NULL, '$judul', NOW(), '$file', '$id_ruang')";
    $conn->query($sql);

    return $conn->affected_rows;
}

function hapusMateri($id_materi)
{
    global $conn;

    // dapatkan nama file
    $nama_file = selectMateriById($id_materi)['file'];

    // hapus data materi
    $sql = "DELETE FROM materi WHERE id_materi = $id_materi";
    $conn->query($sql);

    // hapus file
    unlink(__DIR__ . '/../file/materi/' . $nama_file);

    return $conn->affected_rows;
}
