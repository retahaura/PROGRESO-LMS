<?php
include '../dbconn/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $cover = $_FILES['cover_materi']['name'];
    $tmp = $_FILES['cover_materi']['tmp_name'];

    // Direktori tujuan
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Pindahkan file ke folder uploads
    if (move_uploaded_file($tmp, $uploadDir . $cover)) {
        // Simpan ke database
        $stmt = $conn->prepare("INSERT INTO materi (judul, cover_materi) VALUES (?, ?)");
        $stmt->bind_param("ss", $judul, $cover);

        if ($stmt->execute()) {
            echo "sukses";
        } else {
            echo "Gagal menyimpan data.";
        }
    } else {
        echo "Gagal upload file.";
    }
} else {
    echo "Request tidak valid.";
}
?>
