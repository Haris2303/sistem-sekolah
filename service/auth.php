<?php

require_once '../config/config.php';

// ketika daftar
if (isset($_POST['daftar'])) {
    if (daftar($_POST)) {
        echo "
        <script>
            alert('User berhasil registrasi')
            document.location.href = '" . BASE_URL . "/daftar.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('User gagal registrasi')
            document.location.href = '" . BASE_URL . "/daftar.php'
        </script>";
        exit;
    }
}

// ketika login
if (isset($_POST['login'])) {
    if (login($_POST)) {
        echo "
        <script>
            alert('User berhasil registrasi')
            $href/daftar.php
        </script>";
        exit;
    }
}

function daftar($data)
{
    global $conn, $href;

    // deklarasi data dari form
    $name = $data['name'];
    $email = $data['email'];
    $username = $data['username'];
    $password = $data['password'];
    $konfirmasi_password = $data['konfirmasi_password'];

    // cek username terdaftar
    $sql = "SELECT username FROM pengguna WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows) {
        echo "
        <script>
            alert('Data email telah teregister')
            document.location.href = '" . BASE_URL . "/daftar.php'
        </script>";
        exit;
    }

    // cek password konfirmasi
    if ($password !== $konfirmasi_password) {
        echo "
        <script>
            alert('Password konfirmasi tidak sama')
            document.location.href = '" . BASE_URL . "/daftar.php'
        </script>";
        exit;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan data ke database
    $sql = "INSERT INTO pengguna VALUES (
        NULL,
        '$name',
        '$email',
        '$username',
        '$password',
        'admin')
    ";
    $conn->query($sql);

    // tangkap hasil record
    $record = $conn->affected_rows;

    // tutup koneksi
    $conn->close();

    // kembalikan hasil record
    return $record;
}

function login($data)
{
    global $conn, $href;

    // Dapatkan data dari inputan
    $username = $data['username'];
    $password = $data['password'];

    // cek username apakah ada di database
    $sql = "SELECT * FROM pengguna WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows) {
        // cek apakah passwordnya benar
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // set session
            $_SESSION['is_login'] = true;
            $_SESSION['id_user'] = $row['id'];
            // arahkan ke halaman aplikasi
            header('location: ' . BASE_URL . '/dashboard.php');
            exit;
        }
    }

    // jika username atau password salah arahkan kembali ke login
    echo "
        <script>
            alert('Email atau password salah')
            document.location.href = '" . BASE_URL . "/login.php'
        </script>";
    exit;
}
