<?php
    include '../../config/koneksi.php';
    require_once '../../controller/MataPelajaranController.php';
    require_once __DIR__ . '/../../auth/check_auth.php';

    $mapelController = new MataPelajaranController($koneksi);
    
    if(isset($_POST['simpan'])){
        $data = [
            'nama_mapel'     => trim($_POST['nama_mapel'] ?? ''),
            'kelas'          => trim($_POST['kelas'] ?? ''),
            'guru_pengajar'  => trim($_POST['guru_pengajar'] ?? '')
        ];
    
        if($mapelController->createMapel($data)) {
            exit;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Pelajaran - SMK TI Bali Global Denpasar</title>
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
            <a href="../guru/" class="nav-item">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Data Guru</span>
            </a>
            <a href="../jurusan/" class="nav-item">
                <i class="fas fa-book"></i>
                <span>Data Jurusan</span>
            </a>
            <a href="../mata_pelajaran/" class="nav-item active">
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
        <header class="content-header">
            <button class="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <h2>Edit Data Mata Pelajaran</h2>
        </header>
        <div class="content-body">
            <form method="post">
                <div class="form-group">
                    <label>Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mapel" required>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" required>
                </div>
                <div class="form-group">
                    <label>Guru Pengajar</label>
                    <input type="text" name="guru_pengajar" required>
                </div>
                <div class="form-actions">
                    <div class="button-group">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <?php require_once __DIR__ . '../../../includes/scripts.php'; ?>
</body>
</html>