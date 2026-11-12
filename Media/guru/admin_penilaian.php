<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-penilaian</title>
    <link rel="stylesheet" href="css/admin-penilaian.css" />
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
          <li><a href="admin_beranda.php"><i class="fas fa-home"></i><span>Beranda</span></a></li>
          <li><a href="admin_penilaian.php"><i class="fas fa-users"></i> <span>Rekap Siswa</span></a></li>
          <li><a href="admin_LKPD.php"><i class="fas fa-file-alt"></i> <span>LKPD</span></a></li>
          <li><a href="kelola_tes.php"><i class="fas fa-clipboard-check"></i> <span>Tes Pemahaman</span></a></li>
          <li><a href="kelola_materi.php"><i class="fas fa-book-open"></i> <span>Kelola Materi</span></a></li>
          <li><a href="admin_pengguna.php"><i class="fas fa-user-cog"></i> <span>Kelola Pengguna</span></a></li>
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
          <!--    <div class="search-box">-->
          <!--    <i class="fas fa-search"></i>-->
          <!--    <input type="text" placeholder="Cari modul atau topik...">-->
          <!--    </div>-->
          <!--    <div class="topbar-icons">-->
          <!--      <i class="fas fa-bell"></i>-->
          <!--    </div>-->
          <!--</div>-->
        </div>
        
        <!-- Main Content -->
        <section class="judul-materi-section">
          <div class="judul-container">
              <h1>Daftar Materi</h1>
              <p>Silakan pilih materi untuk melihat progres siswa:</p>
          </div>
          <div class="materi-grid">
            <!-- Materi 1 -->
             <?php
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM materi");
                if (mysqli_num_rows($data) > 0):
                  while($row = mysqli_fetch_array($data)):
              ?>
          <div class="materi-card">
            <img src="../guru/uploads/<?= $row['cover_materi'] ?>" width="200">
            <h4><?= $row['judul'] ?></h4>
            <a href="admin_rekap.php?id_materi=<?= $row['id_materi']?>" class="btn-mulai">Lihat Progres Siswa</a>
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
      
        </section>
      </div>
    

    
    <script src="js/script.js"></script>
  </body>
</html>
