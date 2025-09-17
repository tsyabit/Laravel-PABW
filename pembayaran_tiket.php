<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_tiket = $_POST['id_tiket'];
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $jumlah = intval($_POST['jumlah']);
    $metode = htmlspecialchars($_POST['metode']);

    $stmt = $conn->prepare("SELECT harga, nama_tiket FROM beli_tiket WHERE id_tiket = ?");
    $stmt->bind_param("i", $id_tiket);
    $stmt->execute();
    $result = $stmt->get_result();
    $tiket = $result->fetch_assoc();

    if (!$tiket) {
        echo "Tiket tidak ditemukan.";
        exit;
    }

    $total = $tiket['harga'] * $jumlah;

    $insert = $conn->prepare("INSERT INTO pemberian_no_pembayaran (id_tiket, nama_pemesan, email, jumlah, metode, total_harga) VALUES (?, ?, ?, ?, ?, ?)");
    $insert->bind_param("issisi", $id_tiket, $nama, $email, $jumlah, $metode, $total);
    $insert->execute();

    $id_pembayaran = $insert->insert_id;

} else {
    header("Location: beli_tiket.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>No Pembayaran - Sinergi Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>🧾 Nomor Pembayaran Anda</h2>
    <div class="alert alert-info mt-4">
        <p><strong>Nama Tiket:</strong> <?= htmlspecialchars($tiket['nama_tiket']) ?></p>
        <p><strong>Nama Pemesan:</strong> <?= htmlspecialchars($nama) ?></p>
        <p><strong>Jumlah Tiket:</strong> <?= $jumlah ?></p>
        <p><strong>Total Bayar:</strong> <strong class="text-success">Rp <?= number_format($total, 0, ',', '.') ?></strong></p>
        <p><strong>Metode Pembayaran:</strong> <?= $metode ?></p>
        <hr>
        <h5 class="text-primary">💳 Nomor Pembayaran Anda: <strong>#<?= 100000 + $id_pembayaran ?></strong></h5>
        <p>Silakan simpan nomor ini untuk keperluan verifikasi pembayaran.</p>
    </div>

    <a href="beli_tiket.php" class="btn btn-outline-primary">Kembali ke Halaman Tiket</a>
</div>
</body>
</html>
