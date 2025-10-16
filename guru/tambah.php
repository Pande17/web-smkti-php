<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Guru</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h2>Tambah Data Guru</h2>
<form method="post">
    <table>
        <tr><td>NIP</td><td><input type="text" name="nip" required></td></tr>
        <tr><td>Nama</td><td><input type="text" name="nama" required></td></tr>
        <tr><td>Mata Pelajaran</td><td><input type="text" name="mapel" required></td></tr>
        <tr><td colspan="2"><button type="submit" name="simpan">Simpan</button></td></tr>
    </table>
</form>

<?php
if(isset($_POST['simpan'])){
    mysqli_query($koneksi, "INSERT INTO guru (nip,nama,mapel)
    VALUES ('$_POST[nip]','$_POST[nama]','$_POST[mapel]')");
    echo "<script>alert('Data guru berhasil disimpan');window.location='index.php';</script>";
}
?>
</body>
</html>
