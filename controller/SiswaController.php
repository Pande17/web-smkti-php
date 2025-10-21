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
        $stmt = $this->koneksi->prepare("INSERT INTO siswa (nis, nama, kelas, jurusan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['nis'], $data['nama'], $data['kelas'], $data['jurusan']);
        
        if($stmt->execute()) {
            echo "<script>alert('Data berhasil ditambahkan!');window.location='index.php';</script>";
            return true;
        }
        return false;
    }

    public function updateSiswa($id, $data) {
        $stmt = $this->koneksi->prepare("UPDATE siswa SET nis = ?, nama = ?, kelas = ?, jurusan = ? WHERE id = ?");
        $stmt->bind_param("sssi", $data['nis'], $data['nama'], $data['kelas'], $data['jurusan'], $id);
        
        if($stmt->execute()) {
            echo "<script>alert('Data berhasil diupdate');window.location='index.php';</script>";
            return true;
        }
        return false;
    }

    public function hapusSiswa($id) {
        $stmt = $this->koneksi->prepare("UPDATE siswa SET deleted_at = NOW(), updated_at = updated_at WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()) {
            echo "<script>alert('Data berhasil dihapus');window.location='index.php';</script>";
            return true;
        }
        return false;
    }
}