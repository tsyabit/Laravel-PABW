<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM wisatawan WHERE id_wisatawan = '$id'")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];

    $sql = "UPDATE wisatawan SET nama='$nama', email='$email', nohp='$nohp'
            WHERE id_wisatawan = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diubah'); location.href='wisatawan.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Edit Wisatawan</h2>
<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $data['email'] ?>"><br>
    <label>No. HP:</label><br>
    <input type="text" name="nohp" value="<?= $data['nohp'] ?>" maxlength="13"><br><br>
    <button type="submit">Update</button>
</form>
