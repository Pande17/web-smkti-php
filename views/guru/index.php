<?php
    include '../../config/koneksi.php';
    require_once '../../controller/GuruController.php';
    require_once __DIR__ . '/../../auth/check_auth.php';

    $guruController = new GuruController($koneksi);

    // Handle soft delete action
    if(isset($_GET['hapus'])) {
        $guruController->hapusGuru($_GET['hapus']);
        exit;
    }
?>

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
            <a href="../guru/" class="nav-item active">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Data Guru</span>
            </a>
            <a href="../jurusan/" class="nav-item">
                <i class="fas fa-book"></i>
                <span>Data Jurusan</span>
            </a>
            <a href="../mata_pelajaran/" class="nav-item">
                <i class="fas fa-book-open"></i>
                <span>Data Mata Pelajaran</span>
            </a>
            <a href="../ekstrakurikuler/" class="nav-item">
                <i class="fas fa-running"></i>
                <span>Data Ekstrakurikuler</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <span><?= htmlspecialchars($_SESSION['username']) ?></span>
            </div>
            <a href="../../auth/logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <main class="content">
        <div class="content-header">
            <h2>Data Guru</h2>
            <br>
            <a href="tambah.php" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <span>Tambah Guru</span>
            </a>
        </div>
        <?php
            // include flash reusable
            require_once __DIR__ . '/../../includes/flash.php';
        ?>
        <table>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Mata Pelajaran</th>
            <th>Aksi</th>
        </tr>
        <?php
            $no = 1;
            $data = $guruController->getAllGuru();
            while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['nip']; ?></td>
            <td><?= $d['nama']; ?></td>
            <td><?= $d['mapel']; ?></td>
            <td>
                <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-primary">Edit</a>
                <a href="index.php?hapus=<?= $d['id']; ?>" class="btn btn-danger" 
                   onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
        </table>
    </main>
</body>
</html>