<?php
// includes/data.php

$projectDetails = [
    "title" => "Mobil Veri Depolama Performans Analizi",
    "subtitle" => "SQLite vs Hive: Flutter İmplementasyonu",
    "student" => "Eren Aksoy",
    "number" => "1247008012",
    "course" => "Mobil Programlama",
    "device" => "Google Pixel 6 (API 33) - Emulator"
];

// Basit demo erişim parolası
$authPassword = "12345";

// Benchmark Verileri (Gerçek Test Sonuçları)
$benchmarkData = [
    "labels" => ["Yazma (Insert)", "Okuma (Read)", "Silme (Delete)"],
    "sqlite" => [1985, 17, 1],
    "hive"   => [490, 1, 1]
];

// Teorik Bilgiler
$theoryInfo = [
    "sqlite" => [
        "name" => "SQLite (İlişkisel)",
        "desc" => "Sunucusuz, yapılandırma gerektirmeyen, işlemsel SQL veritabanı motoru.",
        "pros" => ["ACID Tam Uyumluluk", "Karmaşık Sorgular (JOIN)", "Standart SQL Dili"],
        "cons" => ["Yavaş Yazma Hızı", "Zor Şema Değişimi", "Disk I/O Bağımlılığı"]
    ],
    "hive" => [
        "name" => "Hive (NoSQL)",
        "desc" => "Flutter için özel geliştirilmiş, hafif ve hızlı anahtar-değer veritabanı.",
        "pros" => ["RAM Tabanlı Okuma", "Kurulum Kolaylığı", "Dart ile %100 Uyumlu"],
        "cons" => ["İlişkisel Sorgu Yok", "Büyük Veride RAM Tüketimi", "Sorgu Dili Yok"]
    ]
];
?>
