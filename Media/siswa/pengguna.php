<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];
$sql = "SELECT nama, username FROM users WHERE id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_siswa);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>akun pengguna</title>
    <link rel="stylesheet" href="css/pengguna.css" />
    <link rel="stylesheet" href="css/topside.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="sidebar">
        <div class="logo">
          <button id="toggleBtn"><i class="fas fa-bars"></i></button>
          <div class="logo-container">
            <img src="assets/logo.png" alt="Logo" class="logo-img">
            <span class="logo-text">PROGRESO</span>
          </div>
        </div>
        <ul class="menu">
          <li><a href="beranda.php"><i class="fas fa-home"></i><span>Beranda</span></a></li>
          <li><a href="LKPD.php"><i class="fas fa-file-alt"></i> <span>LKPD</span></a></li>
          <li><a href="modul.php"><i class="fas fa-book"></i> <span>Materi Tambahan</span></a></li>
          <li><a href="test.php"><i class="fas fa-clipboard-check"></i> <span>Tes Pemahaman</span></a></li>
          <li><a href="pengguna.php"><i class="fas fa-user-circle"></i> <span>Pengguna</span></a></li>
          <li><a href="bantuan.php"><i class="fas fa-question-circle"></i> <span>Perlu Bantuan</span></a></li>
        </ul>
        <ul class="menu menu-bawah">
          <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a></li>
        </ul>
      </div>

      <!-- Main Area -->
      <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
          <div class="title"></div>
          <!--<div class="topbar-right">-->
          <!--  <div class="search-box">-->
          <!--    <i class="fas fa-search"></i>-->
          <!--    <input type="text" placeholder="Cari modul atau topik...">-->
          <!--  </div>-->
          <!--  <div class="topbar-icons">-->
          <!--    <i class="fas fa-bell"></i>-->
          <!--  </div>-->
          <!--</div>-->
        </div>

        <!-- Konten -->
        <div class="content">
          <div class="profile-settings">
            <h2>Pengaturan Akun</h2>
            <form class="profile-form" action="update-akun.php" method="post">
              <label for="fullname">Nama Lengkap</label>
              <input type="text" id="fullname" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>

              <label for="username">Nama Pengguna</label>
              <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

              <label for="new-password">Ganti Password</label>
              <input type="password" id="new-password" name="password" placeholder="Password baru">

              <label for="confirm-password">Konfirmasi Password</label>
              <input type="password" id="confirm-password" name="konfirmasi" placeholder="Ulangi password baru">

              <button type="submit">Simpan Perubahan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="js/script.js"></script>
  </body>
</html>
