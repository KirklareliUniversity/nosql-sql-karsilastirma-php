## Mobil Veri Depolama Performans Paneli

SQLite vs Hive karşılaştırmasını sunan basit PHP paneli. Veriler Flutter uygulamasındaki gerçek benchmark’tan alınmıştır.

### Kurulum
1. PHP 8+ kurulu olmalı.
2. Dizine gidin:
   ```bash
   cd "/Users/erenaksoy/Desktop/Web:Mobil Proje/İleri Web Programlama Ödevi/flutter_sunum"
   ```
3. Sunucuyu başlatın:
   ```bash
   php -S localhost:8001
   ```
4. Tarayıcıda açın: `http://localhost:8001/` (önce giriş ekranı gelir).

### Alternatif: XAMPP / htdocs
1. Dosyaları XAMPP `htdocs` içine kopyalayın.  
2. Apache’yi başlatın.  
3. Tarayıcıdan: `http://localhost/` (giriş ekranı gelir).  

### Giriş
- Demo parola: `12345` (dosya: `includes/veri.php`, `$authPassword`)
- Çıkış: menü altındaki “Çıkış” bağlantısı veya `cikis.php`.

### Sayfalar
- `ozet.php`: Genel özet, cihaz, kazanan teknoloji.
- `teori.php`: SQLite/Hive teorik karşılaştırma, kullanım senaryoları.
- `mimari.php`: Repository Pattern, SQLite/Hive data source’ları, Provider ve benchmark akışı.
- `performans.php`: 1000 kayıt CRUD sonuçları, grafik + tablo, test yöntemi adımları.

### Teknik Notlar (Flutter tarafı)
- Repository Pattern: `NoteRepository` arayüzü üzerinden SQLite (`SqliteService`) ve Hive (`HiveService`) uygulanıyor.
- Provider (`NoteProvider`): Platforma göre depo seçiyor; web’de otomatik Hive. Benchmark: clearAll → 1000 insert → read → clearAll; her adım Stopwatch ile ölçülüyor.
- Model (`Note`): Hem Hive adapter’i hem SQLite map dönüşümleri için ortak alanlar (id, title, content, createdAt).

### Güvenlik Notu
Bu panel demo amaçlıdır; yalnızca basit oturum/parola koruması içerir. Üretimde daha güçlü bir auth ve HTTPS gereklidir.

- **Eren Aksoy (1247008012)**
