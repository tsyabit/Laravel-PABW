<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login_admin.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "wisata_garut");

$tables = [
    'wisatawan', 'tiket', 'pemesanan', 'tour_guide',
    'agen_wisata', 'lokasi_wisata', 'feedback'
];

$data_total = [];
foreach ($tables as $table) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM $table");
    $row = mysqli_fetch_assoc($result);
    $data_total[$table] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Sinergi Pariwisata Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a2e8a13c8a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f9f9f9;
        }
        .admin-card {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: 0.3s;
        }
        .admin-card:hover {
            transform: translateY(-4px);
        }
        .admin-card i {
            font-size: 28px;
            margin-bottom: 10px;
            color: #007bff;
        }
        #doughnutChart {
            max-width: 300px;
            max-height: 300px;
            margin: auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">🌄 Sinergi Garut</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="admin.php">Dashboard Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="mb-4 text-center">📊 Dashboard Admin</h2>

    <div class="row g-4 mb-4">
        <?php
        $admin_menu = [
            'Kelola Wisatawan' => ['link' => 'wisatawan.php', 'icon' => 'fa-users'],
            'Kelola Tiket' => ['link' => 'tiket.php', 'icon' => 'fa-ticket-alt'],
            'Pemesanan' => ['link' => 'pemesanan.php', 'icon' => 'fa-calendar-check'],
            'Tour Guide' => ['link' => 'tour_guide.php', 'icon' => 'fa-user-tie'],
            'Agen Wisata' => ['link' => 'agen_wisata.php', 'icon' => 'fa-building'],
            'Lokasi Wisata' => ['link' => 'lokasi_wisata.php', 'icon' => 'fa-map-marked-alt'],
            'Feedback' => ['link' => 'feedback.php', 'icon' => 'fa-comments'],
        ];

        foreach ($admin_menu as $label => $data) {
            echo "
            <div class='col-6 col-md-4 col-lg-3'>
                <a href='{$data['link']}' class='text-decoration-none text-dark'>
                    <div class='admin-card text-center h-100'>
                        <i class='fas {$data['icon']}'></i>
                        <h6>{$label}</h6>
                    </div>
                </a>
            </div>";
        }
        ?>
    </div>

    <h5 class="text-center mt-5 mb-3">📈 Statistik Total Data</h5>
   <div class="d-flex justify-content-center">
    <canvas id="doughnutChart" style="max-width: 500px; max-height: 500px;"></canvas>
</div>


</div>

<footer class="mt-5 text-center text-muted small">
    <hr>
    &copy; <?= date('Y') ?> Sinergi Pariwisata Garut | Halaman Admin
</footer>

<script>
const ctx = document.getElementById('doughnutChart').getContext('2d');
const doughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: <?= json_encode(array_map('ucwords', str_replace("_", " ", $tables))) ?>,
        datasets: [{
            data: <?= json_encode(array_values($data_total)) ?>,
            backgroundColor: [
                '#FF6384', '#FF9F40', '#FFCD56', '#4BC0C0',
                '#9966FF', '#36A2EB', '#FF6384'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' },
            title: {
                display: false,
                text: 'Statistik Total Data'
            }
        }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
