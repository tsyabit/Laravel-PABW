<?php

session_start();

require_once 'config.php';
$hasil = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no = intval($_POST['no_pembayaran']) - 10000;

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
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">🌄 Sinergi Garut</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="tentangkita.php">Tentang Kami</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item"><a class="nav-link" href="#">👤 <?= $_SESSION['username'] ?></a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
                <?php else: ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
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
    <strong>Status:</strong> 
<?php if ($hasil['status'] === 'Sudah Dibayar'): ?>
    <span class="badge bg-success">Sudah Dibayar</span>
<?php elseif ($hasil['status'] === 'Belum Dibayar'): ?>
    <span class="badge bg-warning text-dark">Belum Dibayar</span>
<?php else: ?>
    <span class="badge bg-secondary">Status Tidak Diketahui</span>
<?php endif; ?>

                </p>
            </div>
        </div>
    <?php endif; ?>
</div>

<footer class="text-center mt-5">
    <div>© <?= date('Y') ?> Sinergi Pariwisata Garut. Dibuat dengan ❤️ oleh SASENANA.</div>
</footer>
</body>
</html>
