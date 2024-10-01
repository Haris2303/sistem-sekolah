<?php

session_start();

require_once 'const.php';

// koneksi ke database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// cek koneksi
if ($conn->connect_error) {
    die("Error : Server 500" . $conn->connect_error);
}
