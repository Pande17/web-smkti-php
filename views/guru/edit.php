<?php
    include '../../config/koneksi.php';
    require_once '../../controller/GuruController.php';
    session_start();

    $guruController = new GuruController($koneksi);

    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $data = [
            'nip' => $_POST['nip'],
            'nama' => $_POST['nama'],
            'mapel' => $_POST['mapel']
        ];

        if($guruController->updateGuru($id, $data)) {
            exit;
        }
    }

    // Get guru data
    $id = $_GET['id'];
    $guru = $guruController->getGuruById($id);
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
            <h2>Edit Data Guru</h2>
        </header>
        <div class="content-body">
            <form method="post">
                <input type="hidden" name="id" value="<?= $guru['id']; ?>">

                <label>NIP:</label>
                <input type="text" name="nip" value="<?= $guru['nip']; ?>" required>

                <label>Nama:</label>
                <input type="text" name="nama" value="<?= $guru['nama']; ?>" required>

                <label>Mata Pelajaran:</label>
                <input type="text" name="mapel" value="<?= $guru['mapel']; ?>" required>

                <input type="submit" name="update" value="Update Data">
            </form>
        </div>
    </main>
</body>
</html>