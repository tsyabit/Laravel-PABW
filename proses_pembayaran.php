<?php
require_once 'config.php';

$id_pemesanan = $_POST['id_pemesanan'];
$metode       = $_POST['metode'];
$jumlah       = 0;
$bukti_path   = null;

if (!empty($_FILES['bukti']['name'])) {
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) mkdir($target_dir);

    $bukti_path = $target_dir . time() . "_" . basename($_FILES['bukti']['name']);
    move_uploaded_file($_FILES["bukti"]["tmp_name"], $bukti_path);
}

$sql = "SELECT jumlah, t.harga FROM pemesanan p 
        JOIN beli_tiket t ON p.id_tiket = t.id WHERE p.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_pemesanan);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$jumlah = $data['jumlah'] * $data['harga'];

$stmt = $conn->prepare("INSERT INTO pembayaran (id_pemesanan, metode, jumlah, bukti_transfer) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isis", $id_pemesanan, $metode, $jumlah, $bukti_path);

if ($stmt->execute()) {
    echo "<script>alert('Pembayaran berhasil disimpan!'); window.location.href='index.php';</script>";
} else {
    echo "Gagal menyimpan pembayaran: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
