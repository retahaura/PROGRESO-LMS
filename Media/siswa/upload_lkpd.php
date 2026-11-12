<?php
include '../dbconn/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_lkpd = $_POST['id_lkpd'];
    $id_user = $_POST['id_user'];

    // Cek file
    if (isset($_FILES['jawaban']) && $_FILES['jawaban']['error'] === 0) {
        $file = $_FILES['jawaban'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Validasi hanya PDF
        if ($ext !== 'pdf') {
            echo "Hanya file PDF yang diperbolehkan.";
            exit();
        }

        // Simpan file
        $uploadDir = 'uploads/lkpd/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $filename = uniqid() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Simpan ke database
            $stmt = $conn->prepare("INSERT INTO jawaban_lkpd (id_lkpd, id_users, file) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $id_lkpd, $id_user, $targetPath);

            if ($stmt->execute()) {
                header("Location: LKPD.php"); // redirect ke halaman list
                exit();
            } else {
                echo "Gagal menyimpan ke database: " . $stmt->error;
            }
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "Tidak ada file diunggah atau terjadi kesalahan.";
    }
}
?>
