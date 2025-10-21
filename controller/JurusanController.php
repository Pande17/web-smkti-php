<?php
class JurusanController {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    // ambil semua data jurusan yang belum dihapus
    public function getAllJurusan() {
        return mysqli_query($this->koneksi, "SELECT * FROM jurusan WHERE deleted_at IS NULL ORDER BY id ASC");
    }

    // ambil data jurusan berdasarkan id
    public function getJurusanById($id) {
        $stmt = $this->koneksi->prepare("SELECT * FROM jurusan WHERE id = ? AND deleted_at IS NULL");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // tambah data jurusan
    public function createJurusan($data) {
        $stmt = $this->koneksi->prepare("INSERT INTO jurusan (kode, nama_jurusan) VALUES (?, ?)");
        $stmt->bind_param("ss", $data['kode'], $data['nama_jurusan']);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data Jurusan berhasil ditambahkan!';
            header('Location: index.php');
            exit;
        }
        return false;
    }

    // update data jurusan
    public function updateJurusan($id, $data) {
        $stmt = $this->koneksi->prepare("UPDATE jurusan SET kode = ?, nama_jurusan = ? WHERE id = ?");
        $stmt->bind_param("ssi", $data['kode'], $data['nama_jurusan'], $id);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data Jurusan berhasil diupdate!';
            header('Location: index.php');
            exit;
        }
        return false;
    }

    // hapus data jurusan (soft delete)
    public function hapusJurusan($id) {
        $stmt = $this->koneksi->prepare("UPDATE Jurusan SET deleted_at = NOW(), updated_at = updated_at WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data Jurusan berhasil dihapus!';
            header('Location: index.php');
            exit;
        }
        return false;
    }
}