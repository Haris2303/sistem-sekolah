<?php

require_once __DIR__ . '/../config/config.php';

function listPemberitahuan()
{
    global $conn;
    $sql = "SELECT pemberitahuan.*, pengguna.nama as `nama` 
            FROM pemberitahuan 
            JOIN siswa ON pemberitahuan.id_siswa = siswa.id_siswa
            JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna";
    return $conn->query($sql);
}

function selectPemberitahuanById($id_pemberituan)
{
    global $conn;
    $sql = "SELECT pemberitahuan.*, pengguna.nama as `nama` 
            FROM pemberitahuan 
            JOIN siswa ON pemberitahuan.id_siswa = siswa.id_siswa
            JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna
            WHERE id_pemberitahuan = $id_pemberituan";
    return $conn->query($sql)->fetch_assoc();
}

function tambahPemberitahuan($data)
{
    global $conn;

    // deklarasi data
    $subjek = $data['subjek'];
    $pesan = $data['pesan'];
    $id_siswa = $data['id_siswa'];

    // tambah data
    $sql = "INSERT INTO pemberitahuan VALUES (NULL, '$subjek', '$pesan', NOW(), false, '$id_siswa')";
    $conn->query($sql);

    return $conn->affected_rows;
}

function hapusPemberitahuan($id_pemberitahuan)
{
    global $conn;
    $sql = "DELETE FROM pemberitahuan WHERE id_pemberitahuan = $id_pemberitahuan";
    $conn->query($sql);
    return $conn->affected_rows;
}
