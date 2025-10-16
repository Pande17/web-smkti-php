<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Jurusan</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h2>Tambah Data Jurusan</h2>
<form method="post">
    <table>
        <tr><td>Kode Jurusan</td><td><input type="text" name="kode" required></td></tr>
        <tr><td>Nama Jurusan</td><td><input type="text" name="nama_jurusan" required></td></tr>
        <tr><td colspan="2"><button type="submit" name="simpan">Simpan</button></td></tr>
    </table>
</form>

<?php
if(isset($_POST['simpan'])){
    mysqli_query($koneksi, "INSERT INTO jurusan (kode,nama_jurusan)
    VALUES ('$_POST[kode]','$_POST[nama_jurusan]')");
    echo "<script>alert('Data jurusan berhasil disimpan');window.location='index.php';</script>";
}
?>
</body>
</html>
