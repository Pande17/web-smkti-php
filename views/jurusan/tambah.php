<?php include '../../config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Guru - SMK TI Bali Global Denpasar</title>
    <link rel="stylesheet" href="../../style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="with-sidebar">
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-school" style="color: #ffff;"></i>
            </div>
            <h1>Data Sekolah</h1>
        </div>

        <nav class="sidebar-nav">
            <a href="../../dashboard.php" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="../siswa/" class="nav-item">
                <i class="fas fa-user-graduate"></i>
                <span>Data Siswa</span>
            </a>
            <a href="../guru/" class="nav-item ">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Data Guru</span>
            </a>
            <a href="." class="nav-item active">
                <i class="fas fa-book"></i>
                <span>Data Jurusan</span>
            </a>
            <a href="views/mata_pelajaran/" class="nav-item">
                <i class="fas fa-book-open"></i>
                <span>Data Mata Pelajaran</span>
            </a>
            <a href="views/ekstrakurikuler/" class="nav-item">
                <i class="fas fa-running"></i>
                <span>Data Ekstrakurikuler</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <span><?php htmlspecialchars($_SESSION['username']) ?></span>
            </div>
            <a href="auth/logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
<h2>Tambah Data Jurusan</h2>
<main class="content">
    <header class="content-header">
        <button class="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <h2>Tambah Data Guru</h2>
    </header>
    <form method="post">
        <table>
            <tr><td>Kode Jurusan</td><td><input type="text" name="kode" required></td></tr>
            <tr><td>Nama Jurusan</td><td><input type="text" name="nama_jurusan" required></td></tr>
            <tr><td colspan="2"><button type="submit" name="simpan">Simpan</button></td></tr>
        </table>
    </form>
</main>

<?php
if(isset($_POST['simpan'])){
    mysqli_query($koneksi, "INSERT INTO jurusan (kode,nama_jurusan)
    VALUES ('$_POST[kode]','$_POST[nama_jurusan]')");
    echo "<script>alert('Data jurusan berhasil disimpan');window.location='index.php';</script>";
}
?>
</body>
</html>
