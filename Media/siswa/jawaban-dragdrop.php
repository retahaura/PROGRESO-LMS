<?php
include '../dbconn/dbconn.php';
session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit();
}

$id_siswa = $_SESSION['id_user'];
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['id_materi']) || !isset($data['answers'])) {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap."]);
    exit();
}

$id_materi = intval($data['id_materi']);
$answers   = $data['answers'];

// Hitung skor
$total = count($answers);
$benar = 0;

foreach ($answers as $ans) {
    $id_gambar   = intval($ans['id']);
    $pilih_label = $ans['pilih_label'];

    // Ambil jawaban benar
    $stmt = $conn->prepare("SELECT label FROM drag_drop WHERE id = ?");
    $stmt->bind_param("i", $id_gambar);
    $stmt->execute();
    $stmt->bind_result($label_benar);
    $stmt->fetch();
    $stmt->close();

    // Cek jawaban
    $isCorrect = (strtolower(trim($pilih_label)) == strtolower(trim($label_benar))) ? 1 : 0;
    if ($isCorrect) $benar++;

    // Simpan jawaban siswa
    $stmt2 = $conn->prepare("INSERT INTO jawaban_dragdrop 
        (id_siswa, id_materi, id_gambar, pilih_label, benar, waktu_submit)
        VALUES (?, ?, ?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE pilih_label=VALUES(pilih_label), benar=VALUES(benar), waktu_submit=NOW()");
    $stmt2->bind_param("iiisi", $id_siswa, $id_materi, $id_gambar, $pilih_label, $isCorrect);
    $stmt2->execute();
    $stmt2->close();
}

$score = ($total > 0) ? ($benar / $total) * 100 : 0;

// Simpan skor ke tabel terpisah
$stmt3 = $conn->prepare("INSERT INTO skor_dragdrop 
    (id_siswa, id_materi, total_soal, benar, skor, waktu)
    VALUES (?, ?, ?, ?, ?, NOW())
    ON DUPLICATE KEY UPDATE total_soal=VALUES(total_soal), benar=VALUES(benar), skor=VALUES(skor), waktu=NOW()");
$stmt3->bind_param("iiiid", $id_siswa, $id_materi, $total, $benar, $score);
$stmt3->execute();
$stmt3->close();

// Kirim response
echo json_encode([
    "success" => true,
    "score"   => $score,
    "message" => "Jawaban tersimpan. Benar: $benar dari $total. Skor: $score"
]);
