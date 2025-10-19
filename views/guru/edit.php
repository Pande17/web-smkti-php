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
    <title>Edit Data Guru</title>
    <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
<header><h2>Edit Data Guru</h2></header>

<nav>
    <a href="index.php">Kembali</a>
</nav>

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

</body>
</html>