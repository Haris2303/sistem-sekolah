<?php
$nama_file = $_GET['file'];
$folder = $_GET['folder'];

$file = 'file/' . $folder . '/' . $nama_file;

if (file_exists($file)) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($file) . '"');
    readfile($file);
} else {
    echo 'File PDF tidak ditemukan!';
}
