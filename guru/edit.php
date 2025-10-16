<?php 
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM guru WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Guru</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h2>Edit Data Guru</h2>
<form method="post">
    <table>
        <tr><td>NIP</td><td><input type="text" name="nip" value="<?= $d['nip'] ?>" required></td></tr>
        <tr><td>Nama</td><td><input type="text" name="nama" value="<?= $d['nama'] ?>" required></td></tr>
        <tr><td>Mata Pelajaran</td><td><input type="text" name="mapel" value="<?= $d['mapel'] ?>" required></td></tr>
        <tr><td colspan="2"><button type="submit" name="update">Simpan Perubahan</button></td></tr>
    </table>
</form>

<?php
if(isset($_POST['update'])){
    mysqli_query($koneksi, "UPDATE guru SET 
        nip='$_POST[nip]', 
        nama='$_POST[nama]', 
        mapel='$_POST[mapel]' 
        WHERE id='$id'");
    echo "<script>alert('Data guru berhasil diperbarui');window.location='index.php';</script>";
}
?>
</body>
</html>
