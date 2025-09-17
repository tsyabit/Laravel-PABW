<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Penginapan - Sinergi Pariwisata Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height: 180px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">🌄 Sinergi Garut</a>
            <div>
                <a class="nav-link d-inline" href="index.php">Beranda</a>
                <a class="nav-link d-inline" href="tentang.php">Tentang Kami</a>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container py-4">
        <h2 class="text-center mb-4">🏨 Pilih Penginapan</h2>

        <div class="row g-4">
            <?php
            $sql = "SELECT * FROM penginapan";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Jika tidak ada gambar, pakai placeholder
                   $gambar = !empty($row['foto']) ? $row['foto'] : 'default.jpg';
echo "
<div class='col-md-4'>
    <div class='card h-100 shadow-sm'>
        <img src='images/{$gambar}' class='card-img-top' alt='{$row['nm_inap']}'>
        <div class='card-body'>
            <h5 class='card-title'>{$row['nm_inap']}</h5>
            <p class='card-text'><strong>Alamat:</strong> {$row['alamat']}</p>
            <p class='card-text'><strong>Harga:</strong> Rp " . number_format($row['hrgpermlm'], 0, ',', '.') . "</p>
            <p class='card-text'><strong>Fasilitas:</strong> {$row['fasilitas']}</p>
            <a href='pesan_penginapan.php?id_inap={$row['id_inap']}' class='btn btn-primary w-100'>Pesan</a>
        </div>
    </div>
</div>";

                }
            } else {
                echo "<div class='col-12 text-center text-muted'>Belum ada data penginapan tersedia.</div>";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <footer class="mt-5 text-center text-muted small">
        <hr>
        &copy; <?= date('Y') ?> Sinergi Pariwisata Garut | Daftar Penginapan
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
