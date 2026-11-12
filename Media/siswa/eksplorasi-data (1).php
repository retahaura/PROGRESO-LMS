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
$query_jawaban = "SELECT * FROM jawaban_data
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
    <title>eksplorasi-data</title>
    <link rel="stylesheet" href="css/topside.css" />
    <link rel="stylesheet" href="css/eksplorasi-layout.css" />
    <link rel="stylesheet" href="css/eksplorasi-data.css" />
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
          <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Keluar</a></li>
        </ul>
      </div>

      <!-- Main Area -->
      <div class="main-content">

        <!-- Topbar -->
        <div class="topbar">
          <div class="title"></div>
        </div>

        <!-- Konten -->
        <!-- Problem Statement index (php) -->
        <section class="explore-section">
          <div class="explore-container">
            <div class="section-title">
              <h2>Tahap 3</h2>
              <p>Perhatikan visualisasi di bawah ini. Visualisasi ini akan membantu Anda memahami konsep atau data dengan lebih mudah dan cepat.</p>
            </div>
            <div class="progress-bar-container">
              <div class="progress-text">Tahap 3 dari 6: Pengumpulan Data (40%)</div>
                <div class="progress-bar">
                <div class="progress-fill" style="width: 40%;"></div>
              </div>
              <!-- Placeholder area untuk 3D Object -->
                <?php $id_materi = $_GET['id_materi'] ?? null;
                  ?>
                <div class="three-d-wrapper">
                    <div class="three-d-area">
                    
                      <?php if ($id_materi == 11 || $id_materi === null): ?>
                      
                     
                        <h1>3D Models</h1>
                                            
                        <div class="three-d-object">
                          <iframe src="https://sketchfab.com/models/69291271f83c43ccbadcc3b07f9c895c/embed?autostart=1"
                                  style="width: 100%; height: 300px; border-radius: 14px;" allowfullscreen></iframe>
                          <p>Computer Networking</p>
                        </div>
                    
                        <div class="three-d-object">
                          <iframe src="https://sketchfab.com/models/bf8e5c96974a40dd82b7618bb2e7962d/embed?autostart=1"
                                  style="width: 100%; height: 300px; border-radius: 14px;" allowfullscreen></iframe>
                          <p>Switch</p>
                        </div>
                    
                        <div class="three-d-object">
                          <iframe src="https://sketchfab.com/models/57738fb52f46403a83b7374daf85921e/embed?autostart=1"
                                  style="width: 100%; height: 300px; border-radius: 14px;" allowfullscreen></iframe>
                          <p>Server Room</p>
                        </div>
                      <?php endif; ?>
                    
                    
                      <?php if ($id_materi == 14 || $id_materi === null): ?>
                      
                    
                        <h1>Perhatikan dengan seksama vidionya </h1>
                        <div class="three-d-object">
                          <iframe width="100%" height="300" 
                                  src="https://www.youtube.com/embed/GPeXcp8i8xQ" 
                                  frameborder="0" 
                                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                  allowfullscreen 
                                  style="border-radius:14px;">
                          </iframe>
                          
                          
                          <p>Mengenal Jaringan 2G, 3G, 4G Hingga 5G</p>
                    </div>
                </div>
                      <?php endif; ?>
                    
                    
                      <?php if ($id_materi == 16 || $id_materi === null): ?>
                      
                     
                        <h1>Observasi Proteksi Data di Situs Web</h1>
                        <div class="three-d-object">
                          <iframe width="100%" height="300" 
                                  src="https://www.youtube.com/embed/AB0VMbvEz7g" 
                                  frameborder="0" 
                                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                  allowfullscreen 
                                  style="border-radius:14px;">
                          </iframe>
                          <p>Video Pembelajaran Perbedaan HTTP dan HTTPS (SSL/TLS Encryption)</p>
                        </div>
                        <?php endif; ?>
              
              
              <?php
                // Studi kasus otomatis berdasarkan id_materi
                $deskripsi = "";
                
                if ($id_materi == 11) {
                    $deskripsi = '
                    <div style="background:#eef7ff; padding:20px; border-radius:12px;">
                        
                        <p>Kamu dapat menggunakan informasi dari:</p>
                        <ul style="margin-left:25px;">
                            <li>3D Model (Networking, Switch, Server Room)</li>
                            <li>Materi singkat halaman ini</li>
                            <li>Pencarian Google</li>
                            <li>Link materi tambahan</li>
                        </ul>
                    </div>
                    ';
                } elseif ($id_materi == 14) {
                    $deskripsi = "Tonton video di atas:
                    “Mengenal Jaringan 2G, 3G, 4G Hingga 5G”
                    Lalu catat minimal 3 informasi penting.
                    ";
                } elseif ($id_materi == 15) {
                    $deskripsi = '
                    <h4>Mengenal Situs Aman dan SSL/TLS</h4>
                    
                    <p>Agar kamu tidak bingung, gunakan situs contoh berikut:</p>
                    <p>🔗 <a href="https://www.sman1-maja.sch.id/" target="_blank">
                    https://www.sman1-maja.sch.id/</a> (situs aman dengan HTTPS)</p>
                    
                    <h4>Langkah-langkah:</h4>
                    
                    <ol style="margin-left:0; padding-left:18px;">
                      <li><strong>Amati situs contoh:</strong>
                        <ul style="margin-left:0; padding-left:18px;">
                          <li>Apakah URL-nya diawali <code>https://</code>?</li>
                          <li>Apakah ada ikon gembok?</li>
                          <li>Klik ikon gembok → periksa informasi keamanan.</li>
                        </ul>
                      </li>
                    
                      <li style="margin-top:8px;"><strong>Lakukan pencarian Google:</strong>
                        <ul style="margin-left:0; padding-left:18px;">
                          <li>Gunakan kata kunci berikut:
                            <ul style="margin-left:0; padding-left:18px;">
                              <li>“fungsi SSL/TLS”</li>
                              <li>“ciri situs aman HTTPS”</li>
                              <li>“bahaya login di HTTP”</li>
                            </ul>
                          </li>
                          <li>Catat temuanmu. Buat daftar ciri situs aman vs tidak aman berdasarkan pengamatan + pencarian.</li>
                        </ul>
                      </li>
                    </ol>
                    ';
                    }

                
                ?>
                
                <!-- BOX STUDI KASUS -->
                <div class="case-box">
                    <p><strong>Petunjuk pengerjaan:</strong><br>
                    <?= !empty($deskripsi) ? $deskripsi : "Deskripsi tidak tersedia."; ?>
                    </p>
                </div>
              
              
            

              <!-- Informasi hasil klik -->
            <div class="info-box info-box-flex">
              <h2>klik teks warna biru berikut untuk membuka eksplorasi atau bisa menggunakan pencaharian langsung di google:<h2>
              <!--<a href="modul.php" class="info-link">-->
                <a href="modul2.php?id_materi=<?= $id_materi ?>" class="info-link">
                >> Gunakan materi tambahan berikut sebagai referensi saat menjawab soal berikutnya
              </a>

              <div class="google-widget-inline">
                <input type="text" id="googleQuery" placeholder="Cari di Google...">
                <button onclick="searchGoogle()">
                  <i class="fab fa-google"></i> Cari
                </button>
              </div>
            </div>



              <form action="jawaban-data.php" method="post">
                <input type="hidden" name="id_materi" value="<?= $id_materi ?>">
            <?php
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM observasi WHERE id_materi = $id_materi");
                if (mysqli_num_rows($data) > 0):
                  while($row = mysqli_fetch_array($data)):
              ?>  
              <div class="question-card">
                <!--<img src="../guru/<?= $row['gambar'] ?>"  style="max-width: 20%; border-radius: 8px; margin-bottom: 16px;">-->
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
            </div>
            
            

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
                                    <strong style='color:#0284c7;'>Kerennn Lanjutkan ya!</strong><br>
                                    Kamu berhasil mengumpulkan informasi penting dari model 3D, bacaan, dan pencarian mandiri. Pemahaman dasar perangkat dan IP address sudah mulai terbentuk—lanjutkan eksplorasinya.
                                 </p>";
                        } elseif ($id_materi == 14) {
                            echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                                    <strong style='color:#0284c7;'></strong><br>
                                    Mantap! Kamu sudah punya semua data yang kamu butuhkan untuk tahap berikutnya. Sekarang kita olah datanya!
                                 </p>";
                        } elseif ($id_materi == 15) {
                            echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                                    <strong style='color:#0284c7;'></strong><br>
                                    Keren! Kamu berhasil mengumpulkan data penting tentang keamanan situs 👏
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
            
            <div class="submit">
              <a href="eksplorasi-processing.php?id_materi=<?= $id_materi?>" class="btn-primary2">Lanjutkan</a>
            </div>
          </div>
        </section>
      </div>
    </div>

    <script>
      function searchGoogle() {
        const query = document.getElementById('googleQuery').value.trim();
        if (query !== "") {
          const url = "https://www.google.com/search?q=" + encodeURIComponent(query);
          window.open(url, "_blank");
        } else {
          alert("Masukkan kata kunci dulu ya!");
        }
      }
    </script>
    <script>
      function myFunction() {
      alert("Jawaban Berhasil di Submit!");
      }
      </script>


    <script>
      // Contoh untuk halaman Problem Statement
      document.addEventListener("DOMContentLoaded", function () {
      // Ganti angka di sini sesuai tahapnya
      localStorage.setItem("discoveryProgress", "40");

      // Kalau ingin juga update progress bar lokal (di halaman ini)
      const progressFill = document.querySelector(".progress-fill");
      const progressText = document.querySelector(".progress-text");
      if (progressFill && progressText) {
      progressFill.style.width = "40%";
      progressText.innerText = "Tahap 3 dari 6: Pengumpulan Data (40%)";
      }
      });
    </script>
    <script src="js/script.js"></script>
  </body>
</html>
