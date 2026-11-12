<?php
include "../dbconn/dbconn.php";

// Tangkap id_materi dari query string
if (isset($_GET['id_materi'])) {
    $id_materi = intval($_GET['id_materi']);
} else {
    die(json_encode(['error' => 'ID pembelajaran tidak diberikan.']));
}

// Ambil data kuis berdasarkan id_materi
$query = $conn->prepare("
    SELECT id, gambar, label 
    FROM drag_drop 
    WHERE id_materi = ?
");
$query->bind_param("i", $id_materi);
$query->execute();
$result = $query->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);

$query->close();
$conn->close();
?>
