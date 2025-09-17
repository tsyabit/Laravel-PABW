<?php
require_once 'config.php';
$hasil = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no = intval($_POST['no_pembayaran']) - 100000;

    $stmt = $conn->prepare("SELECT p.*, t.nama_tiket FROM pemberian_no_pembayaran p 
                            JOIN beli_tiket t ON p.id_tiket = t.id_tiket
                            WHERE p.id = ?");
    $stmt->bind_param("i", $no);
    $stmt->execute();
    $result = $stmt->get_result();
    $hasil = $result->fetch_assoc();

    if (!$hasil) {
        $error = "Nomor pembayaran tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Status Pembayaran - Sinergi Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>🔎 Cek Status Pembayaran</h2>
    <form method="post" class="mt-3 mb-4">
        <div class="input-group">
            <input type="text" name="no_pembayaran" class="form-control" placeholder="Masukkan No Pembayaran (#100123)" required>
            <button class="btn btn-primary" type="submit">Cek</button>
        </div>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif ($hasil): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Pembayaran</h5>
                <p class="card-text">
                    <strong>Nama Tiket:</strong> <?= htmlspecialchars($hasil['nama_tiket']) ?><br>
                    <strong>Nama Pemesan:</strong> <?= htmlspecialchars($hasil['nama_pemesan']) ?><br>
                    <strong>Jumlah Tiket:</strong> <?= $hasil['jumlah'] ?><br>
                    <strong>Total Bayar:</strong> Rp <?= number_format($hasil['total_harga'], 0, ',', '.') ?><br>
                    <strong>Status:</strong> 
                    <?php if ($hasil['status'] === 'Sudah Dibayar'): ?>
                        <span class="badge bg-success">Sudah Dibayar</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark">Belum Dibayar</span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
