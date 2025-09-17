<?php
// koneksi ke database
$host = "localhost";
$user = "root";        // sesuaikan username
$password = "";        // sesuaikan password
$dbname = "wisata_garut";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM lokasi_wisata";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Lokasi Wisata - Sinergi Pariwisata Garut</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #eef2f3; padding: 20px; }
        h1 { color: #2c3e50; }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

<h1>Daftar Lokasi Wisata Garut</h1>

<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID Lokasi</th>
                <th>Nama Lokasi</th>
                <th>Alamat Lokasi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id_lokasi']) ?></td>
                <td><?= htmlspecialchars($row['nm_lokasi']) ?></td>
                <td><?= htmlspecialchars($row['alamat_lokasi']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Tidak ada data lokasi wisata.</p>
<?php endif; ?>

<?php $conn->close(); ?>

</body>
</html>


