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
        $stmt = $this->koneksi->prepare("INSERT INTO mata_pelajaran (kode, nama_mapel, kelas) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['kode'], $data['nama_mapel'], $data['kelas']);
        
        if($stmt->execute()) {
            echo "<script>alert('Data berhasil ditambahkan!');window.location='index.php';</script>";
            return true;
        }
        return false;
    }

    public function updateMapel($id, $data) {
        $stmt = $this->koneksi->prepare("UPDATE mata_pelajaran SET kode = ?, nama_mapel = ?, kelas = ? WHERE id = ?");
        $stmt->bind_param("sssi", $data['kode'], $data['nama_mapel'], $data['kelas'], $id);
        
        if($stmt->execute()) {
            echo "<script>alert('Data berhasil diupdate');window.location='index.php';</script>";
            return true;
        }
        return false;
    }

    public function hapusMapel($id) {
        $stmt = $this->koneksi->prepare("UPDATE mata_pelajaran SET deleted_at = NOW(), updated_at = updated_at WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()) {
            echo "<script>alert('Data berhasil dihapus');window.location='index.php';</script>";
            return true;
        }
        return false;
    }
}