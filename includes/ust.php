<?php
include 'veri.php';
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
$publicPages = ['giris.php'];
$isAuthed = !empty($_SESSION['authed']);
if (!$isAuthed && !in_array($currentPage, $publicPages, true)) {
    header('Location: giris.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $projectDetails['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar { min-height: 100vh; background: #2c3e50; color: #fff; }
        .nav-link { color: rgba(255,255,255,0.8); margin-bottom: 5px; }
        .nav-link:hover, .nav-link.active { color: #fff; background: rgba(255,255,255,0.1); border-radius: 5px; }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .metric-card { border-left: 5px solid; }
        @media (max-width: 767.98px) {
            .sidebar { min-height: unset; }
            .mobile-topbar { padding: 10px 14px; width: 100%; }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="d-md-none bg-dark text-white d-flex justify-content-between align-items-center mobile-topbar">
        <span><i class="fa-solid fa-mobile-screen me-2"></i> Menü</span>
        <button class="btn btn-outline-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 sidebar collapse d-md-block p-3">
            <h4 class="text-center mb-4"><i class="fa-solid fa-mobile-screen"></i> Mobil Analiz</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="ozet.php"><i class="fa-solid fa-chart-line me-2"></i> Özet</a></li>
                <li class="nav-item"><a class="nav-link" href="teori.php"><i class="fa-solid fa-book-open me-2"></i> Teorik Altyapı</a></li>
                <li class="nav-item"><a class="nav-link" href="mimari.php"><i class="fa-solid fa-code me-2"></i> Mimari & Kod</a></li>
                <li class="nav-item"><a class="nav-link" href="performans.php"><i class="fa-solid fa-stopwatch me-2"></i> Performans Testi</a></li>
            </ul>
            <div class="mt-5 text-center small text-white-50">
                <?php echo $projectDetails['student']; ?><br>
                <?php echo $projectDetails['number']; ?>
                <div class="mt-2">
                    <a class="text-white-50 text-decoration-none" href="cikis.php"><i class="fa-solid fa-right-from-bracket me-1"></i> Çıkış</a>
                </div>
            </div>
        </nav>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
