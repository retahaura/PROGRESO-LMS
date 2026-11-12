<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];

$id_tes = $_GET['kategori'];
$sql = "SELECT * FROM tes WHERE id_kategori = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_tes);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
} else {
    echo "Tidak ada pertanyaan yang ditemukan";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PreTest</title>
    <link rel="stylesheet" href="css/pretest.css" />
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
                <h1>Pre Test</h1>
                <p>Silakan kerjakan pretest sebelum memulai eksplorasi.</p>
            </div>

            <form action="proses-tes.php" method="post">
                <input type="hidden" name="id_kategori" value="<?php echo $id_tes; ?>">

                <?php foreach ($questions as $index => $question): ?>
                <div class="question-card">
                    <!-- Pertanyaan -->
                    <p><strong><?php echo ($index + 1) . ". " . $question['pertanyaan']; ?></strong></p>

                    <!-- Gambar Pertanyaan -->
                    <?php if (!empty($question['gambar_pertanyaan'])): ?>
                        <img src="../guru/<?php echo $question['gambar_pertanyaan']; ?>" alt="Gambar Pertanyaan" width="250">
                    <?php endif; ?>

                    <!-- Pilihan Jawaban -->
                    <div class="choices">
                        <?php
                        $options = ['a', 'b', 'c', 'd', 'e'];
                        foreach ($options as $opt):
                            $jawaban = $question['jawaban_' . $opt];
                            $gambar = $question['gambar_' . $opt];
                            if (!empty($jawaban)):
                                $inputId = "q{$question['id_tes']}{$opt}";
                        ?>
                            <label for="<?php echo $inputId; ?>">
                                <input type="radio" id="<?php echo $inputId; ?>" name="question<?php echo $question['id_tes']; ?>" value="<?php echo strtoupper($opt); ?>">
                                <?php echo $jawaban; ?>
                                <?php if (!empty($gambar)): ?>
                                    <br><img src="../guru/<?php echo $gambar; ?>" alt="Gambar Jawaban" width="150">
                                <?php endif; ?>
                            </label><br>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="submit">
                    <button type="submit" class="btn-primary2">Kirim</button>
                </div>
            </form>
        </section>

        </div>
      </div>
      <script src="js/script.js"></script>
  </body>
</html>
