<?php
include "koneksi.php";

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah email sudah digunakan
    $cek = mysqli_query($conn, "SELECT * FROM wisatawan WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
    } else {
        // Ambil ID terakhir dari tabel wisatawan
        $result = mysqli_query($conn, "SELECT id_wisatawan FROM wisatawan ORDER BY id_wisatawan DESC LIMIT 1");
        $data = mysqli_fetch_assoc($result);

        if ($data) {
            $lastId = (int) substr($data['id_wisatawan'], 1); // Ambil angka saja
            $newId = 'W' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newId = 'W001'; // Jika kosong, mulai dari W001
        }

        $idwis = $newId;

        $query = "INSERT INTO wisatawan (id_wisatawan, nama, email, nohp, password) VALUES ('$idwis', '$nama', '$email', '$nohp', '$password')";
        $insert = mysqli_query($conn, $query);

        if ($insert) {
            echo "<script>alert('Registrasi berhasil! ID Anda: $idwis. Silakan login.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Gagal mendaftar.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Wisatawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">🌄</h1>
    <h3 class="text-center mb-4">Registrasi Wisatawan</h3>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST">
                <!-- Hapus field ID Wisatawan, karena otomatis -->
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="nohp" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="register" class="btn btn-success w-100">Daftar</button>
                <p class="text-center mt-2">Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
