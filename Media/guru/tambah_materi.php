<?php
include '../dbconn/dbconn.php';
session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    echo "Akses ditolak.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $coverName = $_FILES['cover_materi']['name'];
    $coverTmp = $_FILES['cover_materi']['tmp_name'];
    $coverPath = 'uploads/' . basename($coverName);

    if (move_uploaded_file($coverTmp, $coverPath)) {
        $stmt = $conn->prepare("INSERT INTO materi (judul, cover_materi, deskripsi) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $judul, $coverName, $deskripsi);

        if ($stmt->execute()) {
            echo "Materi berhasil ditambahkan.";
        } else {
            echo "Gagal menambahkan materi: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Gagal mengupload gambar.";
    }
} else {
    echo "Metode tidak valid.";
}
?>
