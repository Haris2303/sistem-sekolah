<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/utilities.php';
require_once __DIR__ . '/tugas.php';

function selectPengumpulanByIdTugas($id_tugas)
{
    global $conn;
    $sql = "SELECT * FROM pengumpulan 
            JOIN siswa ON pengumpulan.id_siswa = siswa.id_siswa
            JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna
            WHERE id_tugas = $id_tugas";
    return $conn->query($sql);
}

function selectPengumpulanByIdSiswa($id_siswa)
{
    global $conn;

    $sql = "SELECT tugas.id_tugas,
                tugas.judul,
                tugas.deadline,
                tugas.jumlah_diserahkan,
                tugas.jumlah_belum_diserahkan,
                tugas.file AS file_tugas,
                pengumpulan.id_pengumpulan,
                pengumpulan.tanggal_kumpul,
                pengumpulan.status,
                pengumpulan.file AS file_pengumpulan,
                pengumpulan.nilai,
                pengumpulan.id_siswa 
            FROM pengumpulan JOIN tugas ON pengumpulan.id_tugas = tugas.id_tugas
            WHERE id_siswa = $id_siswa";
    return $conn->query($sql);
}

function selectPengumpulanById($id_pengumpulan)
{
    global $conn;

    $sql = "SELECT * FROM pengumpulan JOIN tugas ON pengumpulan.id_tugas = tugas.id_tugas
            WHERE id_pengumpulan = $id_pengumpulan";
    return $conn->query($sql)->fetch_assoc();
}

function tambahPengumpulan($id_siswa, $id_tugas)
{
    global $conn;
    $sql = "INSERT INTO pengumpulan VALUES(NULL, NULL, 'belum diserahkan', NULL, 0, $id_siswa, $id_tugas)";
    $conn->query($sql);
}

function serahkanPengumpulan($data)
{
    global $conn;

    $id_pengumpulan = $data['id_pengumpulan'];

    $file = uploadFilePDF('pengumpulan');
    if (!$file) {
        return false;
    }

    $record = 0;
    try {
        $conn->autocommit(false);

        // ubah status pengumpulan
        $sql = "UPDATE pengumpulan SET tanggal_kumpul = NOW(), status = 'diserahkan', file = '$file' WHERE id_pengumpulan = $id_pengumpulan";
        $conn->query($sql);

        $record = $conn->affected_rows;

        $id_tugas = selectPengumpulanById($id_pengumpulan)['id_tugas'];

        // ubah jumlah diserahkan pada tugas
        $sql = "UPDATE tugas SET jumlah_diserahkan = jumlah_diserahkan + 1 WHERE id_tugas = $id_tugas";
        $conn->query($sql);

        $record .= $conn->affected_rows;

        $conn->commit();
    } catch (Exception $e) {
        echo "<script>
                alert('Error: " . $e->getMessage() . "')
            </script>";
    }

    return $record;
}

function hapusPengumpulanByIdTugas($id_tugas)
{
    global $conn;
    $sql = "DELETE FROM pengumpulan WHERE id_tugas = $id_tugas";
    $conn->query($sql);
    return $conn->affected_rows;
}

function menilaiPengumpulanById($data)
{
    global $conn;

    $nilai = $data['nilai'];
    $id_pengumpulan = $data['id_pengumpulan'];

    $sql = "UPDATE pengumpulan SET nilai = $nilai WHERE id_pengumpulan = $id_pengumpulan";
    $conn->query($sql);

    return $conn->affected_rows;
}
