<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];

$id_materi = $_GET['materi'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-materi</title>
    <link rel="stylesheet" href="css/admin-materi.css?v=<?= time(); ?>" />
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
            <h1>Kelola Materi Eksplorasi</h1>
          </header>
        
          <section class="materi-tahap">
            <div class="tahap-box">
              <h2>Tahap 1 – Pemicu Visual</h2>
              <p><strong>Tipe Soal:</strong> Esai</p>
        
              <form action="insert_pemicu.php" method="post" enctype="multipart/form-data" id="form-soal">
                <input type="hidden" name="id_materi" value="<?= $id_materi ?>">
        
                <div id="container-soal">
                  <div class="soal-box">
                    <input type="text" name="esai[]" placeholder="Pertanyaan esai..." />
                    <input type="file" name="gambar[]" accept="image/*" />
                  </div>
                </div>
        
                <div class="form-actions">
                  <button type="button" class="hapus-soal" onclick="hapusSoal()">Hapus Soal</button>
                  <button type="button" class="tambah-soal" onclick="tambahSoal()">Tambah Soal</button>
                  <button type="button" class="reset-semua" onclick="resetSemua()">Reset Semua</button>
                  <button type="submit" class="btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </section>
        
          <div class="submit">
            <a href="studi_kasus.php?materi=<?php echo $id_materi?>" class="next">Tahap 2</a>
          </div>
        </main>
        
    </div>
    <!--    <main class="content">-->
    <!--      <header>-->
    <!--        <h1>Kelola Materi Eksplorasi</h1>-->
    <!--      </header>-->

    <!--        <section class="materi-tahap">-->
    <!--            <div class="tahap-box">-->
    <!--              <h2>Tahap 1 – Pemicu Visual</h2>-->
    <!--              <p><strong>Tipe Soal:</strong> Esai</p>-->
    <!--              <form action="insert_pemicu.php" method="post" enctype="multipart/form-data" id="form-soal">-->
    <!--                <input type="hidden" name="id_materi" value="<?= $id_materi ?>" >-->
    <!--              <div id="container-soal">-->
    <!--                  <div class="soal-box">-->
    <!--                    <input type="text" name="esai[]" placeholder="Pertanyaan esai..."  />-->
    <!--                    <input type="file" name="gambar[]" accept="image/*"  />-->
    <!--                  </div>-->
    <!--              </div>-->
    <!--                  <button type="button" class="hapus-soal" onclick="hapusSoal()">Hapus Soal</button>-->
    <!--                  <button type="button" class="tambah-soal" onclick="tambahSoal()">Tambah Soal</button>-->
    <!--                  <button type="button" class="reset-semua" onclick="resetSemua()">Reset Semua</button>-->
    <!--                  <button type="submit" class="btn-primary">Submit</button>-->
                     
    <!--            </div>-->
    <!--              </form>-->
                    
    <!--        </section>-->
    <!--        <div class="submit">-->
    <!--         <a href="studi_kasus.php?materi=<?php echo $id_materi?>" class="next">Tahap 2 </a>-->
    <!--        </div>-->
    <!--    </main>-->
    <!--</div>-->
       
    <script src="js/script.js"></script>
    <script>
    function tambahSoal() {
      const container = document.getElementById('container-soal');
      const div = document.createElement('div');
      div.className = 'soal-box';
      div.innerHTML = `
        <input type="text" name="esai[]" placeholder="Pertanyaan esai..." required>
        <input type="file" name="gambar[]" accept="image/*">
      `;
      container.appendChild(div);
    }

    function hapusSoal() {
      const container = document.getElementById('container-soal');
      const soal = container.getElementsByClassName('soal-box');
      if (soal.length > 1) {
        container.removeChild(soal[soal.length - 1]);
      } else {
        alert("Minimal satu soal harus ada.");
      }
    }

    function resetSemua() {
      if (confirm("Yakin ingin mereset semua soal?")) {
        document.getElementById('container-soal').innerHTML = `
          <div class="soal-box">
            <input type="text" name="esai[]" placeholder="Pertanyaan esai..." required>
            <input type="file" name="gambar[]" accept="image/*">
          </div>
        `;
      }
    }
    </script>
  </body>
</html>
