<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];

$query = "SELECT COUNT(*) AS total_siswa FROM users WHERE role = 'siswa'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$query_eksplor = "SELECT COUNT(*) AS total_eksplor FROM nilai_akhir";
$result_eksplor = mysqli_query($conn, $query_eksplor);
$data_eksplor = mysqli_fetch_assoc($result_eksplor);

$query_rata = "SELECT AVG(rata_rata) AS rata_rata FROM nilai_akhir";
$result_rata = mysqli_query($conn, $query_rata);
$data_rata = mysqli_fetch_assoc($result_rata);

$rata_rata = round($data_rata['rata_rata'], 1);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-beranda</title>
    <link rel="stylesheet" href="css/admin-beranda.css" />
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
          <div class="title">holla Bu Guru!</div>
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

        <!-- Main Content -->
        <main class="content">
          <header>
            <h1>Dashboard Admin</h1>
          </header>
          <!-- <div class="filter-kelas">
            <label for="kelasSelect">Pilih Kelas:</label>
            <select id="kelasSelect">
              <option value="X-1">Kelas X-1</option>
              <option value="X-2">Kelas X-2</option>
              <option value="X-3">Kelas X-3</option>
            </select>
          </div> -->

          <!-- Ringkasan Kartu -->
          <section class="summary-cards">
            <div class="card">
              <h3>Total Siswa</h3>
              <p><?php echo $data['total_siswa'];?></p>
            </div>
            <div class="card">
              <h3>Selesai Eksplorasi</h3>
              <p><?php echo $data_eksplor['total_eksplor'];?></p>
            </div>
            <div class="card">
              <h3>Rata-rata Nilai</h3>
              <p><?php echo $rata_rata?></p>
            </div>
          </section>

        </main>


      </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="js/script.js"></script>
  </body>
</html>
