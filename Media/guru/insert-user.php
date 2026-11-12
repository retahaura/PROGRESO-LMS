<?php
include '../dbconn/dbconn.php'; // Pastikan path benar

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

if (!$nama || !$username || !$password || !$role) {
    http_response_code(400);
    echo "Data tidak lengkap";
    exit;
}


$stmt = $conn->prepare("INSERT INTO users (nama, username, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama, $username, $password, $role);

if ($stmt->execute()) {
    echo "success";
} else {
    http_response_code(500);
    echo "Gagal menyimpan: " . $conn->error;
}
?>