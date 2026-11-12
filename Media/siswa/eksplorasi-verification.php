<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];
$id_materi =  $_GET['id_materi'];

// Ambil semua jawaban siswa dalam array
$query_jawaban = "SELECT * FROM jawaban_verification
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
    <title>eksplorasi-verification</title>
    <link rel="stylesheet" href="css/topside.css" />
    <link rel="stylesheet" href="css/eksplorasi-layout.css" />
    <link rel="stylesheet" href="css/eksplorasi-verification.css" />
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
        </div>

        <!-- Konten -->
        <section class="explore-section">
          <div class="explore-container">
            <div class="section-title">
              <h2>Tahap 5</h2>
              <p>Silakan evaluasi dan periksa kembali hasil eksplorasi dengan membandingkan data, teori, dan dugaan awal, lalu tentukan kelebihan, kekurangan, serta tarik kesimpulan logis dari temuanmu.</p>
            </div>
            <div class="progress-bar-container">
              <div class="progress-text">Tahap 5 dari 6: Pembuktian (80%)</div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 80%;"></div>
              </div>
            </div> 
              
              
            <?php
            // Materi otomatis berdasarkan id_materi
            $deskripsi = "";
            
            if ($id_materi == 11) {
                $deskripsi = "Kamu sudah membuat dugaan pada Tahap 2. Sekarang nilai apakah dugaanmu benar atau perlu diperbaiki berdasarkan hasil yang kamu temukan di Tahap 3 dan Tahap 4";
            }
            
            elseif ($id_materi == 14) {
                $deskripsi = "Tahap 5 digunakan untuk mengevaluasi dugaan yang kamu buat di Tahap 2 dengan data dan pengetahuan baru yang sudah kamu peroleh sebelumnya.";
            }
            
            elseif ($id_materi == 15) {
                $deskripsi = "<p>
                Ani ingin membeli akses premium aplikasi belajar. Saat login dan melakukan pembayaran,
                Ani memperhatikan beberapa hal berikut:
                </p>
                
                <ul style='margin-left:0; padding-left:18px;'>
                  <li>Halaman login menggunakan <strong>HTTPS</strong></li>
                  <li>Terdapat ikon 🔒 <strong>gembok</strong> pada address bar</li>
                  <li>Proses pembayaran dialihkan ke halaman <strong>bank resmi</strong> dengan <strong>SSL valid</strong></li>
                  <li><strong>OTP</strong> dikirim ke nomor ponselnya sebagai verifikasi</li>
                  <li>Koneksi dilakukan melalui <strong>WiFi rumah</strong></li>
                </ul>
                
                <p>
                Namun, sebelumnya Ani sempat login menggunakan <strong>WiFi publik di café</strong>.
                </p>";
            }
            ?>
            
            <!-- BOX MATERI -->
            <div class="case-box" style="margin-bottom:20px; padding:18px; background:#f1f9ff; border-left:5px solid #3b82f6; border-radius:12px;">
                <p><strong>Studi Kasus Lanjutan:</strong><br>
                    <?= !empty($deskripsi) ? $deskripsi : "Materi belum tersedia untuk materi ini."; ?>
                </p>
            </div>
  

           <form action="jawaban-verification.php" method="post">
           <input type="hidden" name="id_materi" value="<?= $id_materi?>"> 
           <?php
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM analisis WHERE id_materi = $id_materi");
                if (mysqli_num_rows($data) > 0):
                  while($row = mysqli_fetch_array($data)):
              ?>  
           <div class="question-card">
              <img src="../guru/<?= $row['gambar'] ?>"  style="display: block; margin-left: auto; margin-right: auto; max-width: 40%; border-radius: 8px; margin-bottom: 16px;">
              <h3><?= $row['pertanyaan'] ?></h3>
              <input type="hidden" name="id_soal[]" value="<?= $row['id'] ?>">
              <textarea class="essay-input" 
                name="jawaban[<?= $row['id'] ?>]" 
                rows="3" 
                placeholder="Tulis pendapatmu di sini..."><?= htmlspecialchars($jawaban[$row['id']] ?? '') ?></textarea>
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
                    <strong style='color:#0284c7;'>Mantap! </strong><br>
                    Kamu sudah bisa menilai dan membandingkan dengan logis. Tinggal sedikit lagi selesai 🔎
                 </p>";
        } elseif ($id_materi == 14) {
            echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                    <strong style='color:#0284c7;'></strong><br>
                    IKeren! Kamu sudah bisa menilai keamanan & efisiensi. Ini kemampuan tinggi loh!
                 </p>";
        } elseif ($id_materi == 15) {
            echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                    <strong style='color:#0284c7;'></strong><br>
                    Mantap! Kamu bisa membandingkan dua kasus dengan logis ðŸ”Ž
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
              <a href="eksplorasi-generalization.php?id_materi=<?= $id_materi?>" class="btn-primary2">Lanjutkan</a>
            </div>  
            
          </div>
        </section>
      </div>
    </div>
        <script>
            // Contoh untuk halaman Problem Statement
            document.addEventListener("DOMContentLoaded", function () {
                // Ganti angka di sini sesuai tahapnya
                localStorage.setItem("discoveryProgress", "80");

                // Kalau ingin juga update progress bar lokal (di halaman ini)
                const progressFill = document.querySelector(".progress-fill");
                const progressText = document.querySelector(".progress-text");
                if (progressFill && progressText) {
                progressFill.style.width = "80%";
                progressText.innerText = "Tahap 5 dari 6: Pembuktian (80%)";
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
