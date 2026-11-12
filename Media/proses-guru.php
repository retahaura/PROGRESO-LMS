<?php
session_start();
include 'dbconn/dbconn.php';

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];
$role = 'guru';

// Escape string untuk keamanan
//$username = $conn->real_escape_string($username);
//$password = md5($password); // Ganti dengan password_hash / password_verify jika ingin lebih aman

// Cek di database
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role'";
$result = $conn->query($sql);

if (mysqli_num_rows($result)>0) {
    $user = mysqli_fetch_array($result);

    // Simpan ke session
    $_SESSION['login'] = true;
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['id_user'] = $user['id_user'];

    // Redirect ke dashboard
    header("Location: guru/admin_beranda.php");
    exit();
} else {
    // Gagal login
    $_SESSION['error'] = 'Username atau password salah!';
    header("Location: index.php");
    exit();
}
?>
