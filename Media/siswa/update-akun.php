<?php
include '../dbconn/dbconn.php';
session_start();

$id_user = $_SESSION['id_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$konfirmasi = $_POST['konfirmasi'];

// Validasi
if (!empty($password)) {
    if ($password !== $konfirmasi) {
        echo "Password dan konfirmasi tidak cocok!";
        exit();
    }

    // Hash password
    //$password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET nama = ?, username = ?, password = ? WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nama, $username, $password, $id_user);
} else {
    $sql = "UPDATE users SET nama = ?, username = ? WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nama, $username, $id_user);
}

if ($stmt->execute()) {
    echo "Perubahan berhasil disimpan!";
    // redirect atau tampilkan pesan
    header("Location: pengguna.php");
} else {
    echo "Gagal memperbarui data: " . $conn->error;
}
?>
