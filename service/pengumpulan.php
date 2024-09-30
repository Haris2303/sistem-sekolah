<?php

require_once __DIR__ . '/../config/config.php';

function selectPengumpulanByIdTugas($id_tugas)
{
    global $conn;
    $sql = "SELECT * FROM pengumpulan 
            JOIN siswa ON pengumpulan.id_siswa = siswa.id_siswa
            JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna
            WHERE id_tugas = $id_tugas";
    return $conn->query($sql);
}

function tambahPengumpulan($id_siswa, $id_tugas)
{
    global $conn;
    $sql = "INSERT INTO pengumpulan VALUES(NULL, NULL, 'belum diserahkan', NULL, 0, $id_siswa, $id_tugas)";
    $conn->query($sql);
}

function hapusPengumpulanByIdTugas($id_tugas)
{
    global $conn;
    $sql = "DELETE FROM pengumpulan WHERE id_tugas = $id_tugas";
    $conn->query($sql);
    return $conn->affected_rows;
}
