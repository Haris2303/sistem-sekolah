<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/materi.php';

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

function hapusRuangById($id_ruang)
{
    global $conn;

    // pastikan dua table tersebut dieksekusi dengan sukses
    $record = 0;
    try {
        $conn->autocommit(false);

        // dapatkan semua data materi berdasarkan id_ruang
        $materi = selectMateriByIdRuang($id_ruang);

        // hapus materi berdasarkan id ruang
        $sql = "DELETE FROM materi WHERE id_ruang = $id_ruang";
        $conn->query($sql);
        $record = $conn->affected_rows;

        $sql = "DELETE FROM ruang_pembelajaran WHERE id_ruang = $id_ruang";
        $conn->query($sql);
        $record .= $conn->affected_rows;

        // hapus semua file yang belum terhapus
        foreach ($materi as $m) {
            unlink(__DIR__ . '/../file/materi/' . $m['file']);
        }

        $conn->commit();
    } catch (Exception $e) {
        echo "<script>
                alert('Error: " . $e->getMessage() . "')
            </script>";
    }

    return $record;
}
