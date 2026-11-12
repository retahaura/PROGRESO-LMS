<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];
$id_materi = $_GET['id_materi'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-rekap</title>
    <link rel="stylesheet" href="css/admin-rekap.css" />
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
        <section class="rekap-siswa-section">
          <div class="judul-section-besar">
            <h1>Rekap Progres Siswa</h1>
          </div>

          <div class="judul-materi">
            <h3>JARINGAN LOKAL DAN INTERNET</h3>
            <p><strong>Data berikut</strong> menampilkan progres dan status pengerjaan tiap siswa berdasarkan materi yang dipilih.</p>
          </div>

          <div class="rekap-split-container">
            <!-- Bagian Kiri: Tabel -->
            <div class="rekap-kiri">
              <div class="rekap-container">
                <table>
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <th>Materi</th>
                      <th>Nilai</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $query = "
                    SELECT 
                      u.id_user,
                      u.nama,
                      m.id_materi,
                      m.judul,
                      IFNULL(n.rata_rata, 0) AS rata_rata
                    FROM users u
                    CROSS JOIN materi m
                    LEFT JOIN nilai_akhir n ON u.id_user = n.id_user AND m.id_materi = n.id_materi
                    WHERE u.role = 'siswa' AND m.id_materi = $id_materi
                    ORDER BY u.nama, m.judul
                    ";

                    $data = mysqli_query($conn, $query);

                    if (mysqli_num_rows($data) > 0):
                      while ($row = mysqli_fetch_array($data)):
                    ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= htmlspecialchars($row['nama']) ?></td>
                      <td><?= htmlspecialchars($row['judul']) ?></td>
                      <td><?= round($row['rata_rata'], 1) ?></td>
                      <td>
                        <a href="admin_eksplorasi.php?id_materi=<?= $row['id_materi'] ?>&id_user=<?= $row['id_user'] ?>" class="btn-detail">Lihat Jawaban</a>
                      </td>
                    </tr>
                    <?php
                      endwhile;
                    else:
                    ?>
                    <tr>
                      <td colspan="5" style="text-align:center;">Belum ada data siswa/materi.</td>
                    </tr>
                    <?php endif; ?>


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>

    </div>
    

    
    <script src="js/script.js"></script>
  </body>
</html>
