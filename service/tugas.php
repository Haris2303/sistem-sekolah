<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/utilities.php';
require_once __DIR__ . '/pengumpulan.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/ruang.php';

function selectTugasByIdRuang($id_ruang)
{
    global $conn;
    $sql = "SELECT * FROM tugas WHERE id_ruang = $id_ruang";
    return $conn->query($sql);
}

function selectTugasById($id_tugas)
{
    global $conn;
    $sql = "SELECT * FROM tugas WHERE id_tugas = $id_tugas";
    return $conn->query($sql)->fetch_assoc();
}

function cekTugas($id_tugas)
{
    $id_tugas = (int) $id_tugas;
    if (!is_int($id_tugas) || !selectTugasById($id_tugas)) {
        http_response_code(404);
        include(__DIR__ . '/../404.php');
        exit;
    }
}

function cekAksesTugasByIdPengguna($id_pengguna, $id_tugas)
{
    // check id tugas apakah ada atau tidak, tampilkan 404 jika tidak
    cekTugas($id_tugas);

    $guru = selectGuruById($id_pengguna);
    $ruang = listRuangByIdGuru($guru['id_guru'])->fetch_assoc();

    return is_null($ruang);
}

function tambahTugas($data)
{
    global $conn;

    // deklarasi data dari form
    $judul = $data['judul'];
    $date = $data['date'];
    $time = $data['time'];
    $deadline = "$date $time";
    $id_ruang = $data['id_ruang'];

    // upload file
    $file = uploadFilePDF('tugas');

    if (!$file) {
        return false;
    }

    $record = 0;
    try {
        $conn->autocommit(false);

        // ambil jumlah semua siswa sesuai id ruang
        $sql = "SELECT * FROM siswa 
                JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                JOIN ruang_pembelajaran ON kelas.id_kelas = ruang_pembelajaran.id_kelas
                WHERE ruang_pembelajaran.id_ruang = $id_ruang";
        $siswa = $conn->query($sql);
        $jumlah_siswa = $siswa->num_rows;

        $record = $conn->affected_rows;

        // tambah data
        $sql = "INSERT INTO tugas VALUES(NULL, '$judul', '$deadline', 0, $jumlah_siswa, '$file', $id_ruang)";
        $conn->query($sql);
        $id_tugas_last = $conn->insert_id;

        // tambah data pengumpulan untuk siswa
        foreach ($siswa as $s) {
            tambahPengumpulan($s['id_siswa'], $id_tugas_last);
            $record .= $conn->affected_rows;
        }

        $conn->commit();
    } catch (Exception $e) {
        echo "<script>
                alert('Error: " . $e->getMessage() . "')
            </script>";
    }

    return $record;
}

function hapusTugas($id_tugas)
{
    global $conn;

    $record = 0;
    try {
        $conn->autocommit(false);

        // hapus data pengumpulan
        $record = hapusPengumpulanByIdTugas($id_tugas);

        // dapatkan nama file untuk dihapus
        $nama_file = selectTugasById($id_tugas)['file'];

        // hapus data tugas
        $sql = "DELETE FROM tugas WHERE id_tugas = $id_tugas";
        $conn->query($sql);

        $record .= $conn->affected_rows;

        // hapus file
        unlink(__DIR__ . '/../file/tugas/' . $nama_file);

        $conn->commit();
    } catch (Exception $e) {
        echo "<script>
                alert('Error: " . $e->getMessage() . "')
            </script>";
    }

    return $record;
}
