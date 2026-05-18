<?php
define('BASE_URL', 'http://localhost:8080/');

$host = "127.0.0.1"; // Ubah dari 'db' menjadi '127.0.0.1' agar dia membaca MySQL internalnya
$user = "root";
$pass = "suki"; 
$db   = "spk_prioritas_tugas";
// --- 1. KONEKSI VERSI MYSQLI ---
// (Dipakai untuk file yang menggunakan variabel $koneksi)
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi MySQLi gagal: " . mysqli_connect_error());
}

// --- 2. KONEKSI VERSI PDO ---
// (Dipakai untuk file yang menggunakan variabel $pdo, seperti proses_register.php)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Mengaktifkan mode error exception untuk mempermudah debugging jika ada query salah
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi PDO gagal: " . $e->getMessage());
}
?>