<?php
session_start();
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/includes/session.php';
require_once __DIR__ . '/includes/saw.php';

$stmt = $pdo->prepare("SELECT * FROM tugas WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$tugasList = $stmt->fetchAll(PDO::FETCH_ASSOC);

$ranked = hitungSAW($tugasList);

$success = $_SESSION['success'] ?? '';
$error   = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — SPK Prioritas Tugas</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
<<<<<<< HEAD
=======
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/school-bg.css">
>>>>>>> main
</head>
<body>

<nav class="navbar">
<<<<<<< HEAD
    <div class="navbar-brand">SPK <span>Prioritas Tugas</span></div>
=======
    <div class="navbar-brand"><span class="brand-edu">Edu</span><span class="brand-flow">Flow</span></div>
>>>>>>> main
    <div class="navbar-user">
        Halo, <strong><?= htmlspecialchars($_SESSION['nama']) ?></strong>
        <a href="<?= BASE_URL ?>/auth/logout.php" class="btn btn-outline btn-sm">Keluar</a>
    </div>
</nav>

<div class="container">

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="page-header">
        <div>
            <h2>Daftar Tugas</h2>
            <p class="text-muted">Tugas diurutkan berdasarkan prioritas tertinggi (metode SAW)</p>
        </div>
        <a href="<?= BASE_URL ?>/tugas/tambah.php" class="btn btn-primary">+ Tambah Tugas</a>
    </div>

    <?php if (empty($ranked)): ?>
        <div class="empty-state">
            <p>Belum ada tugas. <a href="<?= BASE_URL ?>/tugas/tambah.php">Tambah tugas pertama kamu!</a></p>
        </div>
    <?php else: ?>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Nama Tugas</th>
                    <th>Deadline</th>
                    <th>Kepentingan</th>
                    <th>Kesulitan</th>
                    <th>Estimasi</th>
                    <th>Progress</th>
                    <th>Nilai Vi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ranked as $t): ?>
                <tr class="<?= $t['ranking'] <= 3 ? 'row-top-' . $t['ranking'] : '' ?>">
                    <td class="rank-cell">
                        <?php if ($t['ranking'] === 1): ?>🥇
                        <?php elseif ($t['ranking'] === 2): ?>🥈
                        <?php elseif ($t['ranking'] === 3): ?>🥉
                        <?php else: ?><?= $t['ranking'] ?>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= htmlspecialchars($t['nama_tugas']) ?></strong></td>
                    <td><?= date('d M Y, H:i', strtotime($t['deadline'])) ?></td>
                    <td><?= str_repeat('★', $t['kepentingan']) ?></td>
                    <td><?= str_repeat('★', $t['kesulitan']) ?></td>
                    <td><?= $t['estimasi'] ?> jam</td>
                    <td>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?= $t['progress'] ?>%"></div>
                        </div>
                        <small><?= $t['progress'] ?>%</small>
                    </td>
                    <td><strong><?= $t['vi'] ?></strong></td>
                    <td>
                        <a href="<?= BASE_URL ?>/tugas/edit.php?id=<?= $t['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                        <a href="<?= BASE_URL ?>/tugas/hapus.php?id=<?= $t['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus tugas ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="info-box">
        <strong>Bobot Kriteria SAW:</strong>
        Deadline 35% · Kepentingan 25% · Kesulitan 20% · Estimasi Waktu 10% · Progress 10%
    </div>
    <?php endif; ?>

</div>

<script src="<?= BASE_URL ?>/js/main.js"></script>
<<<<<<< HEAD
=======
<script src="<?= BASE_URL ?>/js/school-deco.js"></script>
>>>>>>> main
</body>
</html>
