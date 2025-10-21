<?php
class MataPelajaranController {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function getAllMapel() {
        return mysqli_query($this->koneksi, "SELECT * FROM mata_pelajaran WHERE deleted_at IS NULL ORDER BY id ASC");
    }

    public function getMapelById($id) {
        $stmt = $this->koneksi->prepare("SELECT * FROM mata_pelajaran WHERE id = ? AND deleted_at IS NULL");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createMapel($data) {
        $stmt = $this->koneksi->prepare("INSERT INTO mata_pelajaran (nama_mapel, kelas, guru_pengajar) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['nama_mapel'], $data['kelas'], $data['guru_pengajar']);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data Mata Pelajaran berhasil ditambahkan!';
            header('Location: index.php');
            exit;
        }
        return false;
    }

    public function updateMapel($id, $data) {
        $stmt = $this->koneksi->prepare("UPDATE mata_pelajaran SET nama_mapel = ?, kelas = ?, guru_pengajar = ? WHERE id = ?");
        $stmt->bind_param("sssi", $data['nama_mapel'], $data['kelas'], $data['guru_pengajar'], $id);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data Mata Pelajaran berhasil diupdate!';
            header('Location: index.php');
            exit;
        }
        return false;
    }

    public function hapusMapel($id) {
        $stmt = $this->koneksi->prepare("UPDATE mata_pelajaran SET deleted_at = NOW(), updated_at = updated_at WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data Mata Pelajaran berhasil dihapus!';
            header('Location: index.php');
            exit;
        }
        return false;
    }
}