<?php include 'includes/ust.php'; ?>

<h2>Performans Testi Sonuçları</h2>
<p class="text-muted">1.000 adet veri üzerinde yapılan CRUD işlemleri milisaniye (ms) cinsinden ölçülmüştür.</p>
<hr>

<div class="row mb-4 g-3">
    <div class="col-md-4">
        <div class="card border-success border-2 h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Toplam Veri</small>
                        <h4 class="mb-0">1.000 kayıt</h4>
                    </div>
                    <i class="fa-solid fa-database fa-2x text-success"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-primary border-2 h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Ölçüm Birimi</small>
                        <h4 class="mb-0">ms (milisaniye)</h4>
                    </div>
                    <i class="fa-solid fa-stopwatch fa-2x text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-warning border-2 h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Öne Çıkan</small>
                        <h4 class="mb-0 text-warning">Hive <i class="fa-solid fa-trophy ms-1"></i></h4>
                    </div>
                    <i class="fa-solid fa-bolt fa-2x text-warning"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card p-3">
            <canvas id="benchmarkChart"></canvas>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Detaylı Veriler
            </div>
            <table class="table table-striped m-0">
                <thead>
                    <tr>
                        <th>İşlem</th>
                        <th>SQLite</th>
                        <th>Hive</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    for($i=0; $i<3; $i++) {
                        echo "<tr>";
                        echo "<td>" . $benchmarkData['labels'][$i] . "</td>";
                        echo "<td>" . $benchmarkData['sqlite'][$i] . " ms</td>";
                        echo "<td class='fw-bold text-success'>" . $benchmarkData['hive'][$i] . " ms</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                Kısa Yorum
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li>Insert: Hive, SQLite’a göre ~4x daha hızlı.</li>
                    <li>Read: Hive, RAM tabanlı olduğu için neredeyse anlık (1 ms).</li>
                    <li>Delete: Her ikisi de 1 ms, veri küçüldükçe fark kapanıyor.</li>
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                Test Yöntemi (Flutter NoteProvider)
            </div>
            <div class="card-body">
                <ol class="mb-0 small">
                    <li>Depoyu temizle: <code>clearAll()</code></li>
                    <li>1000 adet insert: her biri <code>Note(title, content, createdAt)</code></li>
                    <li>Okuma: <code>getNotes()</code></li>
                    <li>Silme: <code>clearAll()</code> ile tablo/box boşaltılır</li>
                    <li>Süre: her adım <code>Stopwatch</code> ile ölçülür (ms)</li>
                </ol>
            </div>
        </div>

        <div class="alert alert-warning mt-3">
            <small><strong>Not:</strong> Düşük milisaniye daha iyi performans demektir. Ölçümler 1.000 kayıt için alınmıştır.</small>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('benchmarkChart').getContext('2d');
    const benchmarkChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($benchmarkData['labels']); ?>,
            datasets: [{
                label: 'SQLite (ms)',
                data: <?php echo json_encode($benchmarkData['sqlite']); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Hive (ms)',
                data: <?php echo json_encode($benchmarkData['hive']); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Süre (Milisaniye)' }
                }
            }
        }
    });
</script>

<?php include 'includes/alt.php'; ?>
