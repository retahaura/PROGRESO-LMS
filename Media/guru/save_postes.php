<?php
include '../dbconn/dbconn.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

function uploadFile($fileArray, $index) {
    if (!isset($fileArray['error'][$index]) || $fileArray['error'][$index] !== 0) {
        return null;
    }

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $filename = uniqid() . '_' . basename($fileArray['name'][$index]);
    $targetPath = $uploadDir . $filename;

    if (move_uploaded_file($fileArray['tmp_name'][$index], $targetPath)) {
        return $targetPath;
    }

    return null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pertanyaans = $_POST['pertanyaans'];
    $kategori = $_POST['kategori'];

    foreach ($pertanyaans as $index => $data) {
        $pertanyaan = $data['pertanyaan'];
        $jawaban_benar = $data['jawaban_benar'];

        // Upload file sesuai nama field yang flat (array satu dimensi)
        $gambar_pertanyaan = uploadFile($_FILES['gambar_pertanyaan'], $index);
        $gambar_a = uploadFile($_FILES['gambar_a'], $index);
        $gambar_b = uploadFile($_FILES['gambar_b'], $index);
        $gambar_c = uploadFile($_FILES['gambar_c'], $index);
        $gambar_d = uploadFile($_FILES['gambar_d'], $index);
        $gambar_e = uploadFile($_FILES['gambar_e'], $index);

        $stmt = $conn->prepare("INSERT INTO tes (
            kategori, pertanyaan, gambar_pertanyaan,
            jawaban_a, gambar_a,
            jawaban_b, gambar_b,
            jawaban_c, gambar_c,
            jawaban_d, gambar_d,
            jawaban_e, gambar_e,
            jawaban_benar
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssssssssssssss",
            $kategori, $pertanyaan, $gambar_pertanyaan,
            $data['jawaban_a'], $gambar_a,
            $data['jawaban_b'], $gambar_b,
            $data['jawaban_c'], $gambar_c,
            $data['jawaban_d'], $gambar_d,
            $data['jawaban_e'], $gambar_e,
            $jawaban_benar
        );

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    }

    // Redirect setelah submit
    header("Location: kelola_tes.php");
    exit();
}
?>
