<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];
$id_materi = $_GET['id_materi'];

$stmt = $conn->prepare("SELECT deskripsi FROM materi WHERE id_materi = ?");
$stmt->bind_param("i", $id_materi);
$stmt->execute();
$stmt->bind_result($deskripsi);
$stmt->fetch();
$stmt->close();

// Ambil semua jawaban siswa dalam array
$query_jawaban = "SELECT * FROM jawaban_problem
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
    <title>eksplorasi-problem</title>
    <link rel="stylesheet" href="css/topside.css" />
    <link rel="stylesheet" href="css/eksplorasi-layout.css" />
    <link rel="stylesheet" href="css/eksplorasi-problem.css" />
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
        <!-- Container Utama -->
        <!-- Problem Statement Page (php) -->
        <section class="explore-section">
          <div class="explore-container">
            <div class="section-title">
              <h2>Tahap 2</h2>
              <p>Bacalah studi kasus berikut dan jawab pertanyaannya untuk menganalisis permasalahan dibawah ini!</p>
            </div>

            <div class="progress-bar-container">
              <div class="progress-text">Tahap 2 dari 6: Identifikasi Masalah (25%)</div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 25%;"></div>
              </div>
            </div>

            <?php
            $id_materi = $_GET['id_materi'] ?? null;
            $deskripsi = "";
            
            // Studi kasus per materi
            if ($id_materi == 11) {
                $deskripsi = "Di sekolahmu, WiFi sekolah digunakan oleh banyak perangkat seperti komputer lab, guru, siswa, dan CCTV. Pada jam pelajaran pertama, koneksi internet masih cepat dan stabil. Namun saat jam istirahat atau ketika banyak kelas sedang belajar online, koneksi internet menjadi sangat lambat sehingga siswa kesulitan membuka Google Classroom atau YouTube pembelajaran.
                    Padahal, di rumah biasanya jaringan terasa lebih cepat dan jarang mengalami gangguan seperti itu.";
            } elseif ($id_materi == 14) {
                $deskripsi = "Rara sedang mengikuti kelas online melalui Zoom menggunakan kuota internet miliknya.
                    Awalnya jaringan lancar, tetapi setiap kali dia berpindah ruangan di rumah, koneksi menjadi lambat dan suara gurunya terputus-putus.
                    Setelah dicek, HP Rara ternyata otomatis berpindah dari jaringan 4G ke EDGE ketika sinyal seluler melemah di dalam ruangan tertentu. Selain itu, router WiFi rumahnya berada di lantai bawah dan sinyalnya tidak menjangkau tempat belajar Rara di lantai atas.
                    Akibatnya, ia tidak bisa mengikuti kelas dengan baik dan guru memberikan tugas ulang.

                ";
            } elseif ($id_materi == 15) {
                $deskripsi = "Rafi ingin login ke akun e-learning sekolah menggunakan Wi-Fi publik di sebuah kafe.
                    Situs yang ia buka ternyata masih menggunakan HTTP dan terdapat peringatan “Not Secure”, tetapi Rafi tetap memasukkan username dan password.
                    Beberapa hari kemudian, akun e-learningnya digunakan pihak lain untuk mengirim pesan dan mengubah data tugas, serta email reset password miliknya juga diduga ikut disadap melalui jaringan.
                    ";
            }
            ?>

            <div class="case-box">
              <p><strong>Perhatikan studi kasus dibawah ini:</strong><br>
               <?php echo !empty($deskripsi) ? $deskripsi : "Deskripsi tidak tersedia."; ?>
              </p>
            </div>
            
            
            <form action="jawaban-problem.php" method="post">
              <input type="hidden" name="id_materi" value="<?= $id_materi ?>">
            <?php
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM studi_kasus WHERE id_materi = $id_materi");
                if (mysqli_num_rows($data) > 0):
                  while($row = mysqli_fetch_array($data)):
              ?>  
            <div class="question-card">
              <img src="../guru/<?= $row['gambar'] ?>"  class="center-img" style="max-width: 40%; border-radius: 8px; margin-bottom: 16px;">
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
            <button type="submit" class="btn-primary" onclick="myFunction()">Submit</button>
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
                                <strong style='color:#0284c7;'>Jawabanmu keren bangettt!!!</strong><br>
                               Kamu sudah mencoba mengidentifikasi masalah dari situasi nyata. Pertahankan kemampuan analisis ini, karena di tahap selanjutnya kamu akan memperdalam alasan dan penyebabnya.
                             </p>";
                    } elseif ($id_materi == 14) {
                        echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                                <strong style='color:#0284c7;'></strong><br>
                                Good job! Kamu sudah mulai berpikir kritis. Sekarang kita kumpulkan bukti biar analisismu makin kuat!
                             </p>";
                    } elseif ($id_materi == 15) {
                        echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                                <strong style='color:#0284c7;'></strong><br>
                                Oke! Dugaan awalmu sudah logis dan sesuai kasus 👍
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
              <a href="eksplorasi-data.php?id_materi=<?= $id_materi?>" class="btn-primary">Lanjutkan</a>
            </div>
            
          </div>
        </section>
      </div>
    </div>
    <script>
      // Contoh untuk halaman Problem Statement
      document.addEventListener("DOMContentLoaded", function () {
      // Ganti angka di sini sesuai tahapnya
      localStorage.setItem("discoveryProgress", "25");

      // Kalau ingin juga update progress bar lokal (di halaman ini)
      const progressFill = document.querySelector(".progress-fill");
      const progressText = document.querySelector(".progress-text");
      if (progressFill && progressText) {
      progressFill.style.width = "25%";
      progressText.innerText = "Tahap 2 dari 6: Identifikasi Masalah (25%)";
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
