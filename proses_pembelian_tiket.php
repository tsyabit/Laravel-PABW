<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_tiket = $_POST['id_tiket'];
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $jumlah = intval($_POST['jumlah']);
    $metode = htmlspecialchars($_POST['metode']);

    // Ambil detail tiket dari database
    $stmt = $conn->prepare("SELECT * FROM beli_tiket WHERE id_tiket = ?");
    $stmt->bind_param("i", $id_tiket);
    $stmt->execute();
    $result = $stmt->get_result();
    $tiket = $result->fetch_assoc();

    if (!$tiket) {
        echo "Tiket tidak ditemukan.";
        exit;
    }

    $harga_total = $tiket['harga'] * $jumlah;
} else {
    // Akses langsung tanpa POST
    header("Location: beli_tiket.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembayaran - Sinergi Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>💳 Konfirmasi Pembayaran</h2>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($tiket['nama_tiket']) ?></h5>
            <p class="card-text">
                <strong>Nama Pemesan:</strong> <?= $nama ?><br>
                <strong>Kontak:</strong> <?= $email ?><br>
                <strong>Jumlah Tiket:</strong> <?= $jumlah ?><br>
                <strong>Harga per Tiket:</strong> Rp <?= number_format($tiket['harga'], 0, ',', '.') ?><br>
                <strong>Total Bayar:</strong> <span class="text-success fw-bold">Rp <?= number_format($harga_total, 0, ',', '.') ?></span><br>
                <strong>Metode Pembayaran:</strong> <?= $metode ?>
            </p>

            <form action="pembayaran_tiket.php" method="post">
                <input type="hidden" name="id_tiket" value="<?= $id_tiket ?>">
                <input type="hidden" name="nama" value="<?= $nama ?>">
                <input type="hidden" name="email" value="<?= $email ?>">
                <input type="hidden" name="jumlah" value="<?= $jumlah ?>">
                <input type="hidden" name="metode" value="<?= $metode ?>">
                <button type="submit" class="btn btn-primary">Konfirmasi dan Bayar</button>
                <a href="beli_tiket.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
