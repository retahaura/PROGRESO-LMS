<?php
include '../dbconn/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input
    $judul = isset($_POST['judul']) ? trim($_POST['judul']) : '';
    $id_materi = isset($_POST['id_materi']) ? (int)$_POST['id_materi'] : 0;

    if (empty($judul) || $id_materi === 0) {
        echo "Judul dan ID Materi wajib diisi.";
        exit();
    }

    // Validasi file
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== 0) {
        echo "File tidak ditemukan atau terjadi error saat upload.";
        exit();
    }

    $file = $_FILES['file'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if ($ext !== 'pdf') {
        echo "Hanya file PDF yang diperbolehkan.";
        exit();
    }

    // Validasi ukuran file (opsional: max 10MB)
    if ($file['size'] > 10 * 1024 * 1024) {
        echo "Ukuran file terlalu besar. Maksimal 5MB.";
        exit();
    }

    // Lokasi penyimpanan
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Buat nama file aman
    $safeName = preg_replace("/[^a-zA-Z0-9_\.-]/", "_", basename($file['name']));
    $filename = uniqid('pdf_') . '_' . $safeName;
    $targetPath = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        // Simpan ke database
        $stmt = $conn->prepare("INSERT INTO materi_tambahan (id_materi, judul, file) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id_materi, $judul, $targetPath);

        if ($stmt->execute()) {
            header("Location: materi_tambahan.php?materi=$id_materi");
            exit();
        } else {
            echo "Gagal menyimpan ke database: " . $stmt->error;
        }
    } else {
        echo "Gagal mengunggah file ke server.";
    }
} else {
    echo "Metode akses tidak valid.";
}
?>
