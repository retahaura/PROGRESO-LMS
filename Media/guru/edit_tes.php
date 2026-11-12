<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];

if (!isset($_GET['id_tes']) || !is_numeric($_GET['id_tes'])) {
    die("ID tidak valid.");
}
$id_tes = $_GET['id_tes'];
// JOIN dua tabel: tes dan kategori
$sql = "SELECT t.*, k.kategori, k.id 
        FROM tes t
        JOIN kategori_tes k ON t.id_kategori = k.id
        WHERE t.id_tes = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error); // Tampilkan error jelas
}
$stmt->bind_param("i", $id_tes);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
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
          <li><a href="#"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a></li>
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
                  <form action="update_tes.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data['id_tes'] ?>">
                    <input type="hidden" name="id_kategori" value="<?= $data['id'] ?>">

                    <label>Kategori:</label><br>
                    <input type="text" name="kategori" value="<?= htmlspecialchars($data['kategori']) ?>" readonly><br><br>

                    <label>Pertanyaan:</label><br>
                    <textarea name="pertanyaan"><?= htmlspecialchars($data['pertanyaan']) ?></textarea><br>
                    <?php if ($data['gambar_pertanyaan']) echo "<img src='{$data['gambar_pertanyaan']}' width='100'><br>"; ?>
                    <input type="file" name="gambar_pertanyaan"><br><br>

                    <?php foreach (['a','b','c','d','e'] as $opt): ?>
                        <label>Jawaban <?= strtoupper($opt) ?>:</label><br>
                        <input type="text" name="jawaban_<?= $opt ?>" value="<?= htmlspecialchars($data["jawaban_$opt"]) ?>"><br>
                        <?php if ($data["gambar_$opt"]) echo "<img src='{$data["gambar_$opt"]}' width='100'><br>"; ?>
                        <input type="file" name="gambar_<?= $opt ?>"><br><br>
                    <?php endforeach; ?>

                    <label>Kunci Jawaban:</label><br>
                    <select name="jawaban_benar">
                        <?php foreach(['A','B','C','D','E'] as $opt): ?>
                        <option value="<?= $opt ?>" <?= $data['jawaban_benar'] == $opt ? 'selected' : '' ?>><?= $opt ?></option>
                        <?php endforeach; ?>
                    </select><br><br>

                    <button type="submit">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
    
    <script src="js/script.js"></script>
  </body>
</html>
