<?php
session_start();
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beli Tiket - Sinergi Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .ticket-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            background: white;
            transition: 0.3s;
        }
        .ticket-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        }
        .ticket-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">🌄 Sinergi Garut</a>
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

<div class="container mt-4">
    <h2 class="mb-4">🎟️ Pilih Tiket Wisata</h2>
    <div class="row g-4">

        <?php
        $result = $conn->query("SELECT * FROM beli_tiket");

        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='col-md-4'>
                <div class='ticket-card'>
                    <img src='images/{$row['foto']}' alt='{$row['nama_tiket']}' class='ticket-image'>
                    <h5>{$row['nama_tiket']}</h5>
                    <p>Harga: Rp " . number_format($row['harga'], 0, ',', '.') . "</p>
                    <button class='btn btn-primary' onclick='isiForm(" . json_encode($row) . ")'>Pesan</button>
                </div>
            </div>";
        }
        ?>

    </div>

    <div id="formSection" class="mt-5" style="display:none;">
        <h4>📝 Formulir Pemesanan</h4>
        <form action="proses_pembelian_tiket.php" method="post">
            <input type="hidden" name="id_tiket" id="id_tiket">
            <div class="mb-3">
                <label class="form-label">Nama Tiket</label>
                <input type="text" id="nama_tiket" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pemesan</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email / Kontak</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Tiket</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="1" required>
            </div>
            <div class="mb-3">
                <label for="metode" class="form-label">Metode Pembayaran</label>
                <select class="form-select" name="metode" id="metode" required>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="OVO">OVO</option>
                    <option value="GoPay">GoPay</option>
                    <option value="Dana">Dana</option>
                    <option value="ShopeePay">ShopeePay</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Bayar Sekarang</button>
        </form>
    </div>
</div>

<footer class="text-center mt-5">
    <div>© <?= date('Y') ?> Sinergi Pariwisata Garut. Dibuat dengan ❤️ oleh SASENANA.</div>
</footer>

<script>
function isiForm(data) {
    document.getElementById('id_tiket').value = data.id_tiket;
    document.getElementById('nama_tiket').value = data.nama_tiket;
    document.getElementById('formSection').style.display = 'block';
    window.scrollTo({ top: document.getElementById('formSection').offsetTop - 80, behavior: 'smooth' });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
