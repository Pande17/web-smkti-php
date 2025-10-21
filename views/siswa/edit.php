<?php 
    include '../../config/koneksi.php';
    require_once '../../controller/SiswaController.php';
    require_once __DIR__ . '/../../auth/check_auth.php';

    $siswaController = new SiswaController($koneksi);
        
    // Load existing record
    $id = intval($_GET['id'] ?? 0);
    if ($id <= 0) {
        // jika id tidak valid, kembali ke index
        header('Location: index.php');
        exit;
    }
    
    $siswa = $siswaController->getSiswaById($id);
    if (!$siswa) {
        // record tidak ditemukan
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['flash_message'] = 'Data tidak ditemukan.';
        header('Location: index.php');
        exit;
    }

    // Handle update submission
    if (isset($_POST['update'])) {
        $id = intval($_POST['id'] ?? 0);
        $data = [
            'nis'     => trim($_POST['nis'] ?? ''),
            'nama'    => trim($_POST['nama'] ?? ''),
            'kelas'   => trim($_POST['kelas'] ?? ''),
            'jurusan' => trim($_POST['jurusan'] ?? ''),
        ];
    
        $siswaController->updateSiswa($id, $data);
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
            <a href="../siswa/" class="nav-item active">
                <i class="fas fa-user-graduate"></i>
                <span>Data Siswa</span>
            </a>
            <a href="../guru/" class="nav-item ">
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
        <header class="content-header">
            <button class="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <h2>Edit Data Siswa</h2>
        </header>
        <div class="content-body">
            <form method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($siswa['id']) ?>">

                <div class="form-group">
                    <label>NIS</label>
                    <input type="text" name="nis" value="<?= htmlspecialchars($siswa['nis'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($siswa['nama'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" value="<?= htmlspecialchars($siswa['kelas'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Jurusan</label>
                    <input type="text" name="jurusan" value="<?= htmlspecialchars($siswa['jurusan'] ?? '') ?>" required>
                </div>

                <div class="form-actions">
                    <div class="button-group">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </div>
                 </div>
            </form>
        </div>
    </main>
</body>
</html>
