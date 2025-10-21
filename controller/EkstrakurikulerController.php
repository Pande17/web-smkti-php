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
        $stmt = $this->koneksi->prepare("INSERT INTO ekstrakurikuler (nama_ekskul, pembina, hari, waktu) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['nama_ekskul'], $data['pembina'], $data['hari'], $data['waktu']);
        
        if($stmt->execute()) {
            echo "<script>alert('Data berhasil ditambahkan!');window.location='index.php';</script>";
            return true;
        }
        return false;
    }

    public function updateEkstrakurikuler($id, $data) {
        $stmt = $this->koneksi->prepare("UPDATE ekstrakurikuler SET nama_ekskul = ?, pembina = ?, hari = ?, waktu = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $data['nama_ekskul'], $data['pembina'], $data['hari'], $data['waktu'], $id);
        
        if($stmt->execute()) {
            echo "<script>alert('Data berhasil diupdate');window.location='index.php';</script>";
            return true;
        }
        return false;
    }

    public function hapusEkstrakurikuler($id) {
        $stmt = $this->koneksi->prepare("UPDATE ekstrakurikuler SET deleted_at = NOW(), updated_at = updated_at WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()) {
            echo "<script>alert('Data berhasil dihapus');window.location='index.php';</script>";
            return true;
        }
        return false;
    }
}