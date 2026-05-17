<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    require_once __DIR__ . '/../koneksi.php';
    header('Location: ' . BASE_URL . '/auth/login.php');
    exit;
}
