<?php

require_once __DIR__ . '/../config/config.php';

function tambahPengumpulan($id_siswa, $id_tugas)
{
    global $conn;

    $sql = "INSERT INTO pengumpulan VALUES(NULL, NULL, 'belum diserahkan', NULL, 0, $id_siswa, $id_tugas)";
    $conn->query($sql);
}
