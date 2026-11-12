<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-materi</title>
    <link rel="stylesheet" href="css/admin-materi.css" />
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
        <main class="content">
          <header>
            <h1>Kelola Materi Eksplorasi</h1>
          </header>

          <section class="materi-tahap">
            <div class="tahap-box">
              <h2>Tahap 1: Gambar + Esai (Pemicu Visual)</h2>
              <p><strong>Tipe Soal:</strong> Esai</p>
              <div class="question">
                <input type="text" placeholder="Pertanyaan esai..." />
                <input type="file" accept="image/*" />
                <button class="hapus-soal">Hapus Soal</button>
              </div>
              <button class="tambah-soal">Tambah Soal</button>
              <button class="reset-semua">Reset Semua</button>
            </div>

            <div class="tahap-box">
              <h2>Tahap 2: Studi Kasus (Studi Kritis)</h2>
              <p><strong>Tipe Soal:</strong> Esai</p>
              <div class="question">
                <input type="text" placeholder="Pertanyaan studi kasus..." />
                <input type="file" accept="image/*" />
                <button class="hapus-soal">Hapus Soal</button>
              </div>
              <button class="tambah-soal">Tambah Soal</button>
              <button class="reset-semua">Reset Semua</button>
            </div>

            <div class="tahap-box">
              <h2>Tahap 3: Observasi 3D (Analisis Objek)</h2>
              <p><strong>Tipe Soal:</strong> Esai</p>
              <div class="question">
                <input type="text" placeholder="Pertanyaan esai 3D..." />
                <input type="file" accept="image/*" />
                <input type="file" accept=".glb,.gltf" />
                <button class="hapus-soal">Hapus Soal</button>
              </div>
              <button class="tambah-soal">Tambah Soal</button>
              <button class="reset-semua">Reset Semua</button>
            </div>

            <!-- Tahap 4 PG -->
            <div class="tahap-box">
              <h2>Tahap 4A: Interaktif (Evaluasi Konsep - PG)</h2>
              <p><strong>Tipe Soal:</strong> PG</p>

              <div class="question">
                <div class="pertanyaan">
                  <input type="text" placeholder="Pertanyaan PG..." />
                  <input type="file" accept="image/*" />
                </div>

                <div class="choices">
                  <div class="choice-row">
                    <input type="text" placeholder="Opsi A" />
                    <input type="file" accept="image/*" />
                  </div>
                  <div class="choice-row">
                    <input type="text" placeholder="Opsi B" />
                    <input type="file" accept="image/*" />
                  </div>
                  <div class="choice-row">
                    <input type="text" placeholder="Opsi C" />
                    <input type="file" accept="image/*" />
                  </div>
                  <div class="choice-row">
                    <input type="text" placeholder="Opsi D" />
                    <input type="file" accept="image/*" />
                  </div>
                  <div class="choice-row">
                    <input type="text" placeholder="Opsi E" />
                    <input type="file" accept="image/*" />
                  </div>
                </div>

                <div class="kunci-jawaban">
                  <label>Pilih Kunci Jawaban:</label>
                  <select>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>E</option>
                  </select>
                </div>

                <button type="button" class="hapus-soal">Hapus Soal</button>
              </div>

              <button type="button" class="tambah-soal">Tambah Soal</button>
              <button type="button" class="reset-semua">Reset Semua Soal</button>
            </div>


            <!-- Tahap 4 Drag & Drop -->
            <div class="tahap-box">
              <h2>Tahap 4B: Interaktif (Evaluasi Konsep - Drag & Drop)</h2>
              <p><strong>Tipe Soal:</strong> Drag & Drop</p>

              <div class="question">
                <div class="pertanyaan">
                  <input type="text" placeholder="Instruksi Drag & Drop..." />
                  <input type="file" accept="image/*" />
                </div>
                <button type="button" class="hapus-soal">Hapus Soal</button>
              </div>

              <button type="button" class="tambah-soal">Tambah Soal</button>
              <button type="button" class="reset-semua">Reset Semua Soal</button>
            </div>
                        
            <div class="tahap-box">
              <h2>Tahap 5: Analisis Lanjutan</h2>
              <p><strong>Tipe Soal:</strong> Esai HOTS</p>
              <div class="question">
                <input type="text" placeholder="Soal HOTS..." />
                <input type="file" accept="image/*" />
                <button class="hapus-soal">Hapus Soal</button>
              </div>
              <button class="tambah-soal">Tambah Soal</button>
              <button class="reset-semua">Reset Semua</button>
            </div>

            <div class="tahap-box">
              <h2>Tahap 6: Refleksi & Ringkasan</h2>
              <p><strong>Tipe Soal:</strong> Esai Reflektif</p>
              <div class="question">
                <input type="text" placeholder="Pertanyaan refleksi..." />
                <input type="file" accept="image/*" />
                <button class="hapus-soal">Hapus Soal</button>
              </div>
              <button class="tambah-soal">Tambah Soal</button>
              <button class="reset-semua">Reset Semua</button>
            </div>


            <!-- ===== Materi Tambahan ===== -->
            <div class="tahap-box tambahan-box">
              <h2>Materi Tambahan</h2>
              <p>Upload PDF yang dapat dibaca oleh siswa di tahap tertentu.</p>
              <form class="form-tambah" enctype="multipart/form-data">
                <input type="text" placeholder="Judul materi...">
                <input type="file" accept="application/pdf">
                <button type="submit">Upload Materi PDF</button>
              </form>
              <ul class="daftar-materi">
                <li>
                  📄 Modul Tahap 4 (modul.pdf)  
                  <button>Lihat</button> 
                  <button>Edit</button> 
                  <button>Hapus</button>
                </li>
              </ul>
            </div>
          </section>
            <div class="submit">
              <button class="btn-primary">Submit</button>
            </div>
        </main>




    </div>
       
    <script src="js/script.js"></script>
  </body>
</html>
