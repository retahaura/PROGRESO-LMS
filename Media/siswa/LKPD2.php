<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];

$id_lkpd = $_GET['id'];

$sql = "SELECT * FROM users WHERE id_user=$id_siswa";
$result_siswa = $conn->query($sql);
$row_siswa = $result_siswa->fetch_assoc();
$nama_siswa = $row_siswa['nama'];

$sql_lkpd = "SELECT * FROM lkpd WHERE id=$id_lkpd";
$result_lkpd = $conn->query($sql_lkpd);
$row_lkpd = $result_lkpd->fetch_assoc();
$file_lkpd = $row_lkpd['file'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>LKPD2</title>
    <link rel="stylesheet" href="css/LKPD2.css" />
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
             <div class="content-wrapper">
                <div class="judul-container">
                    <h1>Daftar LKPD</h1>
                    <p>Silakan pilih LKPD, download, kerjakan, lalu upload jawabannya di bawah ini.</p>
                </div>
                    <section class="lkpd-list">
                    <!-- LOOP START: untuk setiap LKPD -->
                    <div class="lkpd-card">
                    <div class="lkpd-info">
                        <a href="../guru/<?= $file_lkpd?>" target="_blank" class="lkpd-download">Download LKPD</a>
                    </div>

                    <form action="upload_lkpd.php" method="post" enctype="multipart/form-data" class="upload-form">
                        <input type="hidden" name="id_lkpd" value="<?= $id_lkpd?>">
                        <input type="hidden" name="id_user" value="<?= $id_siswa?>">
                        <label>Nama Lengkap:</label>
                        <input type="text" name="nama" value="<?php echo $nama_siswa?>" readonly>
                        
                        <label>Upload Jawaban:</label>
                        <input type="file" name="jawaban" required>
                        
                        <button type="submit" onclick="myFuntion()">Kirim Jawaban</button>
                    </form>
                    </div>

                    <!-- LOOP END -->
                </section>
            </div>


        </div>
      </div>
      <script src="js/script.js"></script>
      <script>
      function myFunction() {
      alert("File Berhasil di Submit!");
      }
      </script>
  </body>
</html>
