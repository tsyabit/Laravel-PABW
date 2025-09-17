<?php
$conn = new mysqli("localhost", "root", "", "wisata_garut");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT t.id_tour_guide, t.nama, t.kontak, t.bahasa, a.nama_agen 
        FROM tour_guide t 
        LEFT JOIN agen_wisata a ON t.id_agen = a.id_agen 
        ORDER BY t.id_tour_guide";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Tour Guide</title>
    <style>
        body { font-family: sans-serif; background: #f1f1f1; padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background: #2c3e50; color: white; }
        a.button {
            padding: 8px 12px; background: #27ae60; color: white;
            text-decoration: none; border-radius: 5px; display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h2>Daftar Tour Guide</h2>


<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kontak</th>
            <th>Bahasa</th>
            <th>Agen Wisata</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id_tour_guide'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['kontak'] ?></td>
            <td><?= $row['bahasa'] ?></td>
            <td><?= $row['nama_agen'] ?? '-' ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

<?php $conn->close(); ?>
