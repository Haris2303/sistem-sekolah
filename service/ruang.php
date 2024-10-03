<?php

require_once __DIR__ . '/materi.php';
require_once __DIR__ . '/guru.php';

function listRuangByIdGuru($id_guru)
{
    global $conn;
    $sql = "SELECT
            ruang_pembelajaran.id_ruang,
            ruang_pembelajaran.image,
            ruang_pembelajaran.nama AS nama_ruang,
            ruang_pembelajaran.id_kelas,
            kelas.nama AS nama_kelas,
            guru.id_guru,
            guru.photo,
            guru.nip,
            guru.nuptk,
            guru.nrg,
            guru.jenis_kelamin,
            guru.bidang_studi,
            guru.bidang_sertifikasi,
            guru.jabatan,
            guru.tugas_tambahan,
            guru.id_pengguna
            FROM ruang_pembelajaran
            JOIN kelas ON ruang_pembelajaran.id_kelas = kelas.id_kelas
            JOIN guru ON ruang_pembelajaran.id_guru = guru.id_guru
            WHERE guru.id_guru = $id_guru";
    return $conn->query($sql);
}

function listRuangByIdKelas($id_kelas)
{
    global $conn;
    $sql = "SELECT 
            ruang_pembelajaran.id_ruang,
            ruang_pembelajaran.image,
            ruang_pembelajaran.nama AS nama_ruang,
            ruang_pembelajaran.id_kelas,
            kelas.nama AS nama_kelas
            FROM ruang_pembelajaran
            JOIN kelas ON ruang_pembelajaran.id_kelas = kelas.id_kelas
            WHERE kelas.id_kelas = $id_kelas";
    return $conn->query($sql);
}

function selectRuangById($id_ruang)
{
    global $conn;
    $sql = "SELECT * FROM ruang_pembelajaran WHERE id_ruang = $id_ruang";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function cekRuang($id_ruang)
{
    $id_ruang = (int) $id_ruang;
    if (!is_int($id_ruang) || !selectRuangById($id_ruang)) {
        http_response_code(404);
        include(__DIR__ . '/../404.php');
        exit;
    }
}

function cekAksesRuangByIdPengguna($id_pengguna, $id_ruang)
{
    // check id ruang apakah ada atau tidak, tampilkan 404 jika tidak
    cekRuang($id_ruang);

    $ruang = selectRuangById($id_ruang);

    if ($_SESSION['role'] === 'guru') {
        $guru = selectGuruById($id_pengguna);

        return $guru['id_guru'] !== $ruang['id_guru'];
    } else {
        $siswa = selectSiswaById($id_pengguna);

        return $siswa['id_kelas'] !== $ruang['id_kelas'];
    }
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

        // dapatkan semua data materi dan ruang berdasarkan id_ruang
        $materi = selectMateriByIdRuang($id_ruang);
        $ruang = selectRuangById($id_ruang);

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

        // hapus file gambar ruang jika bukan gambar pilihan
        if (!str_contains($ruang['image'], 'image')) unlink(__DIR__ . '/../img/ruang_pembelajaran/' . $ruang['image']);

        $conn->commit();
    } catch (Exception $e) {
        echo "<script>
                alert('Error: " . $e->getMessage() . "')
            </script>";
    }

    return $record;
}
