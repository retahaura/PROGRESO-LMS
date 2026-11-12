<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];
$id_materi = $_GET['id_materi'];
// Ambil semua jawaban siswa dalam array
$query_jawaban = "SELECT * FROM jawaban_generalization
                  WHERE id_materi = ? AND id_user = ?";
$stmt_jawaban = mysqli_prepare($conn, $query_jawaban);
mysqli_stmt_bind_param($stmt_jawaban, 'ii', $id_materi, $id_siswa);
mysqli_stmt_execute($stmt_jawaban);
$result_jawaban = mysqli_stmt_get_result($stmt_jawaban);

$jawaban = [];
while ($row_j = mysqli_fetch_assoc($result_jawaban)) {
    $jawaban[$row_j['id_soal']] = $row_j['jawaban'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>eksplorasi-generalization</title>
    <link rel="stylesheet" href="css/topside.css" />
    <link rel="stylesheet" href="css/eksplorasi-layout.css" />
    <link rel="stylesheet" href="css/eksplorasi-generalization.css" />
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
        <!-- Generalization Page (php) -->
        <section class="explore-section">
          <div class="explore-container">
            <div class="section-title">
              <h2>Tahap 6</h2>
              <p>Silakan tarik kesimpulan umum dari hasil eksplorasi dan pembahasan, lalu hubungkan dengan penerapan dalam kehidupan sehari-hari.</p>
            </div>

            <div class="progress-bar-container">
              <div class="progress-text">Tahap 6 dari 6: Menarik Kesimpulan (100%)</div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 100%;"></div>
              </div>
            </div>

            <!-- Konsisten: Gunakan class 'question-card' -->
             <form action="jawaban-generalization.php" method="post">
           <input type="hidden" name="id_materi" value="<?= $id_materi?>"> 
           <?php
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM refleksi WHERE id_materi = $id_materi");
                if (mysqli_num_rows($data) > 0):
                  while($row = mysqli_fetch_array($data)):
              ?>  
            <div class="question-card">
              <!--<h3>Pertanyaan Umum</h3>-->
              <!--<img src="../guru/<?= $row['gambar'] ?>"  style="display: block; margin-left: auto; margin-right: auto; max-width: 40%; border-radius: 8px; margin-bottom: 16px;">-->
              <h3><?= $row['pertanyaan'] ?></h3>
              <input type="hidden" name="id_soal[]" value="<?= $row['id'] ?>">
              <textarea class="input-textarea" name="jawaban[<?= $row['id'] ?>]" rows="3" placeholder="Jelaskan berdasarkan pengetahuanmu..."><?= htmlspecialchars($jawaban[$row['id']] ?? '') ?></textarea>
            </div>
            <?php
                  endwhile;
                else:
              ?>
                <tr>
                  <td colspan="5" style="text-align:center;">Belum ada data Soal.</td>
                </tr>
              <?php endif; ?>
            <button type="submit" class="btn-primary2" onclick="myFunction()">Submit</button>
           </form>

            <?php if (isset($_GET['show'])): ?>
    <div class="feedback-box" 
        style="
            margin-top:25px;
            padding:20px;
            border-radius:18px;
            background:#e7f9ff;
            border-left:6px solid #06b6d4;
            box-shadow:0 4px 12px rgba(0,0,0,0.05);
            animation: fadeIn 0.3s ease-out;
        ">
        
        <?php
        if ($id_materi == 11) {
            echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                    <strong style='color:#0284c7;'>Hebat Sekali! </strong><br>
                    Kamu berhasil menyimpulkan materi secara runtut. Kamu sudah menguasai konsep utamanya 🌟
                 </p>";
        } elseif ($id_materi == 14) {
            echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                    <strong style='color:#0284c7;'></strong><br>
                    Perfect! Kamu sudah bisa menghubungkan semua konsep dari awal sampai akhir. Kamu berhasil generalisasi materinya!
                 </p>";
        } elseif ($id_materi == 15) {
            echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                    <strong style='color:#0284c7;'></strong><br>
                    Hebat! Kesimpulanmu sudah jelas, runtut, dan mencerminkan pemahaman yang kuat ðŸŒŸ
                 </p>";
        }
        ?>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity:0; transform: translateY(10px); }
            to { opacity:1; transform: translateY(0); }
        }
    </style>
<?php endif; ?>


            <div class="submit-section">
              <a href="beranda.php" class="btn-primary2">Selesai</a>
            </div>
          </div>
        </section>

      </div>
    </div>
    <script>
      // Contoh untuk halaman Problem Statement
      document.addEventListener("DOMContentLoaded", function () {
      // Ganti angka di sini sesuai tahapnya
      localStorage.setItem("discoveryProgress", "100");

      // Kalau ingin juga update progress bar lokal (di halaman ini)
      const progressFill = document.querySelector(".progress-fill");
      const progressText = document.querySelector(".progress-text");
      if (progressFill && progressText) {
      progressFill.style.width = "100%";
      progressText.innerText = "Tahap 6 dari 6: Menarik Kesimpulan (100%)";
      }
    });
    </script>
    <script>
      function myFunction() {
      alert("Jawaban Berhasil di Submit!");
      }
      </script>
    <script src="js/script.js"></script>
  </body>
</html>
