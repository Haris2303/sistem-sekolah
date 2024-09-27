-- DROP DATABASE sistem_sekolah
CREATE DATABASE sistem_sekolah

USE sistem_sekolah

-- Tabel pengguna
CREATE TABLE pengguna (
    id_pengguna INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100),
    email VARCHAR(100),
    username VARCHAR(50),
    password VARCHAR(255),
    role ENUM('admin', 'guru', 'siswa')
);

-- Table Guru
CREATE TABLE guru (
    id_guru INT PRIMARY KEY AUTO_INCREMENT,
    photo VARCHAR(255),
    nip VARCHAR(50),
    nuptk VARCHAR(50),
    nrg VARCHAR(50),
    jenis_kelamin ENUM('L', 'P'),
    bidang_studi VARCHAR(100),
    bidang_sertifikasi VARCHAR(100),
    jabatan VARCHAR(100),
    tugas_tambahan VARCHAR(100),
    id_pengguna INT UNIQUE,
    FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna)
);

-- Table Kelas
CREATE TABLE kelas (
    id_kelas INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100)
);

-- Table Siswa
CREATE TABLE siswa (
    id_siswa INT PRIMARY KEY AUTO_INCREMENT,
    photo VARCHAR(255),
    nipd VARCHAR(50),
    jenis_kelamin ENUM('L', 'P'),
    id_pengguna INT UNIQUE,
    id_kelas INT,
    FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna),
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas)
);

-- Table Ruang Pembelajaran
CREATE TABLE ruang_pembelajaran (
    id_ruang INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100),
    id_guru INT,
    id_kelas INT,
    FOREIGN KEY (id_guru) REFERENCES guru(id_guru),
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas)
);

-- Table Materi
CREATE TABLE materi (
    id_materi INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(100),
    tanggal DATE,
    file VARCHAR(255),
    id_ruang INT,
    FOREIGN KEY (id_ruang) REFERENCES ruang_pembelajaran(id_ruang)
);

-- Table Tugas
CREATE TABLE tugas (
    id_tugas INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(100),
    deadline DATE,
    jumlah_diserahkan INT,
    jumlah_belum_diserahkan INT,
    file VARCHAR(255),
    id_ruang INT,
    FOREIGN KEY (id_ruang) REFERENCES ruang_pembelajaran(id_ruang)
);

-- Table Pengumpulan
CREATE TABLE pengumpulan (
    id_pengumpulan INT PRIMARY KEY AUTO_INCREMENT,
    tanggal_kumpul DATE,
    status ENUM('diserahkan', 'belum diserahkan'),
    file VARCHAR(255),
    nilai INT,
    id_siswa INT,
    id_tugas INT,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa),
    FOREIGN KEY (id_tugas) REFERENCES tugas(id_tugas)
);

-- Table Pemberitahuan
CREATE TABLE pemberitahuan (
    id_pemberitahuan INT PRIMARY KEY AUTO_INCREMENT,
    subjek VARCHAR(100),
    pesan TEXT,
    waktu TIMESTAMP,
    dibaca BOOLEAN,
    id_siswa INT,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa)
);

SELECT * FROM pengguna