<?php
include '../dbconn/dbconn.php';
session_start();

// Pastikan hanya siswa yang bisa submit
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    die("Unauthorized.");
}

$id_siswa   = $_SESSION['id_user'];
$id_materi  = $_POST['id_materi'] ?? null;
$answers    = $_POST['question'] ?? []; // Bentuk: question[id] => 'A'

if (!$id_materi || empty($answers)) {
    die("Data tidak lengkap.");
}

$total = 0;
$benar = 0;

foreach ($answers as $id_soal => $jawaban_siswa) {
    $total++;

    // Ambil kunci jawaban
    $stmt = $conn->prepare("SELECT jawaban_benar FROM pg_materi WHERE id = ? AND id_materi = ?");
    $stmt->bind_param("ii", $id_soal, $id_materi);
    $stmt->execute();
    $stmt->bind_result($jawaban_benar);
    $stmt->fetch();
    $stmt->close();

    // Cek benar/salah
    $isCorrect = (strtoupper(trim($jawaban_siswa)) === strtoupper(trim($jawaban_benar))) ? 1 : 0;
    if ($isCorrect) $benar++;

    // Skor per soal (misalnya 100 dibagi total soal)
    $skor = ($isCorrect) ? (100 / count($answers)) : 0;

    // Simpan jawaban + skor
    $stmt2 = $conn->prepare("INSERT INTO jawaban_pg 
        (id_siswa, id_materi, id_soal, jawaban_siswa, benar, skor, waktu_submit)
        VALUES (?, ?, ?, ?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE 
            jawaban_siswa = VALUES(jawaban_siswa),
            benar = VALUES(benar),
            skor = VALUES(skor),
            waktu_submit = NOW()");
    $stmt2->bind_param("iiisid", $id_siswa, $id_materi, $id_soal, $jawaban_siswa, $isCorrect, $skor);
    $stmt2->execute();
    $stmt2->close();
}

// Skor total
$scoreTotal = ($total > 0) ? ($benar / $total) * 100 : 0;

// Bisa redirect ke halaman hasil
header("Location: eksplorasi-processing.php?id_materi=" . $id_materi . "&skor=" . $scoreTotal . "&show=1");


exit();
