<?php

// Include library FPDF
require('vendor/fpdf186/fpdf.php');

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

function laporan($title, $data, $user)
{
  // Buat instance FPDF
  if ($user === 'guru') {
    $pdf = new FPDF('L');
  } else {
    $pdf = new FPDF('P');
  }
  $pdf->AddPage();

  // Set font untuk judul
  $pdf->SetFont('Arial', 'B', 10);

  // Tambahkan judul di atas tabel
  $pdf->Cell(0, 10, $title, 0, 1, 'C');
  $pdf->Ln(5); // Spasi kosong antara judul dan tabel

  // Header tabel
  if ($user === 'guru') {
    // Set font untuk header
    $pdf->SetFont('Arial', 'B', 8);

    $pdf->Cell(8, 10, 'No', 1);
    $pdf->Cell(50, 10, 'Nama', 1);
    $pdf->Cell(30, 10, 'NIP', 1);
    $pdf->Cell(40, 10, 'NUPTK/NRG', 1);
    $pdf->Cell(40, 10, 'Bidang Studi', 1);
    $pdf->Cell(40, 10, 'Bidang Sertifikasi', 1);
    $pdf->Cell(40, 10, 'Jabatan Guru', 1);
    $pdf->Cell(30, 10, 'Tugas Tambahan', 1);
    $pdf->Ln();

    // Set font untuk isi tabel
    $pdf->SetFont('Arial', '', 8);

    $i = 1;
    // Isi tabel
    foreach ($data as $row) {
      $pdf->Cell(8, 10, $i++, 1);
      $pdf->Cell(50, 10, $row['nama'], 1);
      $pdf->Cell(30, 10, $row['nip'], 1);
      $pdf->Cell(40, 10, $row['nuptk'] . "/" . $row['nrg'], 1);
      $pdf->Cell(40, 10, $row['bidang_studi'], 1);
      $pdf->Cell(40, 10, $row['bidang_sertifikasi'], 1);
      $pdf->Cell(40, 10, $row['jabatan'], 1);
      $pdf->Cell(30, 10, $row['tugas_tambahan'], 1);
      $pdf->Ln();
    }
  }

  if ($user === 'siswa') {
    // Set font untuk header
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->Cell(8, 10, 'No', 1);
    $pdf->Cell(60, 10, 'Nama', 1);
    $pdf->Cell(50, 10, 'NIPD', 1);
    $pdf->Cell(30, 10, 'Jenis Kelamin', 1);
    $pdf->Cell(40, 10, 'Kelas', 1);
    $pdf->Ln();

    // Set font untuk isi tabel
    $pdf->SetFont('Arial', '', 10);

    $i = 1;
    // Isi tabel
    foreach ($data as $row) {
      $pdf->Cell(8, 10, $i++, 1);
      $pdf->Cell(60, 10, $row['nama'], 1);
      $pdf->Cell(50, 10, $row['nipd'], 1);
      $pdf->Cell(30, 10, $row['jenis_kelamin'], 1, align: 'C');
      $pdf->Cell(40, 10, $row['nama_kelas'], 1);
      $pdf->Ln();
    }
  }


  // Output file PDF
  $pdf->Output();
}
