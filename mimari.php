<?php include 'includes/ust.php'; ?>

<h2>Yazılım Mimarisi ve Kod Yapısı</h2>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card p-4">
            <h4><i class="fa-solid fa-sitemap"></i> Repository Pattern</h4>
            <p>
                Flutter tarafında <strong>Repository Design Pattern</strong> ile veri katmanı soyutlanır. UI sadece kontratı bilir; hangi veritabanının
                kullanıldığına dair bilgi <em>NoteRepository</em> implementasyonlarında gizlenir. Provider (State + İş Mantığı) çalışılan platforma göre
                uygun depoyu seçer (web: yalnızca Hive; mobil: SQLite veya Hive) ve benchmark senaryosunu koşturur.
            </p>
            <div class="alert alert-info mb-0">
                <i class="fa-solid fa-lightbulb me-1"></i> Akış: UI → Provider → Repository (Interface) → DataSource (SQLite/Hive)
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Repository Arayüzü (lib/data/repository_interface.dart)
            </div>
            <div class="card-body bg-light">
                <p class="mb-2 small text-muted">
                    UI/Provider’ın bağımlılığı bu kontrata. Platforma göre hangi implementasyon geleceği önemli değil; tüm işlemler aynı imzayla yapılır.
                </p>
<pre><code>
abstract class NoteRepository {
  Future<void> init();
  Future<List<Note>> getNotes();
  Future<Note> addNote(Note note);
  Future<void> updateNote(Note note);
  Future<void> deleteNote(int id);
  Future<void> clearAll();
  Future<void> close();
}
</code></pre>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Model (lib/models/note_model.dart)
            </div>
            <div class="card-body bg-light">
                <p class="mb-2 small text-muted">
                    Model, hem Hive hem SQLite ile uyumlu olacak şekilde alanları barındırır. <code>toMap()</code> / <code>fromMap()</code> SQLite için;
                    Hive adapter’ı aynı alanları kullanır.
                </p>
<pre><code>
@HiveType(typeId: 0)
class Note extends HiveObject {
  @HiveField(0)
  int? id;

  @HiveField(1)
  String title;

  @HiveField(2)
  String content;

  @HiveField(3)
  DateTime createdAt;

  Map&lt;String, dynamic&gt; toMap() { ... }
  factory Note.fromMap(Map&lt;String, dynamic&gt; map) { ... }
}
</code></pre>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                SQLite DataSource (lib/data/sqlite_service.dart)
            </div>
            <div class="card-body bg-light">
                <p class="mb-2 small text-muted">
                    Mobilde geçerli. Dosya tabanlı SQLite veritabanı, tabloyu oluşturur ve CRUD + temizleme akışını uygular. Web’de sqflite desteklenmediği
                    için Provider otomatik olarak Hive’a döner.
                </p>
<pre><code>
class SqliteService implements NoteRepository {
  static const _dbName = 'notes.db';
  static const _tableName = 'notes';
  Database? _db;

  Future<void> init() async {
    final docsDir = await getApplicationDocumentsDirectory();
    final dbPath = join(docsDir.path, _dbName);
    _db = await openDatabase(
      dbPath,
      version: 1,
      onCreate: (db, version) async {
        await db.execute('''
          CREATE TABLE $_tableName(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            content TEXT NOT NULL,
            createdAt TEXT NOT NULL
          )
        ''');
      },
    );
  }

  Future<Note> addNote(Note note) async {
    final id = await _database.insert(_tableName, note.toMap());
    return note.copyWith(id: id);
  }

  Future<List<Note>> getNotes() async {
    final result = await _database.query(_tableName, orderBy: 'createdAt DESC');
    return result.map((map) => Note.fromMap(map)).toList();
  }

  Future<void> clearAll() async => _database.delete(_tableName);
  Future<void> close() async => _db?.close();
}
</code></pre>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-danger text-white">
                Hive DataSource (lib/data/hive_service.dart)
            </div>
            <div class="card-body bg-light">
                <p class="mb-2 small text-muted">
                    Platform bağımsız çalışır (web dahil). Box açılır, adapter idempotent kayıt edilir, eklenen kaydın ID’si geri yazılarak UI tarafında
                    güncel nesne döndürülür.
                </p>
<pre><code>
class HiveService implements NoteRepository {
  static const _boxName = 'notesBox';
  Box<Note>? _box;

  Future<void> init() async {
    await Hive.initFlutter();
    if (!Hive.isAdapterRegistered(0)) {
      Hive.registerAdapter(NoteAdapter());
    }
    _box = await Hive.openBox<Note>(_boxName);
  }

  Future<Note> addNote(Note note) async {
    final key = await _notesBox.add(note);
    final stored = note.copyWith(id: key);
    await _notesBox.put(key, stored);
    return stored;
  }

  Future<List<Note>> getNotes() async =>
      _notesBox.values.toList().reversed.toList();

  Future<void> clearAll() async => _notesBox.clear();
  Future<void> close() async => _box?.close();
}
</code></pre>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Provider + Benchmark (lib/providers/note_provider.dart)
            </div>
            <div class="card-body bg-light">
                <p class="mb-2 small text-muted">
                    Provider, mevcut platforma göre kullanılabilir depoları hazırlar, UI’dan gelen isteklere aynı imzayla cevap verir ve 1000 kayıtlık
                    insert-read-delete benchmark’ını çalıştırır. Test başlamadan temizler, her adımı ölçer, sonunda tekrar temizler.
                </p>
                <ul class="small text-muted">
                    <li><code>initialize()</code>: tüm depoları <code>init()</code>, yoksa Hive’a düşer (web).</li>
                    <li><code>runBenchmark()</code>: <code>clearAll</code> → 1000 <code>addNote</code> → <code>getNotes</code> → <code>clearAll</code>, her adım <code>Stopwatch</code> ile ölçülür.</li>
                    <li>Sonuçlar: <code>BenchmarkResult(insertMs, readMs, deleteMs)</code> döner.</li>
                </ul>
<pre><code>
enum StorageType { sqlite, hive }

class NoteProvider extends ChangeNotifier {
  late final Map<StorageType, NoteRepository> _repositories;
  StorageType _current = StorageType.sqlite;

  NoteProvider() {
    _repositories = kIsWeb
        ? {StorageType.hive: HiveService()}
        : {StorageType.sqlite: SqliteService(), StorageType.hive: HiveService()};
    if (kIsWeb) _current = StorageType.hive;
  }

  Future<void> initialize() async {
    for (final repo in _repositories.values) {
      await repo.init();
    }
    await loadNotes();
  }

  Future<BenchmarkResult> runBenchmark() async {
    await _repo.clearAll();
    final insert = _measure(() async {
      for (var i = 0; i < 1000; i++) {
        await _repo.addNote(Note(title: 'Dummy $i', content: '...', createdAt: DateTime.now()));
      }
    });
    final read = _measure(() => _repo.getNotes());
    final del = _measure(() => _repo.clearAll());
    return BenchmarkResult(insertMs: insert, readMs: read, deleteMs: del);
  }
}
</code></pre>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/alt.php'; ?>
