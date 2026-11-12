<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];

$result = $conn->query("SELECT * FROM kategori_tes");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Test</title>
    <link rel="stylesheet" href="css/test.css" />
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
            <!--<div class="title"></div>-->
            <!--  <div class="topbar-right">-->
            <!--    <div class="search-box">-->
            <!--      <i class="fas fa-search"></i>-->
            <!--      <input type="text" placeholder="Cari modul atau topik...">-->
            <!--    </div>-->
            <!--    <div class="topbar-icons">-->
            <!--      <i class="fas fa-bell"></i>-->
            <!--    </div>-->
            <!--</div>-->
          </div>

          <!-- Konten -->
          <section class="judul-test-section">
            <div class="judul-container">
                <h1>Tes Pemahaman</h1>
                <p>Silakan kerjakan pretest sebelum memulai eksplorasi, dan posttest setelah menyelesaikan seluruh materi.</p>
            </div>
            
            <div class="test-boxes">
              <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()):?>   
              <!-- pre test -->
               <?php
               $id_kategori = $row['id'];
               //Cek siswa sudah mengerjakan atau belum
               $sql_check = "SELECT * FROM hasil_tes WHERE id_siswa = ? AND id_kategori = ?";
               $stmt_check = $conn->prepare($sql_check);
               $stmt_check->bind_param("ii", $id_siswa, $id_kategori);
               $stmt_check->execute();
               $result_check = $stmt_check->get_result();
               $is_completed = ($result_check->num_rows > 0);
               ?>
              <div class="test-box">
                <img src="assets/test.png" alt="Pretest" class="test-image">
                <h3><?= $row['kategori'] ?></h3>
                <p><?= $row['keterangan'] ?></p>
                <?php if ($is_completed): ?>
                <a href="#" class="btn-mulai">Sudah Mengerjakan</a>
                <?php else: ?>
               <a href="pretest.php?kategori=<?= $row['id'] ?>" class="btn-mulai">Mulai Test</a>
                <?php endif; ?>
              </div>
              <?php endwhile; ?>
             <?php else: ?>
              <tr><td colspan="4">Belum ada data Materi.</td></tr>
          <?php endif; ?>
            </div>
             
      
        </section>

        </div>
      </div>
      <script src="js/script.js"></script>
  </body>
</html>
