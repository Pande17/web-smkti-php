<?php
class GuruController {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    // ambil semua data guru yang belum dihapus
    public function getAllGuru() {
        return mysqli_query($this->koneksi, "SELECT * FROM guru WHERE deleted_at IS NULL ORDER BY id ASC");
    }

    // ambil data guru berdasarkan id
    public function getGuruById($id) {
        $stmt = $this->koneksi->prepare("SELECT * FROM guru WHERE id = ? AND deleted_at IS NULL");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // tambah data guru
    public function createGuru($data) {
        $stmt = $this->koneksi->prepare("INSERT INTO guru (nip, nama, mapel) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['nip'], $data['nama'], $data['mapel']);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data berhasil ditambahkan!';
            header('Location: index.php');
            exit;
        }
        return false;
    }

    // update data guru
    public function updateGuru($id, $data) {
        $stmt = $this->koneksi->prepare("UPDATE guru SET nip = ?, nama = ?, mapel = ? WHERE id = ?");
        $stmt->bind_param("sssi", $data['nip'], $data['nama'], $data['mapel'], $id);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data berhasil diupdate!';
            header('Location: index.php');
            exit;
        }
        return false;
    }

    // hapus data guru (soft delete)
    public function hapusGuru($id) {
        $timestamp = date('Y-m-d H:i:s');
        $stmt = $this->koneksi->prepare("UPDATE guru SET deleted_at = NOW(), updated_at = updated_at WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data berhasil dihapus!';
            header('Location: index.php');
            exit;
        }
        return false;
    }
}