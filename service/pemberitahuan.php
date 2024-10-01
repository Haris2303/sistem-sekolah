<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/siswa.php';

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

function selectPemberitahuanByIdSiswa($id_siswa, $dibaca)
{
    global $conn;
    $sql = "SELECT pemberitahuan.*, pengguna.nama as `nama` 
            FROM pemberitahuan
            JOIN siswa ON pemberitahuan.id_siswa = siswa.id_siswa
            JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna
            WHERE siswa.id_siswa = $id_siswa AND dibaca = $dibaca";
    return $conn->query($sql);
}

function cekPemberitahuan($id_pemberitahuan)
{
    $id_pemberitahuan = (int) $id_pemberitahuan;
    if (!is_int($id_pemberitahuan) || !selectPemberitahuanById($id_pemberitahuan)) {
        http_response_code(404);
        include(__DIR__ . '/../404.php');
        exit;
    }
}

function cekAksesPemberitahuanByIdPengguna($id_pengguna, $id_pemberitahuan)
{
    // check id pemberitahuan apakah ada atau tidak, tampilkan 404 jika tidak
    cekPemberitahuan($id_pemberitahuan);

    $pemberitahuan = selectPemberitahuanById($id_pemberitahuan);

    $siswa = selectSiswaById($id_pengguna);

    return $siswa['id_siswa'] !== $pemberitahuan['id_siswa'];
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

function editDibacaById($id_pemberitahuan)
{
    global $conn;
    $sql = "UPDATE pemberitahuan SET dibaca = true WHERE id_pemberitahuan = $id_pemberitahuan";
    $conn->query($sql);
    return $conn->affected_rows;
}
