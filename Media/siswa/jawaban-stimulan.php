<?php
include '../dbconn/dbconn.php';
session_start();

if(!isset($_SESSION['id_user'])){
    header("Location: ../index.php");
    exit();
}

$id_user = $_SESSION['id_user'];

// Cek apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_soal_array = $_POST['id_soal'] ?? [];
    $jawaban_array = $_POST['jawaban'] ?? [];
    $id_materi = $_POST['id_materi'];

    foreach ($id_soal_array as $id_soal) {
        $jawaban = trim($jawaban_array[$id_soal]);

        if ($jawaban !== "") {
            $stmt = $conn->prepare("INSERT INTO jawaban_stimulan (id_user, id_materi, id_soal, jawaban) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $id_user, $id_materi, $id_soal, $jawaban);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Redirect ke halaman lain setelah submit
    header("Location: eksplorasi-stimulation.php?id_materi=$id_materi&show=1");
    exit();
} else {
    echo "Akses tidak valid.";
}
?>
?>