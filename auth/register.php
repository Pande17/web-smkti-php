<?php
require_once "../config/koneksi.php";
require_once "../controller/UserController.php";

session_start();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Semua field harus diisi';
    } else {
        $userController = new UserController($koneksi);
        if ($userController->register($username, $password)) {
            $success = 'Registrasi berhasil! Silakan login.';
        } else {
            $error = 'Username sudah digunakan';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Data Sekolah</title>
    <!-- Gunakan style yang sama dengan index.php -->
</head>
<body>
    <div class="wrap">
        <main class="card">
            <h1>Register</h1>
            <?php if($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if($success): ?>
                <div class="success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>
                <button class="btn" type="submit">Register</button>
            </form>
            <p>Sudah punya akun? <a href="../index.php">Login</a></p>
        </main>
    </div>
</body>
</html>