<?php
include "koneksi.php";
$id_inap = $_GET['id_inap'];
$data = $conn->query("SELECT * FROM penginapan WHERE id_inap = '$id_inap'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan Penginapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">📝 Form Pemesanan Penginapan</h2>
        <form action="proses_pesan_inap.php" method="post">
            <input type="hidden" name="id_inap" value="<?= $data['id_inap'] ?>">
            <div class="mb-3">
                <label>Nama Penginapan</label>
                <input type="text" class="form-control" value="<?= $data['nm_inap'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label>Nama Pemesan</label>
                <input type="text" name="nama_pemesan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Check-in</label>
                <input type="date" name="checkin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jumlah Malam</label>
                <input type="number" name="malam" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
        </form>
    </div>
</body>
</html>
