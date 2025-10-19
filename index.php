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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg1:#0f172a;
            --bg2:#0b1220;
            --card:#0b1228aa;
            --glass: rgba(255,255,255,0.06);
            --accent:#6ee7b7;
            --muted:#9aa4b2;
            --radius:14px;
        }
        *{box-sizing:border-box;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;}
        html,body{height:100%;margin:0;background:linear-gradient(135deg,var(--bg1),var(--bg2));color:#e6eef6;}
        .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:32px;}
        .card{
            width:100%;
            max-width:420px;
            background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));
            border-radius:var(--radius);
            padding:28px;
            box-shadow: 0 10px 30px rgba(2,6,23,0.6), inset 0 1px 0 rgba(255,255,255,0.02);
            border: 1px solid rgba(255,255,255,0.04);
            backdrop-filter: blur(6px);
        }
        .brand{
            display:flex;gap:12px;align-items:center;margin-bottom:18px;
        }
        .logo{
            width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,var(--accent),#60a5fa);display:flex;align-items:center;justify-content:center;font-weight:700;color:#042028;
            box-shadow:0 6px 18px rgba(99,102,241,0.12);
        }
        h1{font-size:20px;margin:0;color:#f8fafc}
        p.lead{margin:4px 0 18px;color:var(--muted);font-size:13px}
        form .field{margin-bottom:12px}
        label{display:block;font-size:12px;color:var(--muted);margin-bottom:6px}
        input[type="text"],input[type="password"]{
            width:100%;padding:12px 14px;border-radius:10px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:inherit;
            outline:none;font-size:14px;transition:box-shadow .15s, border-color .15s;
        }
        input:focus{box-shadow:0 6px 18px rgba(2,6,23,0.6);border-color:rgba(99,102,241,0.25)}
        .actions{display:flex;align-items:center;justify-content:space-between;margin-top:6px}
        .btn{
            background:linear-gradient(90deg,var(--accent),#60a5fa);
            color:#042028;padding:10px 14px;border-radius:10px;border:0;font-weight:600;cursor:pointer;
            box-shadow:0 6px 18px rgba(99,102,241,0.12);
        }
        .muted-link{font-size:13px;color:var(--muted);text-decoration:none}
        .error{
            background:rgba(255,40,64,0.08);color:#ffb4c0;padding:10px;border-radius:10px;font-size:13px;margin-bottom:12px;border:1px solid rgba(255,40,64,0.08);
        }
        .help{font-size:13px;color:var(--muted);margin-top:14px;text-align:center}
        @media (max-width:480px){
            .card{padding:20px;border-radius:12px}
            .logo{width:44px;height:44px}
        }
    </style>
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
                    <input id="username" name="username" type="text" value="<?=htmlspecialchars($old['username'])?>" placeholder="contoh: admin" required />
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
