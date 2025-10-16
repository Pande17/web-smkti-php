<?php 
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Jurusan</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h2>Edit Data Jurusan</h2>
<form method="post">
    <table>
        <tr><td>Kode Jurusan</td><td><input type="text" name="kode" value="<?= $d['kode'] ?>" required></td></tr>
        <tr><td>Nama Jurusan</td><td><input type="text" name="nama_jurusan" value="<?= $d['nama_jurusan'] ?>" required></td></tr>
        <tr><td colspan="2"><button type="submit" name="update">Simpan Perubahan</button></td></tr>
    </table>
</form>

<?php
if(isset($_POST['update'])){
    mysqli_query($koneksi, "UPDATE jurusan SET 
        kode='$_POST[kode]', 
        nama_jurusan='$_POST[nama_jurusan]' 
        WHERE id='$id'");
    echo "<script>alert('Data jurusan berhasil diperbarui');window.location='index.php';</script>";
}
?>
</body>
</html>
