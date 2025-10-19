<?php
    include '../../config/koneksi.php';
    require_once '../../controller/GuruController.php';
    session_start();

    $guruController = new GuruController($koneksi);

    // Handle soft delete action
    if(isset($_GET['hapus'])) {
        $guruController->hapusGuru($_GET['hapus']);
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Guru - SMK TI Bali Global Denpasar</title>
    <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
<header><h2>Data Guru</h2></header>
<nav>
    <a href="../../dashboard.php">Home</a>
    <a href="tambah.php" class="btn">Tambah Guru</a>
</nav>

<table>
<tr>
    <th>No</th>
    <th>NIP</th>
    <th>Nama</th>
    <th>Mata Pelajaran</th>
    <th>Aksi</th>
</tr>
<?php
    $no = 1;
    $data = $guruController->getAllGuru();
    while($d = mysqli_fetch_array($data)){
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['nip']; ?></td>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['mapel']; ?></td>
    <td>
        <a href="edit.php?id=<?= $d['id']; ?>" class="btn">Edit</a>
        <a href="index.php?hapus=<?= $d['id']; ?>" class="btn" style="background:red;" 
           onclick="return confirm('Yakin hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
</body>
</html>