<?php include 'includes/ust.php'; ?>

<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body d-md-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1"><?php echo $projectDetails['title']; ?></h1>
            <p class="text-muted mb-1"><?php echo $projectDetails['subtitle']; ?></p>
            <small class="text-secondary">
                <?php echo $projectDetails['course']; ?> • 
                <?php echo $projectDetails['student']; ?> (<?php echo $projectDetails['number']; ?>)
            </small>
        </div>
        <div class="mt-3 mt-md-0 text-md-end">
            <span class="badge bg-primary"><i class="fa-solid fa-mobile-screen-button me-1"></i> Cihaz</span>
            <div class="fw-semibold mt-1"><?php echo $projectDetails['device']; ?></div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h4 mb-0">Proje Özeti</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-calendar"></i> <?php echo date("d.m.Y"); ?>
        </button>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="mb-2"><i class="fa-solid fa-circle-info text-primary me-2"></i>Özet</h5>
                <p class="mb-2 text-muted">
                    1.000 kayıt üzerinde SQLite (İlişkisel) ve Hive (NoSQL) için CRUD benchmark çalıştırıldı. Hive, RAM tabanlı yapısı sayesinde
                    yazma ve okumada ciddi hız avantajı sağladı; silmede her ikisi de benzer süre verdi.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <span class="badge bg-primary">Test: 1.000 kayıt</span>
                    <span class="badge bg-success">Kazanan: Hive</span>
                    <span class="badge bg-secondary">Cihaz: <?php echo $projectDetails['device']; ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted mb-2">Öğrenci / Ders</h6>
                <div class="fw-semibold"><?php echo $projectDetails['student']; ?></div>
                <div class="text-muted"><?php echo $projectDetails['number']; ?></div>
                <div class="mt-2 small text-secondary"><?php echo $projectDetails['course']; ?></div>
                <hr class="my-2">
                <div class="small text-muted">Tarih: <?php echo date("d.m.Y"); ?></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card metric-card border-primary p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Test Edilen Veri</h6>
                    <h3>1.000 Adet</h3>
                </div>
                <i class="fa-solid fa-database fa-2x text-primary"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card metric-card border-success p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Kazanan Teknoloji</h6>
                    <h3>Hive (NoSQL)</h3>
                </div>
                <i class="fa-solid fa-trophy fa-2x text-success"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card metric-card border-warning p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Test Cihazı</h6>
                    <h5><?php echo $projectDetails['device']; ?></h5>
                </div>
                <i class="fa-solid fa-mobile-android fa-2x text-warning"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card p-4">
            <h4><i class="fa-solid fa-bullseye"></i> Projenin Amacı</h4>
            <p class="lead text-muted">
                Bu proje, Flutter platformunda <strong>İlişkisel (SQLite)</strong> ve <strong>NoSQL (Hive)</strong> veritabanlarının 
                performanslarını analiz etmek, mimari farklılıklarını incelemek ve mobil uygulama geliştiricileri için 
                doğru tercih kriterlerini belirlemek amacıyla geliştirilmiştir.
            </p>
            <div class="alert alert-info">
                <strong><i class="fa-solid fa-info-circle"></i> Not:</strong> 
                Bu web paneli, mobil uygulamadan elde edilen verilerin sunumu amacıyla PHP kullanılarak dinamik olarak hazırlanmıştır.
            </div>
            <div class="alert alert-secondary mt-2 mb-0">
                <small>Benchmark ve mimari detayları için üst menüden ilgili sayfalara (Performans Testi, Mimari & Kod) bakabilirsiniz.</small>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/alt.php'; ?>
