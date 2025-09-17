<?php
require_once 'config.php';

// Proses update status jika tombol ditekan
if (isset($_GET['konfirmasi'])) {
    $id = intval($_GET['konfirmasi']);
    $stmt = $conn->prepare("UPDATE pemberian_no_pembayaran SET status = 'Sudah Dibayar' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: panel_admin.php");
    exit;
}

// Ambil semua data pembayaran
$result = $conn->query("SELECT p.*, t.nama_tiket FROM pemberian_no_pembayaran p 
                        JOIN beli_tiket t ON p.id_tiket = t.id_tiket 
                        ORDER BY p.created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - Status Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>🛠️ Panel Admin - Status Pembayaran</h2>

    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th>No. Pembayaran</th>
                <th>Nama Pemesan</th>
                <th>Email</th>
                <th>Nama Tiket</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>#<?= 100000 + $row['id'] ?></td>
                <td><?= htmlspecialchars($row['nama_pemesan']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['nama_tiket']) ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                <td><?= $row['metode'] ?></td>
                <td>
                    <?php if ($row['status'] === 'Sudah Dibayar'): ?>
                        <span class="badge bg-success">Sudah Dibayar</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark">Belum Dibayar</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($row['status'] !== 'Sudah Dibayar'): ?>
                        <a href="?konfirmasi=<?= $row['id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pembayaran untuk #<?= 100000 + $row['id'] ?>?')">Konfirmasi</a>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
