<?php
    include '../../config/koneksi.php'; 
    session_start(); 

    // soft delete
    if(isset($_GET['hapus'])) {
        $id = intval($_GET['hapus']);
        $timestamp = date('Y-m-d H:i:s');
        $stmt = $koneksi->prepare("UPDATE siswa SET deleted_at = ? WHERE id = ?");
        $stmt->bind_param("si", $timestamp, $id);
        if($stmt->execute()) {
            $_SESSION['message'] = "Data Berhasil Dihapus!";
            header("Location: index.php");
            exit;
        }
        $stmt->close();
    }

    // Ambil data siswa yang belum dihapus (deleted_at IS NULL)
    // $result = $koneksi->query("SELECT * FROM siswa WHERE deleted_at IS NULL ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa - SMK TI Bali Global Denpasar</title>
    <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
<header><h2>Data Siswa</h2></header>

<?php if(isset($_SESSION['message'])): ?>
    <div id="notification" class="popup-container">
        <div class="popup-notification">
            <div class="success-icon">✓</div>
            <?= $_SESSION['message']; ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('notification');
            
            // Show notification
            notification.classList.add('show');
            
            // Hide notification after 3 seconds
            setTimeout(function() {
                notification.classList.remove('show');
                // Remove element after animation
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        });
    </script>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<nav>
    <a href="../../index.php">Home</a>
    <a href="tambah.php" class="btn">Tambah Siswa</a>
</nav>

<table>
<tr>
    <th>No</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Kelas</th>
    <th>Jurusan</th>
    <th>Aksi</th>
</tr>
<?php
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE deleted_at IS NULL ORDER BY id ASC");
    while($d = mysqli_fetch_array($data)){
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['nis']; ?></td>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['kelas']; ?></td>
    <td><?= $d['jurusan']; ?></td>
    <td>
        <a href="edit.php?id=<?= $d['id']; ?>" class="btn">Edit</a>
        <a href="index.php?hapus=<?= $d['id']; ?>" class="btn" style="background:red; "onclick="return confirm('Yakin hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
</body>
</html>
