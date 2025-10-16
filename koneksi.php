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

$koneksi->query($sql);
$koneksi->query($sql2);
$koneksi->query($sql3);
?>