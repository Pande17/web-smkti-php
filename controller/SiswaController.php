<?php
class SiswaController {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function getAllSiswa() {
        return mysqli_query($this->koneksi, "SELECT * FROM siswa WHERE deleted_at IS NULL ORDER BY id ASC");
    }

    public function getSiswaById($id) {
        $stmt = $this->koneksi->prepare("SELECT * FROM siswa WHERE id = ? AND deleted_at IS NULL");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createSiswa($data) {
        $stmt = $this->koneksi->prepare("INSERT INTO siswa (nis, nama, kelas, jurusan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['nis'], $data['nama'], $data['kelas'], $data['jurusan']);
        
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data berhasil ditambahkan!';
            header('Location: index.php');
            exit;
        }
        return false;
    }

    public function updateSiswa($id, $data) {
        // jika kebetulan diteruskan mysqli_result, ubah ke array
        if ($data instanceof mysqli_result) {
            $data = $data->fetch_assoc();
        }

        if (!is_array($data)) {
            throw new InvalidArgumentException('updateSiswa expects array $data');
        }

        $stmt = $this->koneksi->prepare("UPDATE siswa SET nis = ?, nama = ?, kelas = ?, jurusan = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $data['nis'], $data['nama'], $data['kelas'], $data['jurusan'], $id);
        if ($stmt->execute()) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['flash_message'] = 'Data berhasil diupdate!';
            header('Location: index.php');
            exit;
        }
        return false;
    }

    public function hapusSiswa($id) {
        $timestamp = date('Y-m-d H:i:s');
        $stmt = $this->koneksi->prepare("UPDATE siswa SET deleted_at = NOW(), updated_at = updated_at WHERE id = ?");
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