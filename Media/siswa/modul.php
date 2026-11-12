<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>modul</title>
    <link rel="stylesheet" href="css/modul.css" />
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
          <!--  <div class="topbar-right">-->
          <!--  <div class="search-box">-->
          <!--    <i class="fas fa-search"></i>-->
          <!--    <input type="text" placeholder="Cari modul atau topik...">-->
          <!--  </div>-->
          <!--  <div class="topbar-icons">-->
          <!--    <i class="fas fa-bell"></i>-->
          <!--  </div>-->
          <!--</div>-->
        </div>

        <!-- isi Konten -->
        <!-- Konten -->
        <div class="modul-container">
          <div class="modul-header">
             <h1>Modul Ajar Hari Ini</h1>
             <p>Silakan pilih modul yang tersedia di bawah ini:</p>
          </div>
          <div class="modul-grid">
            <?php
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM materi_tambahan");
                if (mysqli_num_rows($data) > 0):
                  while($row = mysqli_fetch_array($data)):
              ?>
            <div class="modul-card">
              <img src="assets/modul4.png" alt="Jaringan" class="modul-icon">
              <h3><?= $row['judul'] ?></h3>
              <a href="modul2.php?id_materi=<?= $row['id_materi']?>"><button>Mulai Modul</button></a>
            </div>
            <?php
                  endwhile;
                else:
              ?>
                <tr>
                  <td colspan="5" style="text-align:center;">Belum ada data Materi.</td>
                </tr>
              <?php endif; ?>
            </div>
        </div>
      </div>
    </div>
    <script src="js/script.js"></script>
  </body>
</html>
