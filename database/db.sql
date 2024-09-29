-- DROP DATABASE sistem_sekolah
CREATE DATABASE sistem_sekolah

USE sistem_sekolah

-- Tabel pengguna
CREATE TABLE pengguna (
    id_pengguna INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'guru', 'siswa') NOT NULL
);

-- Table Guru
CREATE TABLE guru (
    id_guru INT PRIMARY KEY AUTO_INCREMENT,
    photo VARCHAR(255) NOT NULL,
    nip VARCHAR(50) NOT NULL,
    nuptk VARCHAR(50) NOT NULL,
    nrg VARCHAR(50),
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    bidang_studi VARCHAR(100) NOT NULL,
    bidang_sertifikasi VARCHAR(100) NOT NULL,
    jabatan VARCHAR(100) NOT NULL,
    tugas_tambahan VARCHAR(100),
    id_pengguna INT UNIQUE NOT NULL,
    FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna)
);

-- Table Kelas
CREATE TABLE kelas (
    id_kelas INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL
);

-- Table Siswa
CREATE TABLE siswa (
    id_siswa INT PRIMARY KEY AUTO_INCREMENT,
    photo VARCHAR(255) NOT NULL,
    nipd VARCHAR(50) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    id_pengguna INT UNIQUE NOT NULL,
    id_kelas INT NOT NULL,
    FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna),
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas)
);

-- Table Ruang Pembelajaran
CREATE TABLE ruang_pembelajaran (
    id_ruang INT PRIMARY KEY AUTO_INCREMENT,
    image VARCHAR(100) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    id_guru INT NOT NULL,
    id_kelas INT NOT NULL,
    FOREIGN KEY (id_guru) REFERENCES guru(id_guru),
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas)
);

-- Table Materi
CREATE TABLE materi (
    id_materi INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(100) NOT NULL,
    tanggal DATE NOT NULL,
    file VARCHAR(255) NOT NULL,
    id_ruang INT NOT NULL,
    FOREIGN KEY (id_ruang) REFERENCES ruang_pembelajaran(id_ruang)
);

-- Table Tugas
CREATE TABLE tugas (
    id_tugas INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(100) NOT NULL,
    deadline DATE NOT NULL,
    jumlah_diserahkan INT NOT NULL,
    jumlah_belum_diserahkan INT NOT NULL,
    file VARCHAR(255) NOT NULL,
    id_ruang INT NOT NULL,
    FOREIGN KEY (id_ruang) REFERENCES ruang_pembelajaran(id_ruang)
);


-- Table Pengumpulan
CREATE TABLE pengumpulan (
    id_pengumpulan INT PRIMARY KEY AUTO_INCREMENT,
    tanggal_kumpul DATE NOT NULL,
    status ENUM('diserahkan', 'belum diserahkan') NOT NULL,
    file VARCHAR(255) NOT NULL,
    nilai INT NOT NULL,
    id_siswa INT, NOT NULL
    id_tugas INT NOT NULL,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa),
    FOREIGN KEY (id_tugas) REFERENCES tugas(id_tugas)
);

-- Table Pemberitahuan
CREATE TABLE pemberitahuan (
    id_pemberitahuan INT PRIMARY KEY AUTO_INCREMENT,
    subjek VARCHAR(100) NOT NULL,
    pesan TEXT NOT NULL,
    waktu TIMESTAMP NOT NULL,
    dibaca BOOLEAN NOT NULL,
    id_siswa INT NOT NULL,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa)
);

SELECT * FROM pengguna

USE sistem_sekolah

desc guru