<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa - SMK TI Bali Global Denpasar</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<header><h2>Data Siswa</h2></header>
<nav>
    <a href="../index.php">Home</a>
    <a href="tambah.php" class="btn">Tambah Siswa</a>
</nav>

<table>
<tr>
    <th>No</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Kelas</th>
    <th>Jurusan</th>
    <th>Aksi</th>
</tr>
<?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM siswa");
while($d = mysqli_fetch_array($data)){
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['nis']; ?></td>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['kelas']; ?></td>
    <td><?= $d['jurusan']; ?></td>
    <td>
        <a href="edit.php?id=<?= $d['id']; ?>" class="btn">Edit</a>
        <a href="hapus.php?id=<?= $d['id']; ?>" class="btn" style="background:red;">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
</body>
</html>
