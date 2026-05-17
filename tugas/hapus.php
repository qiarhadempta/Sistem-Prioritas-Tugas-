<?php
session_start();
require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/../includes/session.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT nama_tugas FROM tugas WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$tugas = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tugas) {
    $_SESSION['error'] = 'Tugas tidak ditemukan.';
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM tugas WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);

$_SESSION['success'] = "Tugas \"{$tugas['nama_tugas']}\" berhasil dihapus.";
header('Location: ' . BASE_URL . '/index.php');
exit;
