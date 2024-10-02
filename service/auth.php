<?php

require_once __DIR__ . '/guru.php';
require_once __DIR__ . '/siswa.php';

// ketika daftar 
if (isset($_POST['daftar'])) {
    if (daftar($_POST, 'admin', '/daftar.php')) {
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

// Fugnsi daftar akun
function daftar($data, $role, $redirect)
{
    global $conn;

    $record = 0;

    try {
        $conn->autocommit(false);

        // buat data pengguna
        $id_pengguna = tambahPengguna($data, $role, $redirect);

        // check apakah role adalah guru
        if ($role === 'guru') {
            // dapatkan id pengguna setelah insert
            $id_pengguna = $conn->insert_id;

            // deklarasi data dari form
            tambahGuru($data, $id_pengguna);
        }

        // check apakah role adalah guru
        if ($role === 'siswa') {
            // dapatkan id pengguna setelah insert
            $id_pengguna = $conn->insert_id;

            // deklarasi data dari form
            tambahSiswa($data, $id_pengguna);
        }
        // tangkap hasil record
        $record = $conn->affected_rows;

        $conn->commit();
    } catch (Exception $e) {
        echo "
        <script>
            alert('Error: " . $e->getMessage() . "')
        </script>";
    }

    // tutup koneksi
    $conn->close();

    // kembalikan hasil record
    return $record;
}

// Fungsi melakukan login akun
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
            $_SESSION['id_pengguna'] = $row['id_pengguna'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['role'] = $row['role'];
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

// Fungsi tambah data pengguna
function tambahPengguna($data, $role, $redirect)
{
    global $conn;

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
            document.location.href = '" . BASE_URL . $redirect . "'
        </script>";
        exit;
    }

    // cek password konfirmasi
    if ($password !== $konfirmasi_password) {
        echo "
        <script>
            alert('Password konfirmasi tidak sama')
            document.location.href = '" . BASE_URL . $redirect . "'
        </script>";
        exit;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan data akun ke database
    $sql = "INSERT INTO pengguna VALUES (
        NULL,
        '$name',
        '$email',
        '$username',
        '$password',
        '$role')
    ";

    return $conn->query($sql) ? $conn->insert_id : 0;
}

// fungsi edit pengguna
function editPenggunaById($id_pengguna, $data, $redirect)
{
    global $conn;

    // deklarasi data dari form
    $name = $data['name'];
    $email = $data['email'];
    $username = $data['username'];
    $password = $data['password'];
    $konfirmasi_password = $data['konfirmasi_password'];

    // cek username apakah sudah terdaftar
    $sql = "SELECT * FROM pengguna WHERE id_pengguna = $id_pengguna";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($data['password'] !== "") {
        if ($row['username'] !== $username) {
            echo "
                <script>
                    alert('Username telah terdaftar')
                    document.location.href = '" . BASE_URL . $redirect . "'
                </script>";
            exit;
        }
    }

    // ambil password lama
    $password_db = $row['password'];

    // jika password diubah
    if ($password !== "") {
        // cek password konfirmasi
        if ($password !== $konfirmasi_password) {
            echo "
            <script>
                alert('Password konfirmasi tidak sama')
                document.location.href = '" . BASE_URL . $redirect . "'
            </script>";
            exit;
        }

        // enkripsi password
        $password_db = password_hash($password, PASSWORD_DEFAULT);
    }

    // edit data di database
    $sql = "UPDATE pengguna SET 
            nama = '$name', 
            email = '$email', 
            username = '$username', 
            password = '$password_db'
            WHERE id_pengguna = $id_pengguna";

    $conn->query($sql);

    return $conn->affected_rows;
}

function hapusPenggunaById($id_pengguna)
{
    global $conn;
    $sql = "DELETE FROM pengguna WHERE id_pengguna = $id_pengguna";
    $conn->query($sql);
}

function selectPenggunaById($id_pengguna)
{
    global $conn;
    $sql = "SELECT * FROM pengguna WHERE id_pengguna = $id_pengguna";
    return $conn->query($sql)->fetch_assoc();
}

function editProfile($id_pengguna, $data)
{
    global $conn;

    // deklarasi data dari form
    $name = $data['name'];
    $email = $data['email'];
    $username = $data['username'];
    $password_lama = $data['password_lama'];
    $password_baru = $data['password_baru'];
    $konfirmasi_password = $data['konfirmasi_password'];
    $photo_lama = $data['photo_lama'];

    // cek username apakah sudah terdaftar
    $sql = "SELECT * FROM pengguna WHERE id_pengguna = $id_pengguna";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (isset($row['username'])) {
        if ($row['username'] !== $username) {
            echo "
                <script>
                    alert('Username telah terdaftar')
                    document.location.href = '" . BASE_URL . "/profile.php'
                </script>";
            exit;
        }
    }

    // ambil password lama pada database
    $password = $row['password'];

    // jika password diubah
    if ($data['password_baru'] !== "") {
        // cek password lama
        if (password_verify($password_lama, $password)) {
            // cek password konfirmasi
            if ($password_baru !== $konfirmasi_password) {
                echo "
                <script>
                    alert('Password konfirmasi tidak sama')
                    document.location.href = '" . BASE_URL . "/profile.php'
                </script>";
                exit;
            }

            // enkripsi password
            $password = password_hash($password_baru, PASSWORD_DEFAULT);
        } else {
            echo "
                <script>
                    alert('Password anda salah')
                    document.location.href = '" . BASE_URL . "/profile.php'
                </script>";
            exit;
        }
    }

    try {
        $conn->autocommit(false);

        // edit data di database
        $sql = "UPDATE pengguna SET 
                nama = '$name', 
                email = '$email', 
                username = '$username',
                password = '$password'
                WHERE id_pengguna = $id_pengguna";

        $conn->query($sql);

        // cek apakah pengguna adalah guru atau siswa

        if ($_SESSION['role'] === 'guru') {
            // upload gambar baru jika diubah
            editPhotoGuruById($id_pengguna, $_FILES);
        }

        if ($_SESSION['role'] === 'siswa') {
            // upload  gambar baru jika diubah
            editPhotoSiswaById($id_pengguna, $_FILES);
        }

        $record = $conn->affected_rows;

        $conn->commit();
    } catch (Exception $e) {
        echo "
        <script>
            alert('Error: " . $e->getMessage() . "')
        </script>";
    }


    return $record;
}
