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
    <title>PostTest</title>
    <link rel="stylesheet" href="css/posttest.css" />
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
        <section class="judul-test-section">
            <div class="judul-container">
                <h1>Post Test</h1>
                <p>Silakan kerjakan posttest setelah menyelesainkan seluruh materi eksplorasi.</p>
            </div>
            
            <!-- Soal 1 -->
            <div class="question-card">
            <p>Seorang siswa tidak dapat mengakses internet di laptopnya, padahal indikator WiFi menyala. Apa langkah pertama yang harus dilakukan?</p>
            <div class="choices">
                <label for="q1a"><input type="radio" id="q1a" name="q1" value="a"> Periksa apakah ada IP address yang terpasang</label>
                <label for="q1b"><input type="radio" id="q1b" name="q1" value="b"> Langsung ganti modem</label>
                <label for="q1c"><input type="radio" id="q1c" name="q1" value="c"> Mematikan antivirus</label>
                <label for="q1d"><input type="radio" id="q1d" name="q1" value="d"> Restart sistem operasi</label>
                <label for="q1e"><input type="radio" id="q1e" name="q1" value="e"> Ubah ke jaringan kabel</label>
            </div>
            </div>

            <!-- Soal 2 -->
            <div class="question-card">
            <p>Apa fungsi utama dari IP address dalam jaringan komputer?</p>
            <div class="choices">
                <label for="q2a"><input type="radio" id="q2a" name="q2" value="a"> Menyimpan data pengguna</label>
                <label for="q2b"><input type="radio" id="q2b" name="q2" value="b"> Sebagai identitas perangkat dalam jaringan</label>
                <label for="q2c"><input type="radio" id="q2c" name="q2" value="c"> Menghapus data jaringan</label>
                <label for="q2d"><input type="radio" id="q2d" name="q2" value="d"> Mengirimkan virus ke perangkat lain</label>
                <label for="q2e"><input type="radio" id="q2e" name="q2" value="e"> Mengatur kecepatan internet</label>
            </div>
            </div>

            <!-- Soal 3 -->
            <div class="question-card">
            <p>Apa yang membedakan jaringan lokal (LAN) dengan internet?</p>
            <div class="choices">
                <label for="q3a"><input type="radio" id="q3a" name="q3" value="a"> LAN bersifat global, internet bersifat lokal</label>
                <label for="q3b"><input type="radio" id="q3b" name="q3" value="b"> LAN tidak membutuhkan koneksi fisik</label>
                <label for="q3c"><input type="radio" id="q3c" name="q3" value="c"> Internet menghubungkan LAN di seluruh dunia</label>
                <label for="q3d"><input type="radio" id="q3d" name="q3" value="d"> Internet hanya bekerja di kantor</label>
                <label for="q3e"><input type="radio" id="q3e" name="q3" value="e"> LAN membutuhkan satelit</label>
            </div>
            </div>

            <!-- Soal 4 -->
            <div class="question-card">
            <p>Apa yang dimaksud dengan koneksi nirkabel?</p>
            <div class="choices">
                <label for="q4a"><input type="radio" id="q4a" name="q4" value="a"> Menggunakan kabel LAN</label>
                <label for="q4b"><input type="radio" id="q4b" name="q4" value="b"> Menggunakan jaringan fiber</label>
                <label for="q4c"><input type="radio" id="q4c" name="q4" value="c"> Menggunakan sinyal radio atau gelombang elektromagnetik</label>
                <label for="q4d"><input type="radio" id="q4d" name="q4" value="d"> Menghubungkan perangkat dengan USB</label>
                <label for="q4e"><input type="radio" id="q4e" name="q4" value="e"> Menggunakan kabel HDMI</label>
            </div>
            </div>

            <!-- Soal 5 -->
            <div class="question-card">
            <p>Berikut ini merupakan contoh koneksi jaringan berkabel, kecuali:</p>
            <div class="choices">
                <label for="q5a"><input type="radio" id="q5a" name="q5" value="a"> LAN</label>
                <label for="q5b"><input type="radio" id="q5b" name="q5" value="b"> Dial-Up</label>
                <label for="q5c"><input type="radio" id="q5c" name="q5" value="c"> ADSL</label>
                <label for="q5d"><input type="radio" id="q5d" name="q5" value="d"> Wi-Fi</label>
                <label for="q5e"><input type="radio" id="q5e" name="q5" value="e"> Ethernet</label>
            </div>
            </div>

            <!-- Soal 6 -->
            <div class="question-card">
            <p>Apa keuntungan utama menggunakan jaringan lokal di sekolah?</p>
            <div class="choices">
                <label for="q6a"><input type="radio" id="q6a" name="q6" value="a"> Menyebabkan virus menyebar lebih cepat</label>
                <label for="q6b"><input type="radio" id="q6b" name="q6" value="b"> Biaya penggunaan lebih mahal</label>
                <label for="q6c"><input type="radio" id="q6c" name="q6" value="c"> Akses data dan printer bersama antar komputer</label>
                <label for="q6d"><input type="radio" id="q6d" name="q6" value="d"> Mengurangi kecepatan akses</label>
                <label for="q6e"><input type="radio" id="q6e" name="q6" value="e"> Dapat digunakan tanpa komputer</label>
            </div>
            </div>
            
            <!-- Soal 7 -->
            <div class="question-card">
            <p>Perangkat manakah yang bertugas menghubungkan beberapa jaringan dan meneruskan data antar jaringan?</p>
            <div class="choices">
                <label><input type="radio" name="q7" value="a"> Switch</label>
                <label><input type="radio" name="q7" value="b"> Modem</label>
                <label><input type="radio" name="q7" value="c"> Router</label>
                <label><input type="radio" name="q7" value="d"> Access Point</label>
                <label><input type="radio" name="q7" value="e"> Kabel UTP</label>
            </div>
            </div>

            <!-- Soal 8 -->
            <div class="question-card">
            <p>Apakah fungsi dari DNS (Domain Name System)?</p>
            <div class="choices">
                <label><input type="radio" name="q8" value="a"> Menyimpan data pengguna internet</label>
                <label><input type="radio" name="q8" value="b"> Mengatur firewall jaringan</label>
                <label><input type="radio" name="q8" value="c"> Menerjemahkan nama domain menjadi IP address</label>
                <label><input type="radio" name="q8" value="d"> Menghubungkan komputer ke printer</label>
                <label><input type="radio" name="q8" value="e"> Menyediakan koneksi nirkabel</label>
            </div>
            </div>

            <!-- Soal 9 -->
            <div class="question-card">
            <p>Perangkat apa yang digunakan untuk memperkuat sinyal WiFi dalam ruangan?</p>
            <div class="choices">
                <label><input type="radio" name="q9" value="a"> Router</label>
                <label><input type="radio" name="q9" value="b"> Access Point</label>
                <label><input type="radio" name="q9" value="c"> Repeater</label>
                <label><input type="radio" name="q9" value="d"> Bridge</label>
                <label><input type="radio" name="q9" value="e"> Switch</label>
            </div>
            </div>

            <!-- Soal 10 -->
            <div class="question-card">
            <p>Bagaimana cara kerja jaringan peer-to-peer?</p>
            <div class="choices">
                <label><input type="radio" name="q10" value="a"> Semua komputer menjadi server pusat</label>
                <label><input type="radio" name="q10" value="b"> Data disimpan hanya pada satu komputer utama</label>
                <label><input type="radio" name="q10" value="c"> Komputer saling berbagi data tanpa server khusus</label>
                <label><input type="radio" name="q10" value="d"> Semua data harus melalui router</label>
                <label><input type="radio" name="q10" value="e"> Hanya satu komputer yang aktif dalam jaringan</label>
            </div>
            </div>

            <!-- Soal 11 -->
            <div class="question-card">
            <p>Jaringan yang menghubungkan komputer-komputer dalam satu gedung disebut:</p>
            <div class="choices">
                <label><input type="radio" name="q11" value="a"> MAN</label>
                <label><input type="radio" name="q11" value="b"> LAN</label>
                <label><input type="radio" name="q11" value="c"> WAN</label>
                <label><input type="radio" name="q11" value="d"> Internet</label>
                <label><input type="radio" name="q11" value="e"> VPN</label>
            </div>
            </div>

            <!-- Soal 12 -->
            <div class="question-card">
            <p>Apa yang dimaksud dengan bandwidth dalam jaringan komputer?</p>
            <div class="choices">
                <label><input type="radio" name="q12" value="a"> Jumlah perangkat dalam jaringan</label>
                <label><input type="radio" name="q12" value="b"> Kapasitas penyimpanan server</label>
                <label><input type="radio" name="q12" value="c"> Kecepatan akses internet</label>
                <label><input type="radio" name="q12" value="d"> Lebar jalur transmisi data</label>
                <label><input type="radio" name="q12" value="e"> Jumlah sinyal yang terdeteksi</label>
            </div>
            </div>

            <!-- Soal 13 -->
            <div class="question-card">
            <p>Jenis kabel yang sering digunakan dalam jaringan LAN adalah:</p>
            <div class="choices">
                <label><input type="radio" name="q13" value="a"> Kabel HDMI</label>
                <label><input type="radio" name="q13" value="b"> Kabel RCA</label>
                <label><input type="radio" name="q13" value="c"> Kabel UTP</label>
                <label><input type="radio" name="q13" value="d"> Kabel AUX</label>
                <label><input type="radio" name="q13" value="e"> Kabel USB</label>
            </div>
            </div>

            <!-- Soal 14 -->
            <div class="question-card">
            <p>Protokol yang digunakan untuk mentransfer halaman web adalah:</p>
            <div class="choices">
                <label><input type="radio" name="q14" value="a"> FTP</label>
                <label><input type="radio" name="q14" value="b"> HTTP</label>
                <label><input type="radio" name="q14" value="c"> SMTP</label>
                <label><input type="radio" name="q14" value="d"> TCP</label>
                <label><input type="radio" name="q14" value="e"> IPX</label>
            </div>
            </div>

            <!-- Soal 15 -->
            <div class="question-card">
            <p>Perangkat yang menghubungkan jaringan lokal ke internet disebut:</p>
            <div class="choices">
                <label><input type="radio" name="q15" value="a"> Access Point</label>
                <label><input type="radio" name="q15" value="b"> Switch</label>
                <label><input type="radio" name="q15" value="c"> Modem</label>
                <label><input type="radio" name="q15" value="d"> Bridge</label>
                <label><input type="radio" name="q15" value="e"> Server</label>
            </div>
            </div>

            <!-- Soal 16 -->
            <div class="question-card">
            <p>Jaringan WAN umumnya digunakan untuk:</p>
            <div class="choices">
                <label><input type="radio" name="q16" value="a"> Menghubungkan perangkat dalam satu ruangan</label>
                <label><input type="radio" name="q16" value="b"> Menghubungkan kota atau negara yang berbeda</label>
                <label><input type="radio" name="q16" value="c"> Mengakses printer lokal</label>
                <label><input type="radio" name="q16" value="d"> Berbagi file antar folder</label>
                <label><input type="radio" name="q16" value="e"> Menyimpan data lokal</label>
            </div>
            </div>

            <!-- Soal 17 -->
            <div class="question-card">
            <p>Protokol yang digunakan untuk mengirim email adalah:</p>
            <div class="choices">
                <label><input type="radio" name="q17" value="a"> HTTP</label>
                <label><input type="radio" name="q17" value="b"> FTP</label>
                <label><input type="radio" name="q17" value="c"> SMTP</label>
                <label><input type="radio" name="q17" value="d"> IP</label>
                <label><input type="radio" name="q17" value="e"> DHCP</label>
            </div>
            </div>

            <!-- Soal 18 -->
            <div class="question-card">
            <p>Apakah fungsi dari firewall pada jaringan komputer?</p>
            <div class="choices">
                <label><input type="radio" name="q18" value="a"> Meningkatkan kecepatan internet</label>
                <label><input type="radio" name="q18" value="b"> Menyimpan file secara online</label>
                <label><input type="radio" name="q18" value="c"> Melindungi jaringan dari akses tidak sah</label>
                <label><input type="radio" name="q18" value="d"> Mendistribusi sinyal WiFi</label>
                <label><input type="radio" name="q18" value="e"> Memperkuat sinyal kabel</label>
            </div>
            </div>

            <!-- Soal 19 -->
            <div class="question-card">
            <p>Perangkat lunak yang digunakan untuk mengakses halaman web disebut:</p>
            <div class="choices">
                <label><input type="radio" name="q19" value="a"> Compiler</label>
                <label><input type="radio" name="q19" value="b"> Emulator</label>
                <label><input type="radio" name="q19" value="c"> Browser</label>
                <label><input type="radio" name="q19" value="d"> Terminal</label>
                <label><input type="radio" name="q19" value="e"> Downloader</label>
            </div>
            </div>

            <!-- Soal 20 -->
            <div class="question-card">
            <p>Apa yang dimaksud dengan jaringan nirkabel?</p>
            <div class="choices">
                <label><input type="radio" name="q20" value="a"> Jaringan yang menggunakan kabel UTP</label>
                <label><input type="radio" name="q20" value="b"> Jaringan dengan koneksi serat optik</label>
                <label><input type="radio" name="q20" value="c"> Jaringan yang menggunakan gelombang radio</label>
                <label><input type="radio" name="q20" value="d"> Jaringan menggunakan konektor USB</label>
                <label><input type="radio" name="q20" value="e"> Jaringan dengan sistem backup data</label>
            </div>
            </div>

            <!-- Soal 21 -->
            <div class="question-card">
            <p>Manakah contoh alamat IP yang valid?</p>
            <div class="choices">
                <label><input type="radio" name="q21" value="a"> 256.10.10.1</label>
                <label><input type="radio" name="q21" value="b"> 192.168.1.1</label>
                <label><input type="radio" name="q21" value="c"> 10.300.5.4</label>
                <label><input type="radio" name="q21" value="d"> 172.16.999.5</label>
                <label><input type="radio" name="q21" value="e"> 1234.23.5.1</label>
            </div>
            </div>

            <!-- Soal 22 -->
            <div class="question-card">
            <p>Perangkat yang hanya bekerja pada level sinyal dan digunakan untuk memperpanjang jaringan adalah:</p>
            <div class="choices">
                <label><input type="radio" name="q22" value="a"> Switch</label>
                <label><input type="radio" name="q22" value="b"> Router</label>
                <label><input type="radio" name="q22" value="c"> Repeater</label>
                <label><input type="radio" name="q22" value="d"> Hub</label>
                <label><input type="radio" name="q22" value="e"> Firewall</label>
            </div>
            </div>

            <!-- Soal 23 -->
            <div class="question-card">
            <p>Manakah dari berikut ini merupakan alamat domain?</p>
            <div class="choices">
                <label><input type="radio" name="q23" value="a"> 192.168.0.1</label>
                <label><input type="radio" name="q23" value="b"> ftp://192.0.2.1</label>
                <label><input type="radio" name="q23" value="c"> www.sekolahku.sch.id</label>
                <label><input type="radio" name="q23" value="d"> 10.1.1.1</label>
                <label><input type="radio" name="q23" value="e"> 255.255.255.0</label>
            </div>
            </div>

            <!-- Soal 24 -->
            <div class="question-card">
            <p>Fungsi utama kabel patch dalam jaringan adalah:</p>
            <div class="choices">
                <label><input type="radio" name="q24" value="a"> Menghubungkan dua switch langsung</label>
                <label><input type="radio" name="q24" value="b"> Menghubungkan komputer ke printer</label>
                <label><input type="radio" name="q24" value="c"> Menghubungkan komputer ke panel patch atau switch</label>
                <label><input type="radio" name="q24" value="d"> Menghubungkan dua komputer</label>
                <label><input type="radio" name="q24" value="e"> Merekam data jaringan</label>
            </div>
            </div>

            <!-- Soal 25 -->
            <div class="question-card">
            <p>Manakah dari protokol berikut yang digunakan untuk transfer file?</p>
            <div class="choices">
                <label><input type="radio" name="q25" value="a"> HTTP</label>
                <label><input type="radio" name="q25" value="b"> SMTP</label>
                <label><input type="radio" name="q25" value="c"> FTP</label>
                <label><input type="radio" name="q25" value="d"> POP3</label>
                <label><input type="radio" name="q25" value="e"> DNS</label>
            </div>
            </div>
            <!-- Soal 7–20 -->

            <div class="submit">
                <a href="#" class="btn-primary2">Kirim</a>
            </div>
        </section>
        </div>
      </div>
      <script src="js/script.js"></script>
  </body>
</html>
