<?php
// start session jika belum
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// jika belum login -> redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: /data-sekolah/index.php');
    exit;
}