<?php

$bidang = ['Ekonomi', 'Bahasa Indonesia'];
$jabatan = ['Guru Muda / Pembina', 'Guru Muda / Penata Tingkat 1', 'Guru Ahli Muda / Penata Tingkat 1', 'Guru Muda / Penata Tingkat 1'];
$tugas_tambahan = ['Kepala Sekolah', 'Kepala Perpustakaan', 'Wakasek Humas', 'Wakasek Sarpras'];

function upload($folderName)
{
  // ambil data files
  $namaFile = $_FILES['photo']['name'];
  $ukuranFile = $_FILES['photo']['size'];
  $errorFile = $_FILES['photo']['error'];
  $tmpName = $_FILES['photo']['tmp_name'];

  // cek apakah tidak ada gambar yang di upload
  if ($errorFile === 4) {
    echo "<script>
        alert('Anda tidak memasukkan gambar,
        Silahkan masukkan!');
      </script>";
    return false;
  }

  // cek apakah yg diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
        alert('Yang anda upload bukan gambar, 
        Silahkan masukkan gambar (jpg/jpeg/png)!');
      </script>";
    return false;
  }

  // cek ukuran dari gambar yang diupload
  if ($ukuranFile > 1000000) {
    echo "<script>
        alert('Ukuran gambar terlalu besar, Silahkan masukkan!');
      </script>";
    return false;
  }

  // generate nama file baru, gambar siap di upload
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, __DIR__ . '/../img/' . $folderName . '/' . $namaFileBaru);

  return $namaFileBaru;
}

function uploadFilePDF($folderName)
{
  // ambil data files
  $namaFile = $_FILES['file']['name'];
  $ukuranFile = $_FILES['file']['size'];
  $errorFile = $_FILES['file']['error'];
  $tmpName = $_FILES['file']['tmp_name'];

  // cek apakah tidak ada file yang di upload
  if ($errorFile === 4) {
    echo "<script>
        alert('Anda tidak memasukkan file,
        Silahkan masukkan!');
      </script>";
    return false;
  }

  // cek apakah yg diupload adalah file pdf
  $ekstensiGambarValid = ['pdf'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
        alert('Yang anda upload bukan file pdf,
        Silahkan masukkan file berbentuk PDF!');
      </script>";
    return false;
  }

  // cek ukuran dari file yang diupload
  if ($ukuranFile > 5000000) {
    echo "<script>
        alert('Ukuran file terlalu besar, Silahkan masukkan kurang dari 5mb!');
      </script>";
    return false;
  }

  // generate nama file baru, gambar siap di upload
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, __DIR__ . '/../file/' . $folderName . '/' . $namaFileBaru);

  return $namaFileBaru;
}
