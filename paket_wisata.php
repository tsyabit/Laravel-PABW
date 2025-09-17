<?php
include "koneksi.php";
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Paket Wisata - Sinergi Pariwisata Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height: 180px;
            object-fit: cover;
            border-top-left-radius: .5rem;
            border-top-right-radius: .5rem;
        }
    </style>
</head>

<body class="bg-light">

<!-- Navbar -->
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
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Konten -->
<div class="container py-5">
    <h2 class="mb-4 text-center">📦 Daftar Paket Wisata</h2>
    <div class="text-left mb-4">
        <a href="index.php" class="btn btn-secondary">← Kembali ke Beranda</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $sql = "SELECT*FROM paket_wisata";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $foto = $row['foto'] ?? 'images/default_paket.jpg';
                $deskripsi = $row['deskripsi'] ?? 'Belum ada deskripsi.';

                echo '
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="' . $foto . '" class="card-img-top" alt="Foto Paket">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($row['nama_paket']) . '</h5>
                            <p class="card-text text-muted">ID Paket: ' . $row['id_paket'] . '</p>
                            <p class="card-text">💰 Harga: <strong>Rp ' . number_format($row['harga'], 0, ',', '.') . '</strong></p>
                            <p class="card-text">' . nl2br(htmlspecialchars($deskripsi)) . '</p>
                            <p class="card-text"><small class="text-muted">ID Agen: ' . $row['id_agen'] . ' | ID Wisatawan: ' . $row['id_wisatawan'] . '</small></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 text-center">
                            <a href="form_pesan.php?id_paket=' . $row['id_paket'] . '" class="btn btn-success">Pesan</a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "<p class='text-center'>Belum ada data paket wisata.</p>";
        }

        $conn->close();
        ?>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <div>© <?= date('Y') ?> Sinergi Pariwisata Garut. Dibuat dengan ❤️ oleh SASENANA.</div>
    </footer>
</div>

</body>
</html>
