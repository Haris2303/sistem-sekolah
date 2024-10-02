<?php

function listKelas()
{
    global $conn;
    $sql = "SELECT * FROM kelas";
    return $conn->query($sql);
}

function tambahKelas($data)
{
    global $conn;

    // deklarasi data
    $nama_kelas = strtoupper($data['name']);

    // tambah data
    $sql = "INSERT INTO kelas VALUES (NULL, '$nama_kelas')";
    $conn->query($sql);

    return $conn->affected_rows;
}

function hapusKelasById($id_kelas)
{
    global $conn;

    // hapus data
    $sql = "DELETE FROM kelas WHERE id_kelas = $id_kelas";
    $conn->query($sql);

    return $conn->affected_rows;
}
