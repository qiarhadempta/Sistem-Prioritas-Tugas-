<?php
$host     = 'localhost';
$dbname   = 'spk_prioritas_tugas';
$username = 'root';
$password = '';

// BASE_URL: sesuaikan dengan nama folder project di www
define('BASE_URL', '/PrioritasTugas_SPK');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
