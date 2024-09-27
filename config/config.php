<?php

// url aplikasi
define('BASE_URL', 'http://localhost/sistem-sekolah');

// nama aplikasi
define('APP_NAME', 'Sistem Sekolah');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sistem_sekolah');

// koneksi ke database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// cek koneksi
if ($conn->connect_error) {
    die("Error : Server 500" . $conn->connect_error);
}
