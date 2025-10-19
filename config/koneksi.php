<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_sekolah";

// Koneksi ke MySQL tanpa memilih database dulu
$koneksi = new mysqli($host, $user, $pass);
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Membuat database jika belum ada
$koneksi->query("CREATE DATABASE IF NOT EXISTS `$db`");

// Pilih database
$koneksi->select_db($db);

// Membuat tabel 'siswa' jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(20),
    nama VARCHAR(100),
    kelas VARCHAR(50),
    jurusan VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
)";

// Membuat tabel 'guru' jika belum ada
$sql2 = "CREATE TABLE IF NOT EXISTS guru (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(20),
    nama VARCHAR(100),
    mapel VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
)";

// Membuat tabel 'jurusan' jika belum ada
$sql3 = "CREATE TABLE IF NOT EXISTS jurusan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(10),
    nama_jurusan VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
)";

// Membuat tabel 'mata_pelajaran' jika belum ada
$sql4 = "CREATE TABLE IF NOT EXISTS mata_pelajaran (
    id int AUTO_INCREMENT PRIMARY KEY,
	nama_mapel VARCHAR (50),
	kelas VARCHAR (10),
	guru_pengajar VARCHAR (100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
)";

// Membuat tabel 'ekstrakurikuler' jika belum ada
$sql5 = "CREATE TABLE IF NOT EXISTS ekstrakurikuler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_ekstra VARCHAR(100),
    jadwal VARCHAR(20),
	guru_pengajar VARCHAR (100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
)";

// Membuat tabel 'users' jika belum ada
$sql6 = "CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
)";


$koneksi->query($sql);
$koneksi->query($sql2);
$koneksi->query($sql3);
$koneksi->query($sql4);
$koneksi->query($sql5);
$koneksi->query($sql6);
?>