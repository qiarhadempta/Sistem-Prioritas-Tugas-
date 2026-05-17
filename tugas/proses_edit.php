<?php
session_start();
require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/../includes/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

$id          = (int)($_POST['id'] ?? 0);
$nama_tugas  = trim($_POST['nama_tugas'] ?? '');
$deadline    = $_POST['deadline'] ?? '';
$kepentingan = (int)($_POST['kepentingan'] ?? 0);
$kesulitan   = (int)($_POST['kesulitan'] ?? 0);
$estimasi    = (float)($_POST['estimasi'] ?? 0);
$progress    = (int)($_POST['progress'] ?? 0);

$stmt = $pdo->prepare("SELECT id FROM tugas WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
if (!$stmt->fetch()) {
    $_SESSION['error'] = 'Tugas tidak ditemukan.';
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

if (empty($nama_tugas) || empty($deadline) || !$kepentingan || !$kesulitan || !$estimasi) {
    $_SESSION['error'] = 'Semua field wajib diisi.';
    header('Location: ' . BASE_URL . "/tugas/edit.php?id=$id");
    exit;
}

$stmt = $pdo->prepare("
    UPDATE tugas SET nama_tugas=?, deadline=?, kepentingan=?, kesulitan=?, estimasi=?, progress=?
    WHERE id=? AND user_id=?
");
$stmt->execute([
    $nama_tugas, $deadline, $kepentingan, $kesulitan,
    $estimasi, $progress, $id, $_SESSION['user_id']
]);

$_SESSION['success'] = "Tugas \"$nama_tugas\" berhasil diperbarui!";
header('Location: ' . BASE_URL . '/index.php');
exit;
