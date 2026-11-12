<?php
include '../dbconn/dbconn.php';

$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$role = $_POST['role'];

if (!$id_user || !$nama || !$username || !$role) {
  echo "Data tidak lengkap";
  exit;
}

$stmt = $conn->prepare("UPDATE users SET nama=?, username=?, role=? WHERE id_user=?");
$stmt->bind_param("sssi", $nama, $username, $role, $id_user);

if ($stmt->execute()) {
  echo "success";
} else {
  echo "Gagal: " . $conn->error;
}
