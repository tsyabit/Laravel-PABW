<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_inap = $_POST['id_inap'];
    $nama = $_POST['nama_pemesan'];
    $checkin = $_POST['checkin'];
    $malam = $_POST['malam'];

    // Buat ID Pemesanan otomatis
    $result = $conn->query("SELECT MAX(id_pemesanan) AS maxid FROM pemesanan_penginapan");
    $row = $result->fetch_assoc();
    $lastId = $row['maxid'];
    $newId = 'PI' . str_pad((int)substr($lastId, 2) + 1, 3, '0', STR_PAD_LEFT);

    $sql = "INSERT INTO pemesanan_penginapan (id_pemesanan, id_inap, nama_pemesan, tgl_checkin, jumlah_malam)
            VALUES ('$newId', '$id_inap', '$nama', '$checkin', '$malam')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Pemesanan berhasil!');
                window.location.href = 'penginapan.php';
              </script>";
    } else {
        echo "Gagal menyimpan: " . $conn->error;
    }

    $conn->close();
}
?>
