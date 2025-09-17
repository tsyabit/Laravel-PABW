<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_wisatawan'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id_paket'])) {
    echo "ID Paket tidak ditemukan.";
    exit;
}
$id_paket = $_GET['id_paket'];

$id_wisatawan = $_SESSION['id_wisatawan'];
$nama_wisatawan = $_SESSION['nama_wisatawan'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pemesanan = "P" . rand(1000, 9999);
    $tgl_pemesanan = date("Y-m-d");
    $jmlh_pemesanan = $_POST['jumlah'];

    $query = "INSERT INTO pemesanan 
              (id_pemesanan, tgl_pemesanan, jmlh_pemesanan, id_wisatawan, id_paket, nama_wisatawan) 
              VALUES ('$id_pemesanan', '$tgl_pemesanan', '$jmlh_pemesanan', '$id_wisatawan', '$id_paket', '$nama_wisatawan')";
    
    if ($conn->query($query)) {
        header("Location: form_pembayaran.php?id_pemesanan=$id_pemesanan");
        exit;
    } else {
        echo "Gagal menyimpan pemesanan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">📝 Form Pemesanan Tiket</h2>
    <form method="post" class="w-50 mx-auto">
        <div class="mb-3">
            <label class="form-label">Nama Wisatawan</label>
            <input type="text" class="form-control" value="<?= $nama_wisatawan ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Pemesanan</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Lanjut ke Pembayaran</button>
    </form>
</div>
</body>
</html>
