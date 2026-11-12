<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];

$result = $conn->query("SELECT * FROM materi ORDER BY id_materi DESC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-penilaian</title>
    <link rel="stylesheet" href="css/admin-penilaian.css?v=<? time()?>" />
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
              <!-- Tombol untuk membuka modal -->
            <!--<button id="openModal" class="btn-mulai">Tambah Materi</button>-->
          </div>
          
           <!-- Tombol untuk membuka modal -->
          
            <button id="openModal" class="btn-mulai">Tambah Materi</button>
          
          
          <div class="materi-grid">
            <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()):?>
            <!-- Materi 1 -->
          <div class="materi-card">
            <img src="uploads/<?= $row['cover_materi'] ?>" width="200">
            <h4><?= $row['judul'] ?></h4>
            <a href="pemicu_visual.php?materi=<?php echo $row['id_materi']?>" class="btn-mulai">Perbarui Materi</a>
          </div>
             <?php endwhile; ?>
             <?php else: ?>
              <tr><td colspan="4">Belum ada data Materi.</td></tr>
          <?php endif; ?>
          </div>
      
        </section>
       <!-- Modal Tambah Materi -->
          <div id="myModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <h2>Tambah Materi Baru</h2>
              <form id="inputForm" enctype="multipart/form-data" >
                <label for="materi">Judul Materi:</label><br>
                <input type="text" id="materi" name="judul" required><br><br>

                <label for="cover">Cover Materi (Gambar):</label><br>
                <input type="file" id="cover" name="cover_materi" accept="image/*" required><br><br>

                <label for="materi">Deskripsi Materi:</label><br>
                <input type="text" id="deskripsi" name="deskripsi" required><br><br>

                <button type="submit">Simpan</button>
              </form>
            </div>
          </div>
      </div>
    <script src="js/script.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
      const modal = document.getElementById("myModal");
      const openModalBtn = document.getElementById("openModal");
      const closeModalBtn = document.querySelector(".close");
      const inputForm = document.getElementById("inputForm");

      // Buka modal
      openModalBtn.addEventListener("click", function () {
        modal.style.display = "block";
      });

      // Tutup modal
      closeModalBtn.addEventListener("click", function () {
        modal.style.display = "none";
      });

      // Tutup modal jika klik di luar modal
      window.addEventListener("click", function (e) {
        if (e.target == modal) {
          modal.style.display = "none";
        }
      });

      // Handle submit form
      inputForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Mencegah form reload

        const formData = new FormData(inputForm);

        fetch("tambah_materi.php", {
          method: "POST",
          body: formData
        })
          .then((res) => res.text())
          .then((data) => {
            alert(data);
            modal.style.display = "none";
            location.reload(); // Reload untuk munculkan materi baru
          })
          .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menambahkan materi.");
          });
      });
    });
    </script>


  </body>
</html>
