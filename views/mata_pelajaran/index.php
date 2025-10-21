<?php
    include '../../config/koneksi.php';
    require_once '../../controller/MataPelajaranController.php';
    session_start();

    $mapelController = new MataPelajaranController($koneksi);

    if(isset($_GET['hapus'])) {
        $mapelController->hapusMapel($_GET['hapus']);
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Pelajaran - SMK TI Bali Global Denpasar</title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="with-sidebar">
    <div class="sidebar-overlay"></div>
    
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
            <a href="./index.php" class="nav-item active">
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
            <button class="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <h2>Data Mata Pelajaran</h2>
            <a href="tambah.php" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <span>Tambah Mata Pelajaran</span>
            </a>
        </div>

        <div class="table-responsive">
            <table>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
                <?php
                    $no = 1;
                    $data = $mapelController->getAllMapel();
                    while($d = mysqli_fetch_array($data)){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($d['kode']); ?></td>
                    <td><?= htmlspecialchars($d['nama_mapel']); ?></td>
                    <td><?= htmlspecialchars($d['kelas']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?hapus=<?= $d['id']; ?>" class="btn btn-danger" 
                           onclick="return confirm('Yakin hapus data?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </main>

    <script>
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        const toggleBtn = document.querySelector('.sidebar-toggle');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
</body>
</html>