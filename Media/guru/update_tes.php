<?php
include '../dbconn/dbconn.php';

function uploadFile($inputName, $oldPath = null) {
    if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== 0) {
        return $oldPath; // tidak diganti
    }

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir);

    $filename = uniqid() . '_' . basename($_FILES[$inputName]['name']);
    $targetPath = $uploadDir . $filename;

    if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetPath)) {
        return $targetPath;
    }

    return $oldPath;
}

$id = $_POST['id'];
$kategori = $_POST['id_kategori'];
$pertanyaan = $_POST['pertanyaan'];
$jawaban_benar = $_POST['jawaban_benar'];

$sql = "SELECT * FROM tes WHERE id_tes = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$old = $stmt->get_result()->fetch_assoc();

$gambar_pertanyaan = uploadFile('gambar_pertanyaan', $old['gambar_pertanyaan']);
$gambar_a = uploadFile('gambar_a', $old['gambar_a']);
$gambar_b = uploadFile('gambar_b', $old['gambar_b']);
$gambar_c = uploadFile('gambar_c', $old['gambar_c']);
$gambar_d = uploadFile('gambar_d', $old['gambar_d']);
$gambar_e = uploadFile('gambar_e', $old['gambar_e']);

$stmt = $conn->prepare("UPDATE tes SET 
    id_kategori = ?, pertanyaan = ?, gambar_pertanyaan = ?,
    jawaban_a = ?, gambar_a = ?,
    jawaban_b = ?, gambar_b = ?,
    jawaban_c = ?, gambar_c = ?,
    jawaban_d = ?, gambar_d = ?,
    jawaban_e = ?, gambar_e = ?,
    jawaban_benar = ?
    WHERE id_tes = ?");

$stmt->bind_param("isssssssssssssi",
    $kategori, $pertanyaan, $gambar_pertanyaan,
    $_POST['jawaban_a'], $gambar_a,
    $_POST['jawaban_b'], $gambar_b,
    $_POST['jawaban_c'], $gambar_c,
    $_POST['jawaban_d'], $gambar_d,
    $_POST['jawaban_e'], $gambar_e,
    $jawaban_benar, $id
);

if ($stmt->execute()) {
    header("Location: kelola_tes.php");
} else {
    echo "Gagal update: " . $stmt->error;
}
?>
