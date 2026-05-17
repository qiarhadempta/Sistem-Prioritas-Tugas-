<?php
/**
 * saw.php
 * Logika perhitungan SAW untuk sistem prioritas tugas
 *
 * Kriteria:
 *   C1 - Deadline    : COST   (bobot 0.35) — sisa jam → nilai 1-5
 *   C2 - Kepentingan : BENEFIT (bobot 0.25) — nilai 1-5
 *   C3 - Kesulitan   : BENEFIT (bobot 0.20) — nilai 1-5
 *   C4 - Estimasi    : BENEFIT (bobot 0.10) — dalam jam
 *   C5 - Progress    : BENEFIT (bobot 0.10) — transformasi: 100 - progress
 */

// Bobot kriteria
define('BOBOT', [
    'c1' => 0.35,
    'c2' => 0.25,
    'c3' => 0.20,
    'c4' => 0.10,
    'c5' => 0.10,
]);

/**
 * Konversi sisa jam deadline ke nilai 1-5
 */
function konversiDeadline(string $deadline): int
{
    $sisaJam = (strtotime($deadline) - time()) / 3600;

    if ($sisaJam < 0)       return 5; // sudah lewat deadline = sangat mendesak
    if ($sisaJam < 24)      return 5;
    if ($sisaJam < 72)      return 4;
    if ($sisaJam < 168)     return 3;
    if ($sisaJam < 360)     return 2;
    return 1;
}

/**
 * Hitung ranking SAW dari array tugas
 * Setiap tugas: [id, nama_tugas, deadline, kepentingan, kesulitan, estimasi, progress]
 */
function hitungSAW(array $tugasList): array
{
    if (empty($tugasList)) return [];

    // Step 1: Siapkan nilai mentah tiap kriteria
    foreach ($tugasList as &$t) {
        $t['c1'] = konversiDeadline($t['deadline']);   // Cost
        $t['c2'] = (int) $t['kepentingan'];            // Benefit
        $t['c3'] = (int) $t['kesulitan'];              // Benefit
        $t['c4'] = (float) $t['estimasi'];             // Benefit
        $t['c5'] = 100 - (int) $t['progress'];        // Benefit (transformasi)
    }
    unset($t);

    // Step 2: Cari min & max tiap kolom
    $min = ['c1' => PHP_INT_MAX];
    $max = ['c2' => PHP_INT_MIN, 'c3' => PHP_INT_MIN, 'c4' => PHP_INT_MIN, 'c5' => PHP_INT_MIN];

    foreach ($tugasList as $t) {
        $min['c1'] = min($min['c1'], $t['c1']);
        $max['c2'] = max($max['c2'], $t['c2']);
        $max['c3'] = max($max['c3'], $t['c3']);
        $max['c4'] = max($max['c4'], $t['c4']);
        $max['c5'] = max($max['c5'], $t['c5']);
    }

    // Step 3: Normalisasi & hitung Vi
    foreach ($tugasList as &$t) {
        // C1 Cost: min/nilai
        $t['r1'] = ($t['c1'] > 0) ? $min['c1'] / $t['c1'] : 0;
        // C2-C5 Benefit: nilai/max
        $t['r2'] = ($max['c2'] > 0) ? $t['c2'] / $max['c2'] : 0;
        $t['r3'] = ($max['c3'] > 0) ? $t['c3'] / $max['c3'] : 0;
        $t['r4'] = ($max['c4'] > 0) ? $t['c4'] / $max['c4'] : 0;
        $t['r5'] = ($max['c5'] > 0) ? $t['c5'] / $max['c5'] : 0;

        // Vi = jumlah (bobot × normalisasi)
        $t['vi'] = round(
            (BOBOT['c1'] * $t['r1']) +
            (BOBOT['c2'] * $t['r2']) +
            (BOBOT['c3'] * $t['r3']) +
            (BOBOT['c4'] * $t['r4']) +
            (BOBOT['c5'] * $t['r5']),
            4
        );
    }
    unset($t);

    // Step 4: Urutkan berdasarkan Vi tertinggi
    usort($tugasList, fn($a, $b) => $b['vi'] <=> $a['vi']);

    // Tambahkan ranking
    foreach ($tugasList as $i => &$t) {
        $t['ranking'] = $i + 1;
    }
    unset($t);

    return $tugasList;
}
