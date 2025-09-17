<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $komentar = $_POST['komentar'];
    $rating = $_POST['rating'];
    $id_wisatawan = $_POST['id_wisatawan'];

    if (!empty($komentar) && !empty($rating) && !empty($id_wisatawan)) {
        $stmt = $conn->prepare("INSERT INTO feedback (komentar, rating, id_wisatawan) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $komentar, $rating, $id_wisatawan);
        $stmt->execute();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Feedback - Sinergi Pariwisata Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .star {
            color: gold;
            font-size: 1.2em;
        }
        .review-box {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">🌄 Sinergi Pariwisata Garut</a>
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
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 text-center">📝 Beri Ulasan</h2>

        <form method="POST" class="mb-5">
            <div class="mb-3">
                <label for="komentar" class="form-label">Komentar Anda</label>
                <textarea class="form-control" id="komentar" name="komentar" required></textarea>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1–5)</label>
                <select class="form-select" id="rating" name="rating" required>
                    <option value="">Pilih rating</option>
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_wisatawan" class="form-label">ID Wisatawan</label>
                <input type="text" class="form-control" id="id_wisatawan" name="id_wisatawan" required>
            </div>
            <button type="submit" class="btn btn-success">Kirim Ulasan</button>
        </form>

        <hr>

        <h2 class="mb-4 text-center">🗣 Ulasan Wisatawan</h2>
        <a href="index.php" class="btn btn-secondary mb-3">← Kembali ke Beranda</a>

        <?php
        $sql = "SELECT * FROM feedback ORDER BY id_feedback DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='review-box'>
                        <h5 class='mb-1'>Feedback #{$row['id_feedback']} <small class='text-muted'>(ID Wisatawan: {$row['id_wisatawan']})</small></h5>
                        <p class='mb-2'>{$row['komentar']}</p>
                        <div>";
                for ($i = 1; $i <= 5; $i++) {
                    echo $i <= $row['rating'] ? "<span class='star'>★</span>" : "<span class='text-muted'>★</span>";
                }
                echo "</div></div>";
            }
        } else {
            echo "<div class='alert alert-info text-center'>Belum ada feedback yang masuk.</div>";
        }
        $conn->close();
        ?>
            <footer class="text-center mt-5">
    <div>© <?= date('Y') ?> Sinergi Pariwisata Garut. Dibuat dengan ❤️ oleh SASENANA.</div>
</footer>
    </div>



</body>
</html>