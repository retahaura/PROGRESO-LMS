<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];
// Ambil semua kategori dari tabel kategori_tes
$kategoriQuery = "SELECT id, kategori FROM kategori_tes";
$kategoriResult = $conn->query($kategoriQuery);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-test</title>
    <link rel="stylesheet" href="css/test.css" />
    <link rel="stylesheet" href="css/topside.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            <!--    <div class="topbar-right">-->
            <!--    <div class="search-box">-->
            <!--    <i class="fas fa-search"></i>-->
            <!--    <input type="text" placeholder="Cari modul atau topik...">-->
            <!--    </div>-->
            <!--    <div class="topbar-icons">-->
            <!--    <i class="fas fa-bell"></i>-->
            <!--    </div>-->
            <!--</div>-->
            </div>

            <!-- Main Content -->

            <!-- BAGIAN: Tabel Jawaban Siswa -->
        
            <div class="content">
                <div class="judul-container">
                    <h1>Kelola Test</h1>
                </div>
                <div class="tahap-box">
                  <form method="post" action="save_pretes.php" enctype="multipart/form-data" id="form-pretest">
                  <div class="kategori">
                    <label for="kategori">Kategori Tes:</label>
                    <select name="id_kategori" id="kategori" required>
                      <option value="">-- Pilih Kategori --</option>
                      <?php while ($row = mysqli_fetch_assoc($kategoriResult)) : ?>
                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['kategori']) ?></option>
                      <?php endwhile; ?>
                    </select>
                  </div>

                  <div id="soal-container">
                    <!-- Template Soal -->
                  </div>

                  <button type="button" class="tambah-soal">Tambah Soal</button>
                  <button type="button" class="reset-semua">Reset Semua Soal</button>
                  <div class="submit">
                    <button class="btn-primary" type="submit">Submit Semua</button>
                  </div>
                </form>
                <div class="submit">
                  <a class="btn-primary" href="kelola_tes.php" role="button">Selesai</a>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
          <template id="template-soal">
            <div class="question">
              <div class="pertanyaan">
                <input type="text" name="pertanyaans[__index__][pertanyaan]" placeholder="Pertanyaan..." />
                <input type="file" name="gambar_pertanyaan[]">
              </div>
              <div class="choices">
                <div class="choice-row">
                  <input type="text" name="pertanyaans[__index__][jawaban_a]" placeholder="Opsi A" />
                  <input type="file" name="gambar_a[]">
                </div>
                <div class="choice-row">
                  <input type="text" name="pertanyaans[__index__][jawaban_b]" placeholder="Opsi B" />
                  <input type="file" name="gambar_b[]">
                </div>
                <div class="choice-row">
                  <input type="text" name="pertanyaans[__index__][jawaban_c]" placeholder="Opsi C" />
                  <input type="file" name="gambar_c[]">
                </div>
                <div class="choice-row">
                  <input type="text" name="pertanyaans[__index__][jawaban_d]" placeholder="Opsi D" />
                  <input type="file" name="gambar_d[]">
                </div>
                <div class="choice-row">
                  <input type="text" name="pertanyaans[__index__][jawaban_e]" placeholder="Opsi E" />
                  <input type="file" name="gambar_e[]">
                </div>
              </div>
              <div class="kunci-jawaban">
                <label>Kunci Jawaban:</label>
                <select name="pertanyaans[__index__][jawaban_benar]">
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>
                </select>
              </div>
              <button type="button" class="hapus-soal">Hapus Soal</button>
            </div>
          </template>   
    
    <script src="js/script.js"></script>
    <script>
      let soalIndex = 0;

      function tambahSoal() {
        const template = document.getElementById('template-soal').innerHTML;
        const html = template.replace(/__index__/g, soalIndex);
        $('#soal-container').append(html);
        soalIndex++;
      }

      $(document).on('click', '.tambah-soal', function () {
        tambahSoal();
      });

      $(document).on('click', '.hapus-soal', function () {
        $(this).closest('.question').remove();
      });

      $(document).on('click', '.reset-semua', function () {
        $('#soal-container').empty();
        soalIndex = 0;
      });
      </script>
  </body>
</html>
