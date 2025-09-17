<?php
include 'koneksi.php';

$id_tiket = $_GET['id_tiket'] ?? null;
if (!$id_tiket) {
    die("ID tiket tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_wisatawan = $_POST['id_wisatawan'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];


    $sql = "INSERT INTO wisatawan (id_wisatawan, nama, email, nohp) VALUES ('$id_wisatawan', '$nama', '$email', '$nohp')";
    if ($conn->query($sql) === TRUE) {
        header("Location: pembayaran.php?id_tiket=$id_tiket&id_wisatawan=$id_wisatawan");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Isi Data Wisatawan</h2>
<form method="POST">
    <label>ID Wisatawan (unik):</label><br>
    <input type="text" name="id_wisatawan" maxlength="5" required><br>
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br>
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>No HP:</label><br>
    <input type="text" name="nohp" required><br><br>
    <button type="submit">Lanjut ke Pembayaran</button>
</form>
