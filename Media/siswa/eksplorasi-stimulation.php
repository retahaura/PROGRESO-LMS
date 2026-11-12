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
$query_jawaban = "SELECT * FROM jawaban_stimulan
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
    <title>eksplorasi-stimulation</title>
    <link rel="stylesheet" href="css/topside.css" />
    <link rel="stylesheet" href="css/eksplorasi-layout.css" />
    <link rel="stylesheet" href="css/eksplorasi-stimulation.css" />
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
        <!-- Problem Statement Page (php) -->
        <section class="explore-section">
          <div class="explore-container">
            <div class="section-title">
              <h2>Tahap 1</h2>
              <p>Sebelum memulai eksplorasi, yuk jawab dulu pertanyaan ini untuk membangkitkan rasa ingin tahu kamu!</p>
            </div>

            <div class="progress-bar-container">
              <div class="progress-text">Tahap 1 dari 6: Pemberian Rangsangan (10%)</div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 10%;"></div>
              </div>
            </div>
            
            <?php
            // Studi kasus otomatis berdasarkan id_materi
            $deskripsi = "";
            
            if ($id_materi == 11) {
                $deskripsi = "

                    <p>
                    Dalam kehidupan sehari-hari kita sering menggunakan WiFi di sekolah, lab komputer, dan internet untuk mengakses informasi. 
                    Namun, tidak semua jaringan itu sama. Ada jaringan lokal (LAN) yang hanya mencakup area terbatas, dan ada internet yang 
                    menjangkau seluruh dunia. Pada kegiatan ini, kamu akan mulai membedakan kedua jenis jaringan tersebut berdasarkan cakupan 
                    wilayah dan contoh penggunaannya.
                    </p>
                
                    <img src='assets/LAN vs Internet.png' alt='LAN vs Internet' 
                         style='width:100%; max-width:600px; border-radius:10px; margin:15px 0;'>
                
                    <h4><b>1. Apa itu LAN?</b></h4>
                    <p>
                    LAN (Local Area Network) adalah jaringan komputer dalam area kecil seperti rumah, sekolah, kantor, atau lab komputer. 
                    </p>
                
                    <ul style='margin-left:25px;'>
                        <li>Jaringan komputer lab sekolah</li>
                        <li>WiFi rumah</li>
                        <li>Warnet</li>
                    </ul>
                
                    <h4><b>2. Apa itu Internet?</b></h4>
                    <p>
                    Internet adalah jaringan sangat besar yang menghubungkan banyak LAN dari seluruh dunia.
                    </p>
                
                
                    <p>Contoh: YouTube, Google, game online, Zoom, TikTok.</p>
                
                    <h4><b>3. Perangkat Jaringan yang Harus Kamu Kenal</b></h4>
                
                    <p><b>• Switch — Penghubung dalam satu area</b><br>
                    
                     <img src='assets/Switch.png' alt='Internet Global' 
                         style='width:30%; max-width:600px; border-radius:10px; margin:15px 0;'><br> 
                    Seperti contoh gambar yang ada di atas.<br> 
                    Switch adalah penghubung perangkat dalam jaringan LAN yang meneruskan data hanya ke perangkat yang dituju. Contohnya digunakan untuk menghubungkan banyak komputer di ruangan/gedung yang sama.
                    </p>
                
                    <p><b>• Router — Gerbang menuju Internet</b><br>
                     <img src='assets/Router.png' alt='Internet Global' 
                         style='width:30%; max-width:600px; border-radius:10px; margin:15px 0;'><br> 
                    Seperti contoh gambar yang ada di atas.<br>
                    Router berfungsi menghubungkan satu jaringan dengan jaringan lainnya. serta mengatur rute (jalan) terbaik untuk data agar sampai ke tujuannya.
                        Kalau switch bekerja di dalam jaringan lokal (LAN), router bekerja untuk menghubungkan LAN ke internet.

                    </p>
                
                    <p><b>• Server — Tempat penyimpanan besar</b><br>
                    <img src='assets/server.jpg' alt='Internet Global' 
                         style='width:30%; max-width:600px; border-radius:10px; margin:15px 0;'><br> 
                    Seperti contoh gambar yang ada di atas.<br>
                    Server adalah penyedia layanan di jaringan yang memenuhi permintaan dari perangkat lain (klien).
                    Contoh layanan: website, penyimpanan file, database, email, game online, dll.<br>


                
                    <ul style='margin-left:25px;'>
                        <li>Pembeli = klien</li>
                        <li>Kasir = server</li>
                        <li>Server melayani permintaan dan menyediakan data.</li>
                    </ul>
                   </p>
                   
                    
                    <p><b>• ISP — Penyedia Internet</b><br>
                    ISP (Internet Service Provider) adalah perusahaan atau penyedia layanan yang memberikan akses internet kepada pengguna, baik rumah, kantor, maupun instansi.<br>
                    Sederhananya:
                    👉 ISP = perusahaan yang menjual koneksi internet.<br>

                    Contoh: IndiHome, Biznet, First Media.
                    </p>";
                
            } elseif ($id_materi == 14) {
                $deskripsi =  "
                <style>
                    .indent-ul {
                        margin-left: 25px;
                        padding-left: 10px;
                    }
                </style>
            
                <p>Agar kamu tidak bingung saat mengerjakan kegiatan di setiap tahap, pelajari dulu penjelasan singkat ini.</p>
            
                <section>
                  <h4>📌 Apa itu komunikasi data pada perangkat bergerak?</h4>
                  <p>Komunikasi data adalah proses perpindahan data dari HP ke perangkat lain atau internet.</p>
                  <p>Contohnya: membuka Instagram, mengirim pesan WhatsApp, hotspot, Bluetooth, dll.</p>
                </section>
            
                <section>
                  <h4>📌 Jenis-jenis komunikasi data yang umum di ponsel</h4>
                  <ul class='indent-ul'>
                    <li><strong>Data Seluler (GPRS/EDGE/3G/HSPA/HSDPA/4G)</strong> → pakai jaringan operator.</li>
                    <li><strong>WiFi</strong> → pakai router/hotspot dari modem.</li>
                    <li><strong>Bluetooth</strong> → jarak dekat, untuk kirim file/menyambungkan speaker.</li>
                    <li><strong>Kabel data</strong> → transfer file ke laptop/PC.</li>
                  </ul>
                </section>
            
                <section>
                  <h4>📌 Alur singkat koneksi data seluler</h4>
                  <p>Saat HP kamu mengakses internet:</p>
                  <p><strong>HP → BTS (menara pemancar) → Server operator → Internet → Aplikasi kamu</strong></p>
                  <p>Semakin canggih generasi jaringan, semakin cepat proses kirim-ambil datanya.</p>
                </section>
            
                <section>
                  <h4>📌 Kenapa koneksi bisa cepat atau lambat?</h4>
                  <p>Perbedaan kecepatan tergantung pada generasi jaringan:</p>
                  <ul class='indent-ul'>
                    <li><strong>GPRS/EDGE:</strong> lambat → cocok untuk chat ringan.</li>
                    <li><strong>3G/HSPA:</strong> lumayan cepat → bisa streaming rendah.</li>
                    <li><strong>4G:</strong> stabil & cepat → cocok untuk YouTube, game, Zoom.</li>
                  </ul>
                  <p>Semakin tinggi generasi jaringan → makin cepat.</p>
                </section>
            
                <section>
                  <h4>Gambaran urutan jaringan (dari paling lambat ke tercepat)</h4>
                  <p>Urutannya yang benar:</p>
                  <p><strong>GPRS → EDGE → 3G → HSPA → HSDPA → 4G/LTE</strong></p>
                </section>";
                
            } elseif ($id_materi == 15) {
                $deskripsi = "<h4>Keamanan Informasi & Enkripsi</h4>
                    <p>Keamanan informasi adalah upaya melindungi data dari akses yang tidak sah.</p>
                    <p>Enkripsi adalah proses mengubah data menjadi kode acak sehingga hanya bisa dibaca oleh pihak yang memiliki kunci.</p>
                    <p>Enkripsi melindungi:</p>
                    
                    <ul style='margin-left:0; padding-left:18px;'>
                      <li>password</li>
                      <li>data login</li>
                      <li>informasi transaksi</li>
                      <li>pesan pribadi</li>
                    </ul>
                    
                    <p>Tanpa enkripsi, data yang dikirim melalui internet dapat dengan mudah “diintip” oleh pihak lain.</p>
                    <hr>
                    
                    <h4>HTTP vs HTTPS</h4>
                    <ul style='margin-left:0; padding-left:18px;'>
                      <li>HTTP ➜ komunikasi tidak terenkripsi (rawan disadap)</li>
                      <li>HTTPS ➜ komunikasi terenkripsi dengan SSL/TLS sehingga aman</li>
                    </ul>
                    
                    <p>Apa itu SSL/TLS? Protokol yang mengamankan data di internet dengan enkripsi, terlihat dari <code>https://</code> dan ikon gembok di browser.</p>
                    
                    <p>Ciri situs aman:</p>
                    <ul style='margin-left:0; padding-left:18px;'>
                      <li>Ada ikon 🔒 gembok</li>
                      <li>Alamat diawali <code>https://</code></li>
                      <li>Sertifikat SSL valid</li>
                      <li>Tidak ada peringatan “Not Secure”</li>
                    </ul>
                    <hr>
                    
                    <h4>Fungsi SSL/TLS</h4>
                    <p>SSL/TLS melindungi data dengan cara:</p>
                    <ul style='margin-left:0; padding-left:18px;'>
                      <li>Enkripsi: membuat data tidak dapat dibaca pihak ketiga</li>
                      <li>Otentikasi: memastikan situs yang diakses adalah asli, bukan palsu</li>
                      <li>Integritas: memastikan data tidak dimodifikasi selama perjalanan</li>
                    </ul>
                    <hr>
                    
                    <h4>Risiko Menggunakan Wi-Fi Publik</h4>
                    <ul style='margin-left:0; padding-left:18px;'>
                      <li>Pencurian data</li>
                      <li>Serangan MITM (Man-in-the-Middle)</li>
                      <li>Hotspot palsu</li>
                      <li>Malware & phishing</li>
                      <li>Pelacakan aktivitas</li>
                    </ul>
                    <hr>
                    
                    <h4>Tindakan Preventif Utama</h4>
                    <ul style='margin-left:0; padding-left:18px;'>
                      <li>Gunakan HTTPS</li>
                      <li>Gunakan password kuat</li>
                      <li>Aktifkan autentikasi dua faktor (2FA)</li>
                      <li>Enkripsi file penting</li>
                      <li>Gunakan VPN pada jaringan publik</li>
                      <li>Hindari login/transaksi di Wi-Fi publik</li>
                      <li>Update aplikasi dan perangkat</li>
                    </ul>
                    
                    
                    <h4>Perhatikan perbandingan tampilan dua alamat situs:</h4>
                    <ul style='margin-left:0; padding-left:18px;'>
                      <li>http://contoh-login.com — muncul tanda “Not Secure”</li>
                      <li>https://contoh-login.com — terdapat ikon gembok 🔒</li>
                    </ul>
                    <h4>Bandingkan tampilan dan indikator keamanannya.<h4>
                    ";
            }
            ?>

            <!-- BOX STUDI KASUS -->
            <div class="case-box">
                <p><strong>Materi singkat:</strong><br>
                <?= !empty($deskripsi) ? $deskripsi : "Deskripsi tidak tersedia."; ?>
                </p>
            </div>
                     
 
            
            <form action="jawaban-stimulan.php" method="post">
              <input type="hidden" name="id_materi" value="<?= $id_materi ?>">
            <div class="quiz-box">
              <?php
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM pemicu_visual WHERE id_materi = $id_materi");
                if (mysqli_num_rows($data) > 0):
                  while($row = mysqli_fetch_array($data)):
              ?>
              <div class="quiz-image">
                <img src="../guru/<?= $row['gambar'] ?>"  style="max-width: 40%; border-radius: 8px; margin-bottom: 16px;">
              </div>
              <div class="quiz-question">
                <label><h3><?= $row['esai'] ?></h3></label>
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
              <button class="btn-primary" type="submit" onclick="myFunction()">Submit</button>
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
                                <strong style='color:#0284c7;'>Terima kasih sudah mengisi bagian tahap awal ya! tingkatkan lagi pemahamanmu yak</strong><br>
                                Jawabanmu sudah menunjukkan usaha memahami konsep awal jaringan. Tetap lanjutkan rasa ingin tahumu karena materi berikutnya akan membuat gambaranmu semakin jelas.
                            </p>";
                    } elseif ($id_materi == 14) {
                        echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                                <strong style='color:#0284c7;'>HAI TEMAN!!</strong><br>
                                Keren sekali! Kamu sudah mulai memetakan perbedaan koneksi. Lanjut yuk, kita perdalam kasus nyatanya!
                            </p>";
                    } elseif ($id_materi == 15) {
                        echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                                <strong style='color:#0284c7;'></strong><br>
                                Bagus! Kamu sudah mengamati indikator keamanan dengan tepat 😊
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
              <a href="eksplorasi-problem.php?id_materi=<?= $id_materi?>" class="btn-primary">Lanjutkan</a>
            </div>
          </div>
        </section>
      </div>
    </div>
    <script>
      // Contoh untuk halaman Problem Statement
      document.addEventListener("DOMContentLoaded", function () {
      // Ganti angka di sini sesuai tahapnya
      localStorage.setItem("discoveryProgress", "10");
      // Kalau ingin juga update progress bar lokal (di halaman ini)
      const progressFill = document.querySelector(".progress-fill");
      const progressText = document.querySelector(".progress-text");
      if (progressFill && progressText) {
      progressFill.style.width = "10%";
      progressText.innerText = "Tahap 1 dari 6: Pemberian Rangsangan (10%)";
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
