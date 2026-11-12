<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];
$id_materi = $_GET['materi'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-materi</title>
    <link rel="stylesheet" href="css/admin-materi.css?v=<?= time(); ?>" />
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
              <h2>Tahap 4 – Pengolahan Data </h2>
              <p><strong>Tipe Soal:</strong> PG</p>

              <div class="question">
              <form action="insert_pg.php" method="post" enctype="multipart/form-data" id="formSoal">
              <input type="hidden" name="id_materi" value="<?= $id_materi?>">
              <div id="container-soal" class=""></div>
               <div class="control-buttons">
                <button type="button" onclick="tambahSoal()">Tambah Soal</button>
                <button type="button" onclick="resetSoal()">Reset Semua Soal</button>
                <button type="submit">Submit Semua Soal</button>
              </div>
              </form>
            </div>
            </section>
            <div class="submit"> 
            <a href="observasi.php?materi=<?php echo $id_materi?>" class="before">Tahap 3 - Observasi 3D</a>
            <a href="tahap4b.php?materi=<?php echo $id_materi?>" class="next">Tahap 4B - Interaktif (Evaluasi Konsep - Drag & Drop)</a>
            </div>
        </main>

    </div>
       
    <script src="js/script.js"></script>
     <script>
  let soalList = []; // Menyimpan semua soal

  function tambahSoal() {
  simpanInputSebelumnya(); // Simpan dulu input lama ke soalList
  soalList.push({}); // Tambahkan soal baru kosong
  renderSoal();
}

  function hapusSoal(index) {
    soalList.splice(index, 1); // Hapus soal dari array
    renderSoal();
  }

  function resetSoal() {
    soalList = [{}]; // Isi dengan satu soal default
    renderSoal();
  }

  function simpanInputSebelumnya() {
  const container = document.getElementById("container-soal");
  const soalContainers = container.querySelectorAll(".soal-container");

  soalContainers.forEach((soalDiv, index) => {
    const pertanyaan = soalDiv.querySelector(`input[name="soal[${index}][pertanyaan]"]`)?.value;
    const jawaban_a = soalDiv.querySelector(`input[name="soal[${index}][jawaban_a]"]`)?.value;
    const jawaban_b = soalDiv.querySelector(`input[name="soal[${index}][jawaban_b]"]`)?.value;
    const jawaban_c = soalDiv.querySelector(`input[name="soal[${index}][jawaban_c]"]`)?.value;
    const jawaban_d = soalDiv.querySelector(`input[name="soal[${index}][jawaban_d]"]`)?.value;
    const jawaban_e = soalDiv.querySelector(`input[name="soal[${index}][jawaban_e]"]`)?.value;
    const jawaban_benar = soalDiv.querySelector(`select[name="soal[${index}][jawaban_benar]"]`)?.value;

    soalList[index] = {
      pertanyaan,
      jawaban_a,
      jawaban_b,
      jawaban_c,
      jawaban_d,
      jawaban_e,
      jawaban_benar,
      // Gambar tidak bisa disimpan karena file tidak bisa diakses dari JS setelah dipilih
    };
  });
  }


 function renderSoal() {
  const container = document.getElementById("container-soal");
  container.innerHTML = "";

  soalList.forEach((soal, index) => {
    const div = document.createElement("div");
    div.className = "soal-container";
    div.id = `soal-${index}`;

    div.innerHTML = `
      <h4>Soal #${index + 1}</h4>
      <input type="text" name="soal[${index}][pertanyaan]" placeholder="Pertanyaan PG" value="${soal.pertanyaan || ''}" required><br>
      <input type="file" name="soal[${index}][gambar_pertanyaan]"><br>

      <label>Opsi A</label><input type="text" name="soal[${index}][jawaban_a]" value="${soal.jawaban_a || ''}" required>
      <input type="file" name="soal[${index}][gambar_a]"><br>

      <label>Opsi B</label><input type="text" name="soal[${index}][jawaban_b]" value="${soal.jawaban_b || ''}" required>
      <input type="file" name="soal[${index}][gambar_b]"><br>

      <label>Opsi C</label><input type="text" name="soal[${index}][jawaban_c]" value="${soal.jawaban_c || ''}" required>
      <input type="file" name="soal[${index}][gambar_c]"><br>

      <label>Opsi D</label><input type="text" name="soal[${index}][jawaban_d]" value="${soal.jawaban_d || ''}" required>
      <input type="file" name="soal[${index}][gambar_d]"><br>

      <label>Opsi E</label><input type="text" name="soal[${index}][jawaban_e]" value="${soal.jawaban_e || ''}" required>
      <input type="file" name="soal[${index}][gambar_e]"><br>

      <label>Kunci Jawaban:</label>
      <select name="soal[${index}][jawaban_benar]" required>
        <option value="">--Pilih--</option>
        <option value="A" ${soal.jawaban_benar === 'A' ? 'selected' : ''}>A</option>
        <option value="B" ${soal.jawaban_benar === 'B' ? 'selected' : ''}>B</option>
        <option value="C" ${soal.jawaban_benar === 'C' ? 'selected' : ''}>C</option>
        <option value="D" ${soal.jawaban_benar === 'D' ? 'selected' : ''}>D</option>
        <option value="E" ${soal.jawaban_benar === 'E' ? 'selected' : ''}>E</option>
      </select><br>

      <button type="button" class="hapus-btn" onclick="hapusSoal(${index})">Hapus</button>
    `;

        container.appendChild(div);
      });
    }


  // Tambahkan satu soal saat halaman dibuka
  window.onload = () => {
    resetSoal();
  };
</script>

</body>
  </body>
</html>
