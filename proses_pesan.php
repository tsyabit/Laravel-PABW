<?php
include "koneksi.php";

// Ambil data dari form
$id_pemesanan    = $_POST['id_pemesanan'];
$tgl_pemesanan   = $_POST['tgl_pemesanan'];
$jmlh_pemesanan  = $_POST['jmlh_pemesanan'];
$id_paket        = $_POST['id_paket'];
$nama_wisatawan  = $_POST['nama_wisatawan'];
$id_tour_guide   = $_POST['id_tour_guide'];

// Masukkan data ke tabel pemesanan
$stmt = $conn->prepare("INSERT INTO pemesanan 
    (id_pemesanan, tgl_pemesanan, jmlh_pemesanan, id_paket, nama_wisatawan, id_tour_guide) 
    VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssss", 
    $id_pemesanan, $tgl_pemesanan, $jmlh_pemesanan, $id_paket, $nama_wisatawan, $id_tour_guide);

if ($stmt->execute()) {
    echo "<script>alert('Pemesanan berhasil!'); window.location.href='paket_wisata.php';</script>";
} else {
    echo "Gagal menyimpan data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
