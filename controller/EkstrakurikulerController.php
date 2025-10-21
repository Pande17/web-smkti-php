<?php
class EkstrakurikulerController {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function getAllEkstrakurikuler() {
        return mysqli_query($this->koneksi, "SELECT * FROM ekstrakurikuler WHERE deleted_at IS NULL ORDER BY id ASC");
    }

    public function getEkstrakurikulerById($id) {
        $stmt = $this->koneksi->prepare("SELECT * FROM ekstrakurikuler WHERE id = ? AND deleted_at IS NULL");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createEkstrakurikuler($data) {
        $stmt = $this->koneksi->prepare("INSERT INTO ekstrakurikuler (nama_ekstra, jadwal, guru_pengajar) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['nama_ekstra'], $data['jadwal'], $data['guru_pengajar']);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data Ekstrakurikuler berhasil ditambahkan!';
            header('Location: index.php');
            exit;
        }
        return false;
    }

    public function updateEkstrakurikuler($id, $data) {
        $stmt = $this->koneksi->prepare("UPDATE ekstrakurikuler SET nama_ekstra = ?, jadwal = ?, guru_pengajar = ? WHERE id = ?");
        $stmt->bind_param("sssi", $data['nama_ekstra'], $data['jadwal'], $data['guru_pengajar'], $id);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data Ekstrakurikuler berhasil diupdate!';
            header('Location: index.php');
            exit;
        }
        return false;
    }

    public function hapusEkstrakurikuler($id) {
        $stmt = $this->koneksi->prepare("UPDATE ekstrakurikuler SET deleted_at = NOW(), updated_at = updated_at WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data Ekstrakurikuler berhasil dihapus!';
            header('Location: index.php');
            exit;
        }
        return false;
    }
}