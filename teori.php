<?php include 'includes/ust.php'; ?>

<h2>Teorik Altyapı ve Karşılaştırma</h2>
<hr>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="mb-2"><i class="fa-solid fa-database text-primary me-2"></i>SQLite ne zaman?</h5>
                <ul class="mb-0">
                    <li>İlişkisel sorgular (JOIN) ve güçlü şema gereksinimi</li>
                    <li>Disk üzerinde kalıcılık ve ACID garantisi</li>
                    <li>Offline-first uygulamalarda deterministik davranış</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="mb-2"><i class="fa-solid fa-bolt text-warning me-2"></i>Hive ne zaman?</h5>
                <ul class="mb-0">
                    <li>En hızlı CRUD, tablo ilişkisi ihtiyacı yok</li>
                    <li>Basit key/value veya model koleksiyonları</li>
                    <li>Web dahil platform genişliği (Flutter web’de SQLite yok)</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0"><i class="fa-solid fa-table"></i> <?php echo $theoryInfo['sqlite']['name']; ?></h5>
            </div>
            <div class="card-body">
                <p><?php echo $theoryInfo['sqlite']['desc']; ?></p>
                <h6>Avantajları:</h6>
                <ul>
                    <?php foreach($theoryInfo['sqlite']['pros'] as $item) echo "<li>$item</li>"; ?>
                </ul>
                <h6 class="text-danger">Dezavantajları:</h6>
                <ul>
                    <?php foreach($theoryInfo['sqlite']['cons'] as $item) echo "<li>$item</li>"; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-danger text-white">
                <h5 class="m-0"><i class="fa-solid fa-box-open"></i> <?php echo $theoryInfo['hive']['name']; ?></h5>
            </div>
            <div class="card-body">
                <p><?php echo $theoryInfo['hive']['desc']; ?></p>
                <h6>Avantajları:</h6>
                <ul>
                    <?php foreach($theoryInfo['hive']['pros'] as $item) echo "<li>$item</li>"; ?>
                </ul>
                <h6 class="text-danger">Dezavantajları:</h6>
                <ul>
                    <?php foreach($theoryInfo['hive']['cons'] as $item) echo "<li>$item</li>"; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4 p-4 bg-light border-0 shadow-sm">
    <h5 class="mb-3"><i class="fa-solid fa-microchip"></i> Teknik Fark Analizi</h5>
    <ul class="mb-2">
        <li><strong>Depolama Yapısı:</strong> SQLite veriyi disk üzerinde B-Tree ile tutar; Hive RAM ağırlıklı çalışır, diske asenkron yazar.</li>
        <li><strong>Şema ve Sorgu:</strong> SQLite tam SQL ve şema göçleri ister; Hive şemasız, ilişkisel sorgu yok.</li>
        <li><strong>Performans:</strong> RAM tabanlı erişim nedeniyle Hive okuma/yazmada düşük ms değerlerine iner; SQLite’ın disk I/O’su yazmada yavaşlatır.</li>
        <li><strong>Taşınabilirlik:</strong> Flutter web’de SQLite yok; Hive tüm platformlarda çalışır.</li>
    </ul>
    <div class="alert alert-secondary mb-0 small">
        <strong>Karar:</strong> İlişkisel ihtiyaç + kesin tutarlılık => SQLite. Hız + basit yapı + web uyumu => Hive.
    </div>
</div>

<?php include 'includes/alt.php'; ?>
