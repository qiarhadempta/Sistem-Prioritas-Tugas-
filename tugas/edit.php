<?php
session_start();
require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/../includes/session.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM tugas WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$tugas = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tugas) {
    $_SESSION['error'] = 'Tugas tidak ditemukan.';
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
    <title>Edit Tugas — SPK Prioritas Tugas</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/school-bg.css">
</head>
<body>

<nav class="navbar">
    <div class="navbar-brand"><span class="brand-edu">Edu</span><span class="brand-flow">Flow</span></div>
    <div class="navbar-user">
        <a href="<?= BASE_URL ?>/index.php" class="btn btn-outline btn-sm">← Dashboard</a>
    </div>
</nav>

<div class="container container-sm">
    <h2>Edit Tugas</h2>

    <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/tugas/proses_edit.php" method="POST" class="form-card">
        <input type="hidden" name="id" value="<?= $tugas['id'] ?>">

        <div class="form-group">
            <label>Nama Tugas</label>
            <input type="text" name="nama_tugas" value="<?= htmlspecialchars($tugas['nama_tugas']) ?>" required>
        </div>

        <div class="form-group">
            <label>Deadline</label>
            <input type="datetime-local" name="deadline"
                   value="<?= date('Y-m-d\TH:i', strtotime($tugas['deadline'])) ?>" required>
        </div>

        <div class="form-group">
            <label>Tingkat Kepentingan</label>
            <select name="kepentingan" required>
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <option value="<?= $i ?>" <?= $tugas['kepentingan'] == $i ? 'selected' : '' ?>>
                        <?= $i ?> — <?= ['','Tidak Penting','Kurang Penting','Cukup Penting','Penting','Sangat Penting'][$i] ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tingkat Kesulitan</label>
            <select name="kesulitan" required>
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <option value="<?= $i ?>" <?= $tugas['kesulitan'] == $i ? 'selected' : '' ?>>
                        <?= $i ?> — <?= ['','Sangat Mudah','Mudah','Sedang','Sulit','Sangat Sulit'][$i] ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Estimasi Waktu (jam)</label>
            <input type="number" name="estimasi" value="<?= $tugas['estimasi'] ?>"
                   min="0.5" max="100" step="0.5" required>
        </div>

        <div class="form-group">
            <label>Progress (<span id="progress-val"><?= $tugas['progress'] ?></span>%)</label>
            <input type="range" name="progress" id="progress"
                   min="0" max="100" step="5" value="<?= $tugas['progress'] ?>"
                   oninput="document.getElementById('progress-val').textContent = this.value">
        </div>

        <div class="form-actions">
            <a href="<?= BASE_URL ?>/index.php" class="btn btn-outline">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>

    </form>
</div>

<script src="<?= BASE_URL ?>/js/main.js"></script>
<script src="<?= BASE_URL ?>/js/school-deco.js"></script>
</body>
</html>
