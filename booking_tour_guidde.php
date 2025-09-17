<?php
include 'koneksi.php';

$tour_guide = $conn->query("SELECT id_tour_guide, nama FROM tour_guide");

$wisatawan = $conn->query("SELECT id_wisatawan, nama FROM wisatawan");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pesan = uniqid("P");
    $id_wisatawan = $_POST['id_wisatawan'];
    $id_tour_guide = $_POST['id_tour_guide'];
    $tgl_pesan = date("Y-m-d");
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $jumlah_orang = $_POST['jumlah_orang'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO pemesanan (id_pesan, id_wisatawan, id_tour_guide, tgl_pesan, tgl_mulai, tgl_selesai, jumlah_orang, keterangan)
            VALUES ('$id_pesan', '$id_wisatawan', '$id_tour_guide', '$tgl_pesan', '$tgl_mulai', '$tgl_selesai', '$jumlah_orang', '$keterangan')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pemesanan tour guide berhasil!'); window.location='tour_guide.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!-- Header / Navbar -->
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

<h2>Form Booking Tour Guide</h2>
<form method="POST">
    <label>Wisatawan:</label>
    <select name="id_wisatawan" required>
        <option value="">--Pilih Wisatawan--</option>
        <?php while ($w = $wisatawan->fetch_assoc()) : ?>
            <option value="<?= $w['id_wisatawan'] ?>"><?= $w['nama'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Tour Guide:</label>
    <select name="id_tour_guide" required>
        <option value="">--Pilih Tour Guide--</option>
        <?php while ($t = $tour_guide->fetch_assoc()) : ?>
            <option value="<?= $t['id_tour_guide'] ?>"><?= $t['nama'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Tanggal Mulai:</label>
    <input type="date" name="tgl_mulai" required><br><br>

    <label>Tanggal Selesai:</label>
    <input type="date" name="tgl_selesai" required><br><br>

    <label>Jumlah Orang:</label>
    <input type="number" name="jumlah_orang" required><br><br>

    <label>Keterangan:</label>
    <textarea name="keterangan"></textarea><br><br>

    <button type="submit">Pesan Tour Guide</button>
</form>
