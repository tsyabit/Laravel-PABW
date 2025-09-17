<?php
include 'koneksi.php';

$sql = "SELECT t.id_tiket, t.nama_tiket, t.harga, l.nm_lokasi FROM tiket t
        LEFT JOIN lokasi_wisata l ON t.id_lokasi = l.id_lokasi";
$result = $conn->query($sql);
?>

<h2>Pilih Tiket Wisata</h2>
<table border="1" cellpadding="8">
<tr><th>ID Tiket</th><th>Nama Tiket</th><th>Lokasi</th><th>Harga</th><th>Aksi</th></tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id_tiket'] ?></td>
    <td><?= $row['nama_tiket'] ?></td>
    <td><?= $row['nm_lokasi'] ?></td>
    <td><?= number_format($row['harga']) ?></td>
    <td><a href="data_wisatawan.php?id_tiket=<?= $row['id_tiket'] ?>">Pesan</a></td>
</tr>
<?php endwhile; ?>
</table>
