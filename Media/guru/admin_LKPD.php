<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];

// Proses hapus jika ada permintaan
if (isset($_POST['hapus_id'])) {
    $id = $_POST['hapus_id'];
    $get = $conn->prepare("SELECT file FROM lkpd WHERE id = ?");
    $get->bind_param("i", $id);
    $get->execute();
    $result = $get->get_result()->fetch_assoc();

    // Hapus file fisik
    if ($result && file_exists($result['file'])) {
        unlink($result['file']);
    }

    // Hapus dari database
    $stmt = $conn->prepare("DELETE FROM lkpd WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: admin_LKPD.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-LKPD</title>
    <link rel="stylesheet" href="css/admin-LKPD.css?v=<?= time(); ?>" />
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

          <!-- BAGIAN: Tabel Jawaban Siswa -->
          <section class="jawaban-siswa">
            <div class="judul-container">
              <h1>Kelola LKPD</h1>
          </div>
            <table class="table-jawaban">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>File Jawaban</th>
                  <th>Tanggal Upload</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM jawaban_lkpd j INNER JOIN users u ON j.id_users = u.id_user");
                if (mysqli_num_rows($data) > 0):
                  while($row = mysqli_fetch_array($data)):
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $row['nama'] ?></td>
                  <td><?= $row['file'] ?></td>
                  <td><?= $row['tanggal'] ?></td>
                  <td><a class="download-link" href="<?= $row['file'] ?>" target="_blank" class="btn-aksi">Download</a></td>
                </tr>
                <?php
                  endwhile;
                else:
              ?>
                <tr>
                  <td colspan="5" style="text-align:center;">Belum ada data Jawaban Siswa.</td>
                </tr>
              <?php endif; ?>
              </tbody>
            </table>
            <table class="table-jawaban">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th>File LKPD</th>
                <th>Tanggal Upload</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM lkpd");
                if (mysqli_num_rows($data) > 0):
                  while($row = mysqli_fetch_array($data)):
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $row['judul'] ?></td>
                  <td><a class="download-link" href="<?= $row['file'] ?>" target="_blank">Download PDF</a></td>
                  <td><?= $row['upload_time'] ?></td>
                  <td><button class="btn-hapus" data-id="<?= $row['id'] ?>">Hapus</button></td>
                </tr>
              <?php
                  endwhile;
                else:
              ?>
                <tr>
                  <td colspan="5" style="text-align:center;">Belum ada data LKPD.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>


            <!-- BAGIAN: Upload LKPD Baru -->
            <div class="upload-lkpd">
              <h2>Upload LKPD Baru</h2>
              <form action="upload_lkpd.php" method="post" enctype="multipart/form-data">
                <label>Judul / Pertemuan</label>
                <input type="text" name="judul" placeholder="Contoh: Pertemuan 3: Proteksi Data" required>

                <label>File LKPD (PDF)</label>
                <input type="file" name="lkpd_file" required>

                <button type="submit" class="btn-upload">Upload LKPD PDF</button>
              </form>
            </div>
          </section>
      </div>

      </div>
    </div>
    <!-- Modal Konfirmasi Hapus -->
    <div id="modalHapus" class="modal" style="display:none;">
      <div class="modal-content">
        <p>Yakin ingin menghapus file ini?</p>
        <form method="post" action="admin_LKPD.php">
          <input type="hidden" name="hapus_id" id="hapusId">
          <!-- dalam modal -->
          <button type="submit" class="btn-konfirmasi-hapus">Ya, Hapus</button>
          <button type="submit" id="batalBtn">Batal</button>
        </form>
      </div>
    </div>
    <script src="js/script.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modalHapus');
        const hapusIdInput = document.getElementById('hapusId');
        const batalBtn = document.getElementById('batalBtn');

        document.querySelectorAll('.btn-hapus').forEach(button => {
          button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            hapusIdInput.value = id;
            modal.style.display = 'block';
          });
        });

        batalBtn.addEventListener('click', () => {
          modal.style.display = 'none';
          hapusIdInput.value = '';
        });

        // klik di luar modal menutup
        window.onclick = function(e) {
          if (e.target == modal) {
            modal.style.display = 'none';
          }
        };
      });
      </script>

  </body>
</html>
