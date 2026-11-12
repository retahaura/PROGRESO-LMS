<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];




// 🔹 Ambil data materi dan status progress siswa
$query = "
    SELECT 
        m.*, 
        COALESCE(p.status, 0) AS progress_status
    FROM materi m
    LEFT JOIN progress_pertemuan p 
        ON m.id_materi = p.id_materi 
        AND p.id_user = '$id_siswa'
    ORDER BY m.id_materi ASC
";
$result = mysqli_query($conn, $query);

// 🔹 Hitung total progress bar
$total_materi = mysqli_num_rows($result);
$completed_count = 0;
if ($total_materi > 0) {
    mysqli_data_seek($result, 0);
    while ($r = mysqli_fetch_assoc($result)) {
        if ($r['progress_status'] == 2) $completed_count++;
    }
    $progress_percent = round(($completed_count / $total_materi) * 100);
} else {
    $progress_percent = 0;
}

// Kembalikan pointer result untuk loop card
mysqli_data_seek($result, 0);
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>beranda</title>
    <link rel="stylesheet" href="css/beranda.css" />
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
          <div class="title">Hallo!</div>
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

        <!-- Konten -->
        <div class="content">
          <div class="highlight-box">
            <h2>Penemuan Hari Ini</h2>
            <p>Di LMS ini, kamu nggak cuma baca materi. Kamu akan menemukan sendiri jawaban dari masalah nyata, seperti teknisi jaringan sungguhan! Yuk mulai dari Eksplorasi Belajar.</p>
            <a href="#simulasi-section" class="btn-simulasi">Mulai Eksplorasi</a>
          </div>

          <div class="cards" id="simulasi-section">
            <?php
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM materi");
                if (mysqli_num_rows($data) > 0):
                  while($row = mysqli_fetch_array($data)):
              ?>
            <div class="card">
              <img src="../guru/uploads/<?= $row['cover_materi'] ?>" width="200">
              <h4><?= $row['judul'] ?></h4>
              <a href="eksplorasi-stimulation.php?id_materi=<?= $row['id_materi'] ?>"><button class="btn-simulasi">Masuk Eksplor</button>
              </a>
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
            <div class="progress-section">
              <h4>Pembelajaran yang Sedang Berlangsung</h4>
              <div class="progress-bar">
                <div class="progress-bar-fill" id="progress-bar-fill" style="width: 0%;"></div>
              </div>
              <div class="progress-label" id="progress-label">Progress: 0%</div>
            </div>
          <!--<div class="badge-section">-->
          <!--  <h4>Lencana</h4>-->
          <!--  <p>🏅 Jago Topologi - Jogogi</p>-->
          <!--</div>-->
        </div>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const progress = localStorage.getItem("discoveryProgress") || "0";
        document.getElementById("progress-bar-fill").style.width = progress + "%";
        document.getElementById("progress-label").innerText = "Progress: " + progress + "%";
      });
    </script>
    <script src="js/script.js"></script>
  </body>
</html>
