<?php
include 'koneksi.php';

$tables = [
    'agen_wisata', 'paket_wisata', 'lokasi_wisata', 'penginapan',
    'tour_guide', 'tiket', 'wisatawan', 'pemesanan', 'pembayaran', 'feedback'
];

$counts = [];
foreach ($tables as $table) {
    $result = $conn->query("SELECT COUNT(*) AS total FROM $table");
    $row = $result->fetch_assoc();
    $counts[$table] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Sinergi Pariwisata Garut</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 20px; }
        h1 { text-align: center; margin-bottom: 30px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .card {
            background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 20px; text-align: center;
        }
        .card h2 { margin: 0 0 10px; font-size: 24px; color: #333; }
        .card p { margin: 0; font-size: 36px; font-weight: bold; color: #007bff; }
    </style>
</head>
<body>

<h1>Dashboard Sinergi Pariwisata Garut</h1>

<div class="grid">
    <div class="card">
        <h2>Agen Wisata</h2>
        <p><?= $counts['agen_wisata'] ?></p>
    </div>
    <div class="card">
        <h2>Paket Wisata</h2>
        <p><?= $counts['paket_wisata'] ?></p>
    </div>
    <div class="card">
        <h2>Lokasi Wisata</h2>
        <p><?= $counts['lokasi_wisata'] ?></p>
    </div>
    <div class="card">
        <h2>Penginapan</h2>
        <p><?= $counts['penginapan'] ?></p>
    </div>
    <div class="card">
        <h2>Tour Guide</h2>
        <p><?= $counts['tour_guide'] ?></p>
    </div>
    <div class="card">
        <h2>Tiket</h2>
        <p><?= $counts['tiket'] ?></p>
    </div>
    <div class="card">
        <h2>Wisatawan</h2>
        <p><?= $counts['wisatawan'] ?></p>
    </div>
    <div class="card">
        <h2>Pemesanan</h2>
        <p><?= $counts['pemesanan'] ?></p>
    </div>
    <div class="card">
        <h2>Pembayaran</h2>
        <p><?= $counts['pembayaran'] ?></p>
    </div>
    <div class="card">
        <h2>Feedback</h2>
        <p><?= $counts['feedback'] ?></p>
    </div>
</div>

</body>
</html>
