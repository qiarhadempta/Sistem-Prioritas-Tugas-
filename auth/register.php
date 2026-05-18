<?php
session_start();
require_once __DIR__ . '/../koneksi.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}
$error   = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['error'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — SPK Prioritas Tugas</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
<<<<<<< HEAD
=======
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/school-bg.css">
>>>>>>> main
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-box">
<<<<<<< HEAD
            <h1 class="auth-title">SPK <span>Prioritas Tugas</span></h1>
=======
            <h1 class="auth-title"><span class="brand-edu">Edu</span><span class="brand-flow">Flow</span></h1>
>>>>>>> main
            <p class="auth-sub">Buat akun baru</p>

            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/auth/proses_register.php" method="POST">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Nama kamu" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="email@contoh.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="konfirmasi_password" placeholder="Ulangi password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-full">Daftar</button>
            </form>

            <p class="auth-link">Sudah punya akun? <a href="<?= BASE_URL ?>/auth/login.php">Masuk</a></p>
        </div>
    </div>
<<<<<<< HEAD
=======
<script src="<?= BASE_URL ?>/js/school-deco.js"></script>
>>>>>>> main
</body>
</html>
