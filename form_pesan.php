    <?php
    include "koneksi.php";

    if (!isset($_GET['id_paket'])) {
        echo "ID Paket tidak ditemukan.";
        exit;
    }

    $id_paket = $_GET['id_paket'];

    $sql = "SELECT * FROM paket_wisata WHERE id_paket = '$id_paket'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "Paket tidak ditemukan.";
        exit;
    }

    $paket = $result->fetch_assoc();
    ?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Form Pemesanan Paket Wisata</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <h2 class="mb-4 text-center">📝 Form Pemesanan</h2>

            <div class="card">
                <div class="card-header bg-primary text-white">Detail Paket</div>
                <div class="card-body">
                    <p><strong>Nama Paket:</strong> <?= htmlspecialchars($paket['nama_paket']); ?></p>
                    <p><strong>Harga:</strong> Rp <?= number_format($paket['harga'], 0, ',', '.'); ?></p>
                    <?php if (!empty($paket['deskripsi'])): ?>
                        <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($paket['deskripsi'])); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        

            <form action="proses_pesan.php" method="POST" class="mt-4">
    <!-- Hidden data penting -->
    <input type="hidden" name="id_pemesanan" value="<?= uniqid('P'); ?>">
    <input type="hidden" name="tgl_pemesanan" value="<?= date('Y-m-d'); ?>">
    <input type="hidden" name="id_paket" value="<?= $paket['id_paket']; ?>">
    <input type="hidden" name="id_tour_guide" value="T0001"> <!-- Atur sesuai sistem -->

    <div class="mb-3">
        <label class="form-label">Nama Paket</label>
        <input type="text" class="form-control" name="nama_paket" value="<?= htmlspecialchars($paket['nama_paket']); ?>" readonly>
    </div>

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Wisatawan</label>
        <input type="text" name="nama_wisatawan" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal Berangkat</label>
        <input type="date" name="tanggal_berangkat" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah Orang</label>
        <input type="number" name="jmlh_pemesanan" class="form-control" min="1" required>
    </div>

    <button type="submit" class="btn btn-success">Kirim Pemesanan</button>
    <a href="paket_wisata.php" class="btn btn-secondary">Batal</a>
</form>

        </div>
    </body>
    </html>
