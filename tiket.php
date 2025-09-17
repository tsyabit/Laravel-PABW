<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tiket - Sinergi Pariwisata Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 text-center">🎫 Data Tiket</h2>
        <a href="index.php" class="btn btn-secondary mb-3">← Kembali ke Beranda</a>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-info">
                <tr>
                    <th>No</th>
                    <th>ID Detail Tiket</th>
                    <th>ID Tiket</th>
                    <th>Kode Tiket</th>
                    <th>Status Tiket</th>
                    <th>ID Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tiket";
                $result = $conn->query($sql);
                $no = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['id_detil_tiket']}</td>
                                <td>{$row['id_tiket']}</td>
                                <td>{$row['kode_tiket']}</td>
                                <td>{$row['status_tiket']}</td>
                                <td>{$row['id_pembayaran']}</td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Data tiket belum tersedia.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
