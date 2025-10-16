<?php 
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Siswa</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h2>Edit Data Siswa</h2>
<form method="post">
    <table>
        <tr><td>NIS</td><td><input type="text" name="nis" value="<?= $d['nis'] ?>" required></td></tr>
        <tr><td>Nama</td><td><input type="text" name="nama" value="<?= $d['nama'] ?>" required></td></tr>
        <tr><td>Kelas</td><td><input type="text" name="kelas" value="<?= $d['kelas'] ?>" required></td></tr>
        <tr><td>Jurusan</td><td><input type="text" name="jurusan" value="<?= $d['jurusan'] ?>" required></td></tr>
        <tr><td colspan="2"><button type="submit" name="update">Simpan Perubahan</button></td></tr>
    </table>
</form>

<?php
if(isset($_POST['update'])){
    mysqli_query($koneksi, "UPDATE siswa SET 
        nis='$_POST[nis]', 
        nama='$_POST[nama]', 
        kelas='$_POST[kelas]', 
        jurusan='$_POST[jurusan]' 
        WHERE id='$id'");
    echo "<script>alert('Data berhasil diperbarui');window.location='index.php';</script>";
}
?>
</body>
</html>
