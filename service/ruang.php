<?php

require_once __DIR__ . '/../config/config.php';

function listRuang()
{
    global $conn;
    $sql = "SELECT ruang_pembelajaran.*, kelas.nama as `nama_kelas`
            FROM ruang_pembelajaran
            JOIN kelas ON ruang_pembelajaran.id_kelas = kelas.id_kelas";
    return $conn->query($sql);
}

function selectRuangById($id_ruang)
{
    global $conn;
    $sql = "SELECT * FROM ruang_pembelajaran WHERE id_ruang = $id_ruang";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function tambahRuang($data)
{
    global $conn;

    // Deklarasi data dari form
    $nama = $data['name'];
    $id_guru = $data['id_guru'];
    $id_kelas = $data['id_kelas'];
    $image = $data['pilih_gambar'];

    // jika memilih gambar tersedia
    if ($_FILES['photo']['error'] !== 4) {
        // Upload gambar
        $image = upload('ruang_pembelajaran');

        if (!$image) {
            return false;
        }
    }

    // Tambah data ruang pembelajaran
    $sql = "INSERT INTO ruang_pembelajaran VALUES (NULL, '$image', '$nama', '$id_guru', '$id_kelas')";
    $conn->query($sql);

    return $conn->affected_rows;
}
