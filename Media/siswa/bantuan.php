<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>perlu bantuan</title>
    <link rel="stylesheet" href="css/bantuan.css" />
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
            <!--    <div class="search-box">-->
            <!--      <i class="fas fa-search"></i>-->
            <!--      <input type="text" placeholder="Cari modul atau topik...">-->
            <!--    </div>-->
            <!--    <div class="topbar-icons">-->
            <!--      <i class="fas fa-bell"></i>-->
            <!--    </div>-->
            <!--</div>-->
          </div>

          <!-- Konten -->
          <main class="content">
              <!--<section class="support-section">-->
              <!--    <h2>Bantuan Langsung</h2>-->
              <!--    <div class="support-contact">-->
              <!--        <a href="https://wa.me/6281234567890?text=Halo%20Admin" class="contact-button">Hubungi via WhatsApp</a>-->
              <!--        <div class="contact-info">-->
              <!--           <p>Email dukungan: <a href="mailto:retahaura@gmail.com">support@progreso.id</a></p>-->
              <!--        </div>-->
              <!--    </div>-->
              <!--</section>-->
              
            <section class="judul-lkpd-section">
                    <div class="judul-container">
                        <h1>Perlu Bantuan?</h1>
                        <p>Di halaman ini kamu bisa menemukan pedoman penggunaan LMS, daftar referensi/rujukan, serta kontak yang dapat dihubungi jika membutuhkan bantuan lebih lanjut.</p>
                    </div>
              
                <section class="card guide-section">
                  <h3>Pedoman Penggunaan Web</h3>
                
                  <!-- Step 1: Pre-Test -->
                  <div class="guide-step">
                    <img src="assets/test1.png" alt="Pre-Test LMS">
                    <p><strong>Pre-Test:</strong> Setelah login, Siswa harus mengerjakan pre-test untuk mengukur pemahaman awal sebelum memasuki tahapan pembelajaran.</p>
                  </div>
                  
                
                  <!-- Step 2: Beranda -->
                  <div class="guide-step">
                    <img src="assets/beranda.png" alt="Beranda LMS">
                    <p><strong>Beranda:</strong> Setelah mengerjakan Pre-Test, kembali kehalaman beranda, siswa akan melihat daftar pertemuan. Klik salah satu pertemuan untuk memulai pembelajaran.</p>
                  </div>
                
                  <!-- Step 3: Tahapan Pembelajaran -->
                  <div class="guide-step">
                    <img src="assets/tahap.png" alt="Tahapan LMS">
                    <p><strong>Tahapan:</strong> Kerjakan semua tahapan pertemuan sesuai urutan. Setiap tahapan memiliki progress bar untuk memantau kemajuan.</p>
                  </div>
                
                  <!-- Step 4: Materi Tambahan -->
                  <div class="guide-step">
                    <img src="assets/materi.png" alt="Materi Tambahan LMS">
                    <p><strong>Materi Tambahan:</strong> Setelah menyelesaikan tahapan pembelajaran, materi tambahan akan terbuka. Bisa digunakan untuk mendalami topik yang dipelajari.</p>
                  </div>
                
                  <!-- Step 5: LKPD -->
                  <div class="guide-step">
                    <img src="assets/lkpd.png" alt="LKPD LMS">
                    <p><strong>LKPD:</strong> Lembar kerja akan tersedia setelah tahapan selesai. Gunakan untuk latihan atau mengerjakan tugas terkait pertemuan.</p>
                  </div>
                
                  <!-- Step 6: Post-Test -->
                  <div class="guide-step">
                    <img src="assets/test2.png" alt="Post-Test LMS">
                    <p><strong>Post-Test:</strong> Setelah menyelesaikan semua pertemuan, siswa harus mengerjakan post-test untuk menilai peningkatan pemahaman.</p>
                  </div>
                </section>

                              
                <div class="reference-contact-container">
                      <!-- Box Sumber Rujukan -->
                    <section class="support-section guide-reference-contact">
                        <h2>Sumber Rujukan</h2>
                        <div class="support-contact">
                          <a href="referensi.php" class="contact-button">Lihat Rujukan</a>
                          <div class="contact-info">
                            <p>Beberapa referensi penting untuk mendalami materi pembelajaran</p>
                          </div>
                        </div>
                    </section>
                
                    <section class="support-section">
                      <h2>Bantuan Langsung</h2>
                      <div class="support-contact">
                          <a href="https://wa.me/6281234567890?text=Halo%20Admin" class="contact-button">Hubungi via WhatsApp</a>
                          <div class="contact-info">
                             <p>Email dukungan <a href="mailto:retahaura@gmail.com">support@progreso.id</a></p>
                          </div>
                      </div>
                    </section>
                </div>
            </section>
        </div>
      </div>
      <script src="js/script.js"></script>
  </body>
</html>
