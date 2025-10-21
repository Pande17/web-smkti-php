<?php
    include 'config/koneksi.php'; 
    require_once 'controller/SiswaController.php';
    require_once 'auth/check_auth.php';
    
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    // hitung jumlah record tiap tabel untuk card statistik di dashboard 
    $counts = [
        'siswa' => 0,
        'guru' => 0,
        'jurusan' => 0,
        'mata_pelajaran' => 0,
        'ekstrakurikuler' => 0,
        'users' => 0
    ];

    $tables = array_keys($counts);
    foreach ($tables as $t) {
        $sql = "SELECT COUNT(*) AS c FROM {$t} WHERE deleted_at IS NULL";
        // users mungkin tidak punya deleted_at column — tangani fallback
        if ($t === 'users') {
            $sql = "SELECT COUNT(*) AS c FROM users";
        }
        $res = $koneksi->query($sql);
        if ($res) {
            $row = $res->fetch_assoc();
            $counts[$t] = isset($row['c']) ? (int)$row['c'] : 0;
            $res->free();
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Sekolah | SMK TI BALI GLOBAL DENPASAR</title>
    <link rel="stylesheet" href="style.css">
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
            <a href="dashboard.php" class="nav-item active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="views/siswa/" class="nav-item">
                <i class="fas fa-user-graduate"></i>
                <span>Data Siswa</span>
            </a>
            <a href="views/guru/" class="nav-item">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Data Guru</span>
            </a>
            <a href="views/jurusan/" class="nav-item">
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
                <span><?= htmlspecialchars($_SESSION['username']) ?></span>
            </div>
            <a href="auth/logout.php" class="logout-btn">
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
            <h2>Dashboard</h2>
        </header>
        
        <div class="content-body">
            <h3>Selamat Datang di Sistem Informasi Sekolah</h3>

            <!-- Statistik cards grid -->
            <div class="stats-grid" role="list">
                <a href="views/siswa/" class="stat-link">
                <div class="stat-card" role="listitem">
                    <div class="stat-icon bg-blue"><i class="fas fa-user-graduate"></i></div>
                    <div class="stat-body">
                        <div class="stat-title">Siswa</div>
                        <div class="stat-number"><?= number_format($counts['siswa']); ?></div>
                    </div>
                </div>
                </a>

                <a href="views/guru/" class="stat-link">
                <div class="stat-card" role="listitem">
                    <div class="stat-icon bg-indigo"><i class="fas fa-chalkboard-teacher"></i></div>
                    <div class="stat-body">
                        <div class="stat-title">Guru</div>
                        <div class="stat-number"><?= number_format($counts['guru']); ?></div>
                    </div>
                </div>
                </a>

                <a href="views/jurusan" class="stat-link">
                <div class="stat-card" role="listitem">
                    <div class="stat-icon bg-teal"><i class="fas fa-book"></i></div>
                    <div class="stat-body">
                        <div class="stat-title">Jurusan</div>
                        <div class="stat-number"><?= number_format($counts['jurusan']); ?></div>
                    </div>
                </div>
                </a>

                <a href="views/mata_pelajaran" class="stat-link">
                <div class="stat-card" role="listitem">
                    <div class="stat-icon bg-cyan"><i class="fas fa-book-open"></i></div>
                    <div class="stat-body">
                        <div class="stat-title">Mata Pelajaran</div>
                        <div class="stat-number"><?= number_format($counts['mata_pelajaran']); ?></div>
                    </div>
                </div>
                </a>

                <a href="views/ekstrakurikuler" class="stat-link">
                <div class="stat-card" role="listitem">
                    <div class="stat-icon bg-emerald"><i class="fas fa-running"></i></div>
                    <div class="stat-body">
                        <div class="stat-title">Ekstrakurikuler</div>
                        <div class="stat-number"><?= number_format($counts['ekstrakurikuler']); ?></div>
                    </div>
                </div>
                </a>
            </div>
            <!-- end stats -->

        </div>
    </main>
    <?php require_once __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>