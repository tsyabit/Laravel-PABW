<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tentang Kami - Sinergi Pariwisata Garut</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">🌄 Sinergi Pariwisata Garut</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="tentang.php">Tentang</a></li>
                <?php if (isset($_SESSION['id_wisatawan'])): ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Content -->
<div class="container mt-5">
    <h1 class="text-center">Tentang Kami</h1>
    <p class="mt-4">
        Sinergi Pariwisata Garut adalah platform digital yang memudahkan wisatawan menjelajahi keindahan Garut.
        Kami menyediakan informasi dan layanan seperti pembelian tiket, penginapan, pemandu wisata, serta paket wisata.
    </p>
    <p>
        Kami hadir untuk mendukung pariwisata lokal dan memberikan pengalaman terbaik bagi para pengunjung.
    </p>
    <img src="data:image/jpeg;base64,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" alt="">
</div>

<div class="container mt-5"> 
    <h1 class="text-center">LOVE YOU ALL FROM SASENANA❤️</h1>
</div>


<!-- Footer -->
<footer class="bg-light text-center py-3 mt-5">
     <div>© <?= date('Y') ?> Sinergi Pariwisata Garut. Dibuat dengan ❤️ oleh SASENANA.</div>
</footer>

</body>
</html>
