<?php
session_start();
require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/../includes/session.php';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas — SPK Prioritas Tugas</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="navbar-brand">SPK <span>Prioritas Tugas</span></div>
    <div class="navbar-user">
        <a href="<?= BASE_URL ?>/index.php" class="btn btn-outline btn-sm">← Dashboard</a>
    </div>
</nav>

<div class="container container-sm">
    <h2>Tambah Tugas</h2>

    <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/tugas/proses_tambah.php" method="POST" class="form-card">

        <div class="form-group">
            <label>Nama Tugas</label>
            <input type="text" name="nama_tugas" placeholder="cth: Tugas Sistem Pendukung Keputusan" required>
        </div>

        <div class="form-group">
            <label>Deadline</label>
            <input type="datetime-local" name="deadline" required>
            <small class="form-hint">Masukkan tanggal dan jam deadline secara akurat</small>
        </div>

        <div class="form-group">
            <label>Tingkat Kepentingan</label>
            <select name="kepentingan" required>
                <option value="">-- Pilih --</option>
                <option value="5">5 — Sangat Penting</option>
                <option value="4">4 — Penting</option>
                <option value="3">3 — Cukup Penting</option>
                <option value="2">2 — Kurang Penting</option>
                <option value="1">1 — Tidak Penting</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tingkat Kesulitan</label>
            <select name="kesulitan" required>
                <option value="">-- Pilih --</option>
                <option value="5">5 — Sangat Sulit</option>
                <option value="4">4 — Sulit</option>
                <option value="3">3 — Sedang</option>
                <option value="2">2 — Mudah</option>
                <option value="1">1 — Sangat Mudah</option>
            </select>
        </div>

        <div class="form-group">
            <label>Estimasi Waktu Pengerjaan (jam)</label>
            <input type="number" name="estimasi" min="0.5" max="100" step="0.5" placeholder="cth: 8" required>
            <small class="form-hint">Perkiraan total waktu yang dibutuhkan</small>
        </div>

        <div class="form-group">
            <label>Progress Saat Ini (<span id="progress-val">0</span>%)</label>
            <input type="range" name="progress" id="progress" min="0" max="100" step="5" value="0"
                   oninput="document.getElementById('progress-val').textContent = this.value">
        </div>

        <div class="form-actions">
            <a href="<?= BASE_URL ?>/index.php" class="btn btn-outline">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Tugas</button>
        </div>

    </form>
</div>

<script src="<?= BASE_URL ?>/js/main.js"></script>
</body>
</html>
