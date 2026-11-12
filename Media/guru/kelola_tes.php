<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];

if (isset($_GET['hapus_id'])) {
    $id = $_GET['hapus_id'];
    $stmt = $conn->prepare("DELETE FROM tes WHERE id_tes = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: kelola_tes.php"); // reload bersih
        exit();
    } else {
        echo "Gagal menghapus: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-penilaian</title>
    <link rel="stylesheet" href="css/admin-penilaian.css?v=<?= time(); ?>" />
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
              <h1>Daftar Pertanyaan</h1>
              <!-- Tombol untuk membuka modal -->
            <!--<a href="admin_test.php" class="btn-mulai">Tambah Pertanyaan</a>-->
            <!--<a href="admin_nilaites.php" class="btn-mulai">Rekap Nilai</a>-->
          </div>
          <!-- Tombol untuk membuka modal -->
          <div class="actions">
            <a href="admin_test.php" class="btn-mulai">Tambah Pertanyaan</a>
            <a href="admin_nilaites.php" class="btn-mulai">Rekap Nilai</a>
          </div>
          
          
          <div class="user-table">
            <table>
            <thead>
                <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    $no = 1;
                    $data = mysqli_query($conn, "SELECT k.kategori, t.pertanyaan, t.jawaban_benar, t.id_tes 
                    from tes t JOIN kategori_tes k ON t.id_kategori = k.id ORDER BY kategori DESC");
                    while($row = mysqli_fetch_array($data)){
                    ?>
                <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['kategori'] ?></td>
                <td><?= $row['pertanyaan'] ?></td>
                <td><?= $row['jawaban_benar'] ?></td>
                <td>
                <a class="edit-btn" href="edit_tes.php?id_tes=<?= $row['id_tes'] ?>">Edit</a>
                <button class="delete-btn" data-id="<?= $row['id_tes'] ?>">Hapus</button>
                <style>
                  
                  </style>
              </td>
                </tr>
                <!-- Tambah data dinamis lainnya -->
                 <?php
                    }
                ?>
            </tbody>
            </table>
          </div>
          <!-- Modal Konfirmasi -->
          <div id="confirmModal" class="modal" style="display:none;">
            <div class="modal-content">
              <p>Yakin ingin menghapus data ini?</p>
              <button id="confirmYes" class="edit-btn">Ya</button>
              <button id="confirmNo" class="delete-btn">Batal</button>
            </div>
          </div>
        </section>
      </div>
    <script src="js/script.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      const modal = document.getElementById('confirmModal');
      const btnYes = document.getElementById('confirmYes');
      const btnNo = document.getElementById('confirmNo');
      let idToDelete = null;

      // Saat tombol hapus diklik
      document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
          idToDelete = this.dataset.id;
          modal.style.display = 'block';
        });
      });

      // Jika klik batal
      btnNo.addEventListener('click', () => {
        modal.style.display = 'none';
        idToDelete = null;
      });

      // Jika klik YA
      btnYes.addEventListener('click', () => {
        if (idToDelete) {
          window.location.href = "kelola_tes.php?hapus_id=" + idToDelete;
        }
      });

      // Klik di luar modal menutup
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    });
    </script>

  </body>
</html>
