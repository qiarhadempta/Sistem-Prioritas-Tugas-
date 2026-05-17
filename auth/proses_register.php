<?php
session_start();
require_once __DIR__ . '/../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/auth/register.php');
    exit;
}

$nama       = trim($_POST['nama'] ?? '');
$email      = trim($_POST['email'] ?? '');
$password   = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi_password'] ?? '';

if (empty($nama) || empty($email) || empty($password) || empty($konfirmasi)) {
    $_SESSION['error'] = 'Semua field wajib diisi.';
    header('Location: ' . BASE_URL . '/auth/register.php');
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['error'] = 'Password minimal 6 karakter.';
    header('Location: ' . BASE_URL . '/auth/register.php');
    exit;
}

if ($password !== $konfirmasi) {
    $_SESSION['error'] = 'Konfirmasi password tidak cocok.';
    header('Location: ' . BASE_URL . '/auth/register.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    $_SESSION['error'] = 'Email sudah terdaftar.';
    header('Location: ' . BASE_URL . '/auth/register.php');
    exit;
}

$hash = password_hash($password, PASSWORD_BCRYPT);
$stmt = $pdo->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
$stmt->execute([$nama, $email, $hash]);

$_SESSION['success'] = 'Akun berhasil dibuat! Silakan login.';
header('Location: ' . BASE_URL . '/auth/login.php');
exit;
