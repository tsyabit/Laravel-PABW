<?php
include 'koneksi.php';

// Ambil data wisatawan, paket wisata, dan tour guide untuk dropdown
$wisatawan = $conn->query("SELECT * FROM wisatawan");
$paket = $conn->query("SELECT * FROM paket_wisata");
$tour_guide = $conn->query("SELECT * FROM tour_guide");

// Tambah data pemesanan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
    $id = $_POST['id_pemesanan'];
    $tgl = $_POST['tgl_pemesanan'];
    $jmlh = $_POST['jmlh_pemesanan'];
    $id_w = $_POST['id_wisatawan'];
    $id_p = $_POST['id_paket'];
    $nama_w = $_POST['nama_wisatawan'];
    $id_tg = $_POST['id_tour_guide'];

    $sql = "INSERT INTO pemesanan (id_pemesanan, tgl_pemesanan, jmlh_pemesanan, id_wisatawan, id_paket, nama_wisatawan, id_tour_guide)
            VALUES ('$id', '$tgl', '$jmlh', '$id_w', '$id_p', '$nama_w', '$id_tg')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pemesanan berhasil disimpan!'); location.href='pemesanan.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data pemesanan
$data = $conn->query("SELECT * FROM pemesanan");
?>

<h2>Data Pemesanan</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>ID Pemesanan</th>
        <th>Tanggal</th>
        <th>Jumlah Pesanan</th>
        <th>ID Wisatawan</th>
        <th>Nama Wisatawan</th>
        <th>ID Paket</th>
        <th>ID Tour Guide</th>
    </tr>
    <?php while($row = $data->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id_pemesanan'] ?></td>
        <td><?= $row['tgl_pemesanan'] ?></td>
        <td><?= $row['jmlh_pemesanan'] ?></td>
        <td><?= $row['id_wisatawan'] ?></td>
        <td><?= htmlspecialchars($row['nama_wisatawan']) ?></td>
        <td><?= $row['id_paket'] ?></td>
        <td><?= $row['id_tour_guide'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<h3>Tambah Pemesanan</h3>
<form method="POST">
    <label>ID Pemesanan:</label><br>
    <input type="text" name="id_pemesanan" maxlength="5" required><br>

    <label>Tanggal Pemesanan:</label><br>
    <input type="date" name="tgl_pemesanan" required><br>

    <label>Jumlah Pemesanan:</label><br>
    <input type="text" name="jmlh_pemesanan" required><br>

    <label>Wisatawan:</label><br>
    <select name="id_wisatawan" id="wisatawan" required onchange="setNamaWisatawan()">
        <option value="">--Pilih Wisatawan--</option>
        <?php while($w = $wisatawan->fetch_assoc()): ?>
            <option value="<?= $w['id_wisatawan'] ?>" data-nama="<?= htmlspecialchars($w['nama']) ?>"><?= $w['nama'] ?></option>
        <?php endwhile; ?>
    </select><br>

    <label>Nama Wisatawan (otomatis):</label><br>
    <input type="text" name="nama_wisatawan" id="nama_wisatawan" readonly required><br>

    <label>Paket Wisata:</label><br>
    <select name="id_paket" required>
        <option value="">--Pilih Paket--</option>
        <?php while($p = $paket->fetch_assoc()): ?>
            <option value="<?= $p['id_paket'] ?>"><?= $p['nama_paket'] ?></option>
        <?php endwhile; ?>
    </select><br>

    <label>Tour Guide:</label><br>
    <select name="id_tour_guide" required>
        <option value="">--Pilih Tour Guide--</option>
        <?php while($tg = $tour_guide->fetch_assoc()): ?>
            <option value="<?= $tg['id_tour_guide'] ?>"><?= htmlspecialchars($tg['nama']) ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit" name="tambah">Simpan</button>
</form>

<script>
function setNamaWisatawan() {
    const select = document.getElementById('wisatawan');
    const namaInput = document.getElementById('nama_wisatawan');
    const selected = select.options[select.selectedIndex];
    namaInput.value = selected.getAttribute('data-nama') || '';
}
</script>
