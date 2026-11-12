<?php
include '../dbconn/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil id_materi dengan benar
    $id_materi = isset($_POST['id_materi']) ? (int)$_POST['id_materi'] : 0;
    $jumlah = count($_POST['esai']);
    $upload_dir = "uploads/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    for ($i = 0; $i < $jumlah; $i++) {
        $pertanyaan = htmlspecialchars($_POST['esai'][$i]);

        $gambar_name = $_FILES['gambar']['name'][$i];
        $gambar_tmp = $_FILES['gambar']['tmp_name'][$i];
        $gambar_path = NULL;

        if (!empty($gambar_name)) {
            $target_file = $upload_dir . uniqid() . "_" . basename($gambar_name);
            if (move_uploaded_file($gambar_tmp, $target_file)) {
                $gambar_path = $target_file;
            }
        }

        // Simpan ke DB termasuk id_materi
        $stmt = $conn->prepare("INSERT INTO analisis (id_materi, pertanyaan, gambar) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id_materi, $pertanyaan, $gambar_path);

        if (!$stmt->execute()) {
            echo "Gagal menyimpan soal ke-$i: " . $stmt->error;
        }
    }

    header("Location: analisis_lanjutan.php?materi=$id_materi");
    exit();

} else {
    echo "Akses tidak sah.";
}
?>
