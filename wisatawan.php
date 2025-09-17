<?php
include 'koneksi.php';

// Proses tambah wisatawan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
    $id = $_POST['id_wisatawan'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];

    $sql = "INSERT INTO wisatawan (id_wisatawan, nama, email, nohp)
            VALUES ('$id', '$nama', '$email', '$nohp')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data wisatawan berhasil ditambahkan!'); location.href='wisatawan.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Proses hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM wisatawan WHERE id_wisatawan = '$id'");
    echo "<script>location.href='wisatawan.php';</script>";
}

// Ambil data
$data = $conn->query("SELECT * FROM wisatawan ORDER BY id_wisatawan");
?>

<h2>Data Wisatawan</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Nama</th><th>Email</th><th>No. HP</th><th>Aksi</th>
    </tr>
    <?php while ($row = $data->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['id_wisatawan'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['nohp'] ?></td>
            <td>
                <a href="wisatawan_edit.php?id=<?= $row['id_wisatawan'] ?>">Edit</a> |
                <a href="?hapus=<?= $row['id_wisatawan'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<h3>Tambah Wisatawan</h3>
<form method="POST">
    <label>ID Wisatawan:</label><br>
    <input type="text" name="id_wisatawan" maxlength="5" required><br>
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br>
    <label>Email:</label><br>
    <input type="email" name="email"><br>
    <label>No. HP:</label><br>
    <input type="text" name="nohp" maxlength="13"><br><br>
    <button type="submit" name="tambah">Simpan</button>
</form>
