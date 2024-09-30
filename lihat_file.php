<?php
$nama_file = $_GET['file'];

$file = 'file/materi/' . $nama_file;

if (file_exists($file)) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($file) . '"');
    readfile($file);
} else {
    echo 'File PDF tidak ditemukan!';
}
