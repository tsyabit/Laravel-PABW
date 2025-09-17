<?php
include 'koneksi.php';

$id_detil_tiket = $_GET['id_detil_tiket'] ?? null;
if (!$id_detil_tiket) die("Data tiket tidak ditemukan.");

$sql = "SELECT dt.*, p.jumlah, p.mtd_pmbyrn, w.nama FROM detil_tiket dt
        LEFT JOIN pembayaran p ON dt.id_pembayaran = p.id_pembayaran
        LEFT JOIN wisatawan w ON p.id_wisatawan = w.id_wisatawan
        WHERE dt.id_detil_tiket = '$id_detil_tiket'";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

?>

<h2>Konfirmasi Tiket</h2>
<p><b>Kode Tiket:</b> <?= $data['kode_tiket'] ?></p>
<p><b>Status:</b> <?= $data['status_tiket'] ?></p>
<p><b>Nama Pemesan:</b> <?= htmlspecialchars($data['nama']) ?></p>
<p><b>Jumlah Bayar:</b> <?= number_format($data['jumlah']) ?></p>
<p><b>Metode Pembayaran:</b> <?= htmlspecialchars($data['mtd_pmbyrn']) ?></p>
