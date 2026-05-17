<?php
session_start();
require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/../includes/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/tugas/tambah.php');
    exit;
}

$nama_tugas  = trim($_POST['nama_tugas'] ?? '');
$deadline    = $_POST['deadline'] ?? '';
$kepentingan = (int)($_POST['kepentingan'] ?? 0);
$kesulitan   = (int)($_POST['kesulitan'] ?? 0);
$estimasi    = (float)($_POST['estimasi'] ?? 0);
$progress    = (int)($_POST['progress'] ?? 0);

if (empty($nama_tugas) || empty($deadline) || !$kepentingan || !$kesulitan || !$estimasi) {
    $_SESSION['error'] = 'Semua field wajib diisi dengan benar.';
    header('Location: ' . BASE_URL . '/tugas/tambah.php');
    exit;
}

if ($kepentingan < 1 || $kepentingan > 5 || $kesulitan < 1 || $kesulitan > 5) {
    $_SESSION['error'] = 'Nilai kepentingan dan kesulitan harus antara 1-5.';
    header('Location: ' . BASE_URL . '/tugas/tambah.php');
    exit;
}

if ($progress < 0 || $progress > 100) {
    $_SESSION['error'] = 'Progress harus antara 0-100.';
    header('Location: ' . BASE_URL . '/tugas/tambah.php');
    exit;
}

$stmt = $pdo->prepare("
    INSERT INTO tugas (user_id, nama_tugas, deadline, kepentingan, kesulitan, estimasi, progress)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->execute([
    $_SESSION['user_id'],
    $nama_tugas,
    $deadline,
    $kepentingan,
    $kesulitan,
    $estimasi,
    $progress
]);

$_SESSION['success'] = "Tugas \"$nama_tugas\" berhasil ditambahkan!";
header('Location: ' . BASE_URL . '/index.php');
exit;
