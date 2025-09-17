<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM wisatawan WHERE email='$email'");
    if (mysqli_num_rows($query) == 1) {
        $data = mysqli_fetch_assoc($query);
        if (password_verify($pass, $data['password'])) {
            $_SESSION['id_wisatawan'] = $data['id_wisatawan'];
            $_SESSION['nama'] = $data['nama'];
            echo "<script>alert('Login berhasil!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Wisatawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb 10">🌄</h1>
    <h3 class="text-center mb-4">Login Wisatawan</h3>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST">
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                <p class="text-center mt-2">Belum punya akun? <a href="register.php">Daftar</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
