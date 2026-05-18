<?php
session_start();
require_once __DIR__ . '/../koneksi.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SPK Prioritas Tugas</title>
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
            <p class="auth-sub">Masuk ke akun kamu</p>

            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/auth/proses_login.php" method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="email@spk.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-primary btn-full">Masuk</button>
            </form>

            <p class="auth-link">Belum punya akun? <a href="<?= BASE_URL ?>/auth/register.php">Daftar</a></p>
        </div>
    </div>
<<<<<<< HEAD
=======
<script src="<?= BASE_URL ?>/js/school-deco.js"></script>
>>>>>>> main
</body>
</html>
