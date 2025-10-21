<?php
    include "config/koneksi.php";
    include "controller/UserController.php";
    session_start();

    $error = '';
    $old = ['username' => ''];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $old['username'] = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if ($old['username'] === '' || $password === '') {
            $error = 'Username dan password harus diisi.';
        } else {
            $userController = new UserController($koneksi);
            if ($userController->login($old['username'], $password)) {
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Username atau password salah.';
            }
        }
    }

?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Login - Data Sekolah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrap">
        <main class="card" role="main" aria-labelledby="login-title">
            <div class="brand">
                <div>
                    <h1 id="login-title">Masuk ke Data Sekolah</h1>
                    <p class="lead">Masukkan username dan password Anda untuk melanjutkan</p>
                </div>
            </div>

            <?php if($error): ?>
                <div class="error" role="alert"><?=htmlspecialchars($error)?></div>
            <?php endif; ?>

            <form method="post" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" autocomplete="off" novalidate>
                <div class="field">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" value="<?=htmlspecialchars($old['username'])?>" placeholder="username" required />
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Password" required />
                </div>

                <div class="actions">
                    <a class="muted-link" href="#">Lupa password?</a>
                    <button class="btn" type="submit">Masuk</button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>