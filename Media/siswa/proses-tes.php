<?php
include("../dbconn/dbconn.php");
session_start();

$id_siswa = $_SESSION['id_user'];
$id_kategori = $_POST['id_kategori'];

// Ambil semua soal berdasarkan kategori
$sql = "SELECT id_tes, jawaban_benar FROM tes WHERE id_kategori = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_kategori);
$stmt->execute();
$result = $stmt->get_result();

$total_score = 0;
$total_questions = $result->num_rows;

// ====== SIMPAN RINGKASAN HASIL TERLEBIH DULU (hasil_tes) ======
$status = 1;
$tanggal = date('Y-m-d H:i:s');

$sql_hasil = "INSERT INTO hasil_tes (id_siswa, id_kategori, skor, status, waktu_submit)
              VALUES (?, ?, 0, ?, ?)";
$stmt_hasil = $conn->prepare($sql_hasil);
$stmt_hasil->bind_param("iiis", $id_siswa, $id_kategori, $status, $tanggal);
$stmt_hasil->execute();

// Ambil id hasil_tes terbaru
$id_hasil = $stmt_hasil->insert_id;

// ====== LOOP SOAL DAN SIMPAN DETAIL ======
$sql_detail = "INSERT INTO hasil_tes_detail 
               (id_hasil, id_tes, jawaban_siswa, jawaban_benar, keterangan)
               VALUES (?, ?, ?, ?, ?)";
$stmt_detail = $conn->prepare($sql_detail);

while ($row = $result->fetch_assoc()) {

    $id_tes = $row['id_tes'];
    $jawaban_benar = $row['jawaban_benar'];
    $jawaban_siswa = $_POST["question$id_tes"] ?? '';

    // Tentukan benar atau salah
    $keterangan = ($jawaban_siswa === $jawaban_benar) ? "Benar" : "Salah";

    if ($keterangan === "Benar") {
        $total_score++;
    }

    // Simpan detail setiap soal
    $stmt_detail->bind_param(
        "iisss",
        $id_hasil,
        $id_tes,
        $jawaban_siswa,
        $jawaban_benar,
        $keterangan
    );
    $stmt_detail->execute();
}

// Hitung skor persen
$percentage_score = ($total_questions > 0)
                    ? round(($total_score / $total_questions) * 100, 2)
                    : 0;

// ====== UPDATE SKOR KE TABEL hasil_tes ======
$sql_update = "UPDATE hasil_tes SET skor = ? WHERE id_hasil = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("di", $percentage_score, $id_hasil);
$stmt_update->execute();

header("Location: test.php");
exit();
?>
