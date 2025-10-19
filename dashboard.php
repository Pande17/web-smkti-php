<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Sekolah | SMK TI BALI GLOBAL DENPASAR</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <div class="site-title">Data Sekolah</div>

    </div>

    <div class="nav-right" id="navLinks">
        <a href="views/siswa/">Data Siswa</a>
        <a href="views/guru/">Data Guru</a>
        <a href="views/jurusan/">Data Jurusan</a>
        <a href="views/mata_pelajaran/">Data Mata Pelajaran</a>
        <a href="views/ekstrakurikuler/">Data Ekstrakurikuler</a>
    </div>
</nav>

<main>
    <h2 class="welcome">Selamat Datang di Sistem Informasi Sekolah</h2>
</main>

<script>
document.getElementById('navToggle').addEventListener('click', function(){
    var el = document.getElementById('navLinks');
    if (el.style.display === 'flex') el.style.display = 'none';
    else el.style.display = 'flex';
});
</script>

</body>
</html>