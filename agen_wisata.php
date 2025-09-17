<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Agen Wisata - Sinergi Pariwisata Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 text-center">🧭 Daftar Agen Wisata</h2>
        <a href="index.php" class="btn btn-secondary mb-3">← Kembali ke Beranda</a>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Agen</th>
                    <th>Nama Agen</th>
                    <th>Jalan</th>
                    <th>Kota</th>
                    <th>Email</th>
                    <th>No. HP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM agen_wisata";
                $result = $conn->query($sql);
                $no = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['id_agen']}</td>
                                <td>{$row['nama_agen']}</td>
                                <td>{$row['jalan']}</td>
                                <td>{$row['kota']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['no_hp']}</td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Data agen wisata belum tersedia.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
