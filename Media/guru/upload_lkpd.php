<?php
include '../dbconn/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];

    // Cek file
    if (isset($_FILES['lkpd_file']) && $_FILES['lkpd_file']['error'] === 0) {
        $file = $_FILES['lkpd_file'];
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
            $stmt = $conn->prepare("INSERT INTO lkpd (judul, file) VALUES (?, ?)");
            $stmt->bind_param("ss", $judul, $targetPath);

            if ($stmt->execute()) {
                header("Location: admin_LKPD.php"); // redirect ke halaman list
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
