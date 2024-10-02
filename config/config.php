<?php

session_start();

// Mengambil protokol (http atau https)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

// Mengambil host (nama domain atau IP)
$host = $_SERVER['HTTP_HOST'];

// Mengambil path dari URL
$path = $_SERVER['REQUEST_URI'];

// Menggabungkan semua bagian untuk mendapatkan URL lengkap
$urlSaatIni = $protocol . "://" . $host . $path;

// mengambil nama file
$namaFileSaatIni = basename($urlSaatIni);

// cek apakah tidak ada session is_login dan file yang dituju adalah login.php
if (!isset($_SESSION['is_login']) && $namaFileSaatIni !== 'login.php') {
    http_response_code(404);
    include(__DIR__ . '/../404.php');
    exit;
}

require_once 'const.php';

// koneksi ke database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// cek koneksi
if ($conn->connect_error) {
    die("Error : Server 500" . $conn->connect_error);
}
