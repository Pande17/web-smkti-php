<?php
include '../../config/koneksi.php';
require_once '../../controller/GuruController.php';
session_start();

$guruController = new GuruController($koneksi);

if(isset($_POST['simpan'])){
    $data = [
        'nip' => $_POST['nip'],
        'nama' => $_POST['nama'],
        'mapel' => $_POST['mapel']
    ];

    if($guruController->createGuru($data)) {
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Guru</title>
    <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
<header><h2>Tambah Data Guru</h2></header>

<nav>
    <a href="index.php">Kembali</a>
</nav>

<form method="post">
    <table>
        <tr>
            <td>NIP</td>
            <td><input type="text" name="nip" required></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" required></td>
        </tr>
        <tr>
            <td>Mata Pelajaran</td>
            <td><input type="text" name="mapel" required></td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" name="simpan" class="btn">Simpan</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>