<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Jurusan - SMK TI Bali Global Denpasar</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<header><h2>Data Jurusan</h2></header>
<nav>
    <a href="../index.php">Home</a>
    <a href="tambah.php" class="btn">Tambah Jurusan</a>
</nav>

<table>
<tr>
    <th>No</th>
    <th>Kode Jurusan</th>
    <th>Nama Jurusan</th>
    <th>Aksi</th>
</tr>
<?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM jurusan");
while($d = mysqli_fetch_array($data)){
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['kode']; ?></td>
    <td><?= $d['nama_jurusan']; ?></td>
    <td>
        <a href="edit.php?id=<?= $d['id']; ?>" class="btn">Edit</a>
        <a href="hapus.php?id=<?= $d['id']; ?>" class="btn" style="background:red;">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
</body>
</html>
