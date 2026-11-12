<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}
$id_guru = $_SESSION['id_user'];
$id_materi = $_GET['id_materi'];
$id_user = $_GET['id_user'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin-eksplorasi</title>
    <link rel="stylesheet" href="css/admin-eksplorasi.css?v=<?= time()?>" />
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
          <!--    <div class="search-box">-->
          <!--    <i class="fas fa-search"></i>-->
          <!--    <input type="text" placeholder="Cari modul atau topik...">-->
          <!--    </div>-->
          <!--    <div class="topbar-icons">-->
          <!--      <i class="fas fa-bell"></i>-->
          <!--    </div>-->
          <!--</div>-->
        </div>
        
        <!-- Main Content -->
        <!-- Main Content -->
        <section class="eksplorasi-siswa-section">
        <div class="eksplorasi-container">
          <!-- Tahap 1 -->
          <div class="jawaban-card">
            <h3>Tahap 1 – Visual & 2 Esai</h3>
            <?php
               $data = mysqli_query($conn, "SELECT * FROM jawaban_stimulan WHERE id_user = $id_user AND id_materi = $id_materi");
              if (mysqli_num_rows($data) > 0):
                $no = 1;
                while($row = mysqli_fetch_array($data)):
                  ?>
            <p> <strong>Jawaban Esai <?= $row['id_soal'] ?>:</strong> <?= $row['jawaban'] ?>
                <button class="btn-detail" onclick="bukaModal('modalEsai1<?= $row['id_soal'] ?>')">Lihat Detail</button>
              </p>
              <div id="modalEsai1<?= $row['id_soal'] ?>" class="modal">
              <div class="modal-content">
                <span class="close" onclick="tutupModal('modalEsai1<?= $row['id_soal'] ?>')">&times;</span>
                <h4>Jawaban Lengkap Esai <?= $row['id_soal'] ?></h4>
                <p><?= nl2br(htmlspecialchars($row['jawaban'])) ?></p>
              </div>
            </div>
            <?php
                  endwhile;
                else:
              ?>
                <tr>
                  <td colspan="5" style="text-align:center;">Belum ada data Jawaban.</td>
                </tr>
              <?php endif; ?>

            <div class="nilai">
              <label>Nilai Manual Guru:</label>
              <input type="number" max="100" id="tahap1" min="0" oninput="hitungTotal()"/>
            </div>
          </div>

          <!-- Tahap 2 -->
          <div class="jawaban-card">
            <h3>Tahap 2 – Studi Kasus (4 Esai)</h3>
            <?php
               $data = mysqli_query($conn, "SELECT * FROM jawaban_problem WHERE id_user = $id_user AND id_materi = $id_materi");
              if (mysqli_num_rows($data) > 0):
                $no = 1;
                while($row = mysqli_fetch_array($data)):
                  ?>
            <p> <strong>Jawaban Esai <?= $row['id_soal'] ?>:</strong> <?= $row['jawaban'] ?>
                <button class="btn-detail" onclick="bukaModal('modalEsai2<?= $row['id_soal'] ?>')">Lihat Detail</button>
              </p>
               <div id="modalEsai2<?= $row['id_soal'] ?>" class="modal">
              <div class="modal-content">
                <span class="close" onclick="tutupModal('modalEsai2<?= $row['id_soal'] ?>')">&times;</span>
                <h4>Jawaban Lengkap Esai <?= $row['id_soal'] ?></h4>
                <p><?= nl2br(htmlspecialchars($row['jawaban'])) ?></p>
              </div>
            </div>
            <?php
                  endwhile;
                else:
              ?>
                <tr>
                  <td colspan="5" style="text-align:center;">Belum ada data Jawaban.</td>
                </tr>
              <?php endif; ?>
            <div class="nilai">
              <label>Nilai Manual Guru:</label>
               <input type="number" max="100" id="tahap2" min="0" oninput="hitungTotal()"/>
            </div>
          </div>

          <!-- Tahap 3 -->
          <div class="jawaban-card">
            <h3>Tahap 3 – Observasi 3D (2 Esai)</h3>
            <?php
               $data = mysqli_query($conn, "SELECT * FROM jawaban_data WHERE id_user = $id_user AND id_materi = $id_materi");
              if (mysqli_num_rows($data) > 0):
                $no = 1;
                while($row = mysqli_fetch_array($data)):
                  ?>
            <p><strong>Jawaban Esai <?= $row['id_soal']?>:</strong><?= $row['jawaban']?></p>
           <?php
                  endwhile;
                else:
              ?>
                <tr>
                  <td colspan="5" style="text-align:center;">Belum ada data Jawaban.</td>
                </tr>
              <?php endif; ?>
            <div class="nilai">
              <label>Nilai Manual Guru:</label>
               <input type="number" max="100" id="tahap3" min="0" oninput="hitungTotal()"/>
            </div>
          </div>

          <!-- Tahap 4 -->
          <div class="jawaban-card">
            <h3>Tahap 4 – Drag & Drop + 3 PG</h3>
            <?php
               $data = mysqli_query($conn, "SELECT MAX(p.skor) AS skor_pg, MAX(d.skor) AS skor_dd
              FROM jawaban_pg p
              JOIN skor_dragdrop d ON p.id_siswa = d.id_siswa AND p.id_materi = d.id_materi
              WHERE p.id_siswa = $id_user AND p.id_materi = $id_materi");
              if ($row = mysqli_fetch_assoc($data)) {
                $tahap4_skor = ($row['skor_pg'] + $row['skor_dd'])/2;
              ?>
            <div class="nilai">
              <p>Nilai PG Otomatis: <strong><?= $row['skor_pg']?></strong></p>
              <p>Nilai Drag & Drop Otomatis: <strong><?= $row['skor_dd']?></strong></p>
              <!-- Nilai tahap 4 (readonly) -->
              <input type="number" id="tahap4" value="<?= $tahap4_skor ?>" readonly />
            </div>
             <?php
            } else {
            ?>
              <p style="text-align:center;">Belum ada data Jawaban.</p>
            <?php
            } ?>
          </div>

          <!-- Tahap 5 -->
          <div class="jawaban-card">
            <h3>Tahap 5 – Esai HOTS</h3>
            <?php
               $data = mysqli_query($conn, "SELECT * FROM jawaban_verification WHERE id_user = $id_user AND id_materi = $id_materi");
              if (mysqli_num_rows($data) > 0):
                $no = 1;
                while($row = mysqli_fetch_array($data)):
                  ?>
            <p> <strong>Jawaban Esai <?= $row['id_soal'] ?>:</strong> <?= $row['jawaban'] ?>
                <button class="btn-detail" onclick="bukaModal('modalEsai5<?= $row['id_soal'] ?>')">Lihat Detail</button>
              </p>
               <div id="modalEsai5<?= $row['id_soal'] ?>" class="modal">
              <div class="modal-content">
                <span class="close" onclick="tutupModal('modalEsai5<?= $row['id_soal'] ?>')">&times;</span>
                <h4>Jawaban Lengkap Esai <?= $row['id_soal'] ?></h4>
                <p><?= nl2br(htmlspecialchars($row['jawaban'])) ?></p>
              </div>
            </div>
            <?php
                  endwhile;
                else:
              ?>
                <tr>
                  <td colspan="5" style="text-align:center;">Belum ada data Jawaban.</td>
                </tr>
              <?php endif; ?>
            <div class="nilai">
              <label>Nilai Manual Guru:</label>
               <input type="number" max="100" id="tahap5" min="0" oninput="hitungTotal()"/>
            </div>
          </div>

          <!-- Tahap 6 -->
          <div class="jawaban-card">
            <h3>Tahap 6 – Refleksi (3 Esai)</h3>
            <?php
               $data = mysqli_query($conn, "SELECT * FROM jawaban_generalization WHERE id_user = $id_user AND id_materi = $id_materi");
              if (mysqli_num_rows($data) > 0):
                $no = 1;
                while($row = mysqli_fetch_array($data)):
                  ?>
            <p><strong>Refleksi <?= $row['id_soal']?>:</strong><?= $row['jawaban']?>
              <button class="btn-detail" onclick="bukaModal('modalEsai6<?= $row['id_soal']?>')">Lihat Detail</button>
            </p>
            <div id="modalEsai6<?= $row['id_soal'] ?>" class="modal">
              <div class="modal-content">
                <span class="close" onclick="tutupModal('modalEsai6<?= $row['id_soal'] ?>')">&times;</span>
                <h4>Jawaban Lengkap Esai <?= $row['id_soal'] ?></h4>
                <p><?= nl2br(htmlspecialchars($row['jawaban'])) ?></p>
              </div>
            </div>
          <?php
                  endwhile;
                else:
              ?>
                <tr>
                  <td colspan="5" style="text-align:center;">Belum ada data Jawaban.</td>
                </tr>
              <?php endif; ?>
            <div class="nilai">
              <label>Nilai Manual Guru:</label>
               <input type="number" max="100" id="tahap6" min="0" oninput="hitungTotal()"/>
            </div>
          </div>

          <!-- REKAP NILAI -->
          <div class="rekap-total">
            <h3>Rekap Nilai Siswa</h3>
            <button onclick="hitungTotal()">Hitung Total & Rata-rata</button>
            <p><strong>Total:</strong> <span id="totalSkor">-</span> / 600</p>
            <p><strong>Rata-rata:</strong> <span id="rataSkor">-</span></p>
            <button onclick="simpanNilai()">Simpan Nilai</button>
          </div>
        </div>
        <div class="submit">
          <a href="admin_rekap.php?id_materi=<?php echo $id_materi?>" class="btn-primary">Kembali</a>
        </div>

      </section>

      <!-- ===================== MODAL TEMPLATE =====================
      <div id="modalEsai1" class="modal"><div class="modal-content"><span class="close" onclick="tutupModal('modalEsai1')">&times;</span><h3>Detail Esai 1 – Tahap 1</h3><p>Topologi bus digunakan karena biaya murah dan instalasi sederhana.</p></div></div>
      <div id="modalEsai2" class="modal"><div class="modal-content"><span class="close" onclick="tutupModal('modalEsai2')">&times;</span><h3>Detail Esai 2 – Tahap 1</h3><p>Cocok untuk jaringan skala kecil seperti rumah atau kantor.</p></div></div>
       Lanjutkan modal lainnya sesuai nomor soal esai... -->
       <!-- Modal -->
      


      <!-- ===================== SCRIPT ===================== -->
      <script>
      function bukaModal(id) {
        document.getElementById(id).style.display = 'block';
      }

      function tutupModal(id) {
        document.getElementById(id).style.display = 'none';
      }

      // Tutup jika klik di luar konten
      window.onclick = function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(function(modal) {
          if (event.target === modal) {
            modal.style.display = "none";
          }
        });
      };

     function hitungTotal() {
      let total = 0, count = 0;

      for (let i = 1; i <= 6; i++) {
        let el = document.getElementById('tahap' + i);
        if (el && el.value !== '') {
          let val = parseFloat(el.value);
          if (!isNaN(val)) {
            total += val;
            count++;
          }
        }
      }

      let rata = count > 0 ? (total / count).toFixed(2) : 0;

      document.getElementById('totalSkor').innerText = total;
      document.getElementById('rataSkor').innerText = rata;

      return { total, rata };
    }

    function simpanNilai() {
      const skor = hitungTotal();

      const formData = new FormData();
      formData.append('id_user', <?= $id_user ?>);
      formData.append('id_materi', <?= $id_materi ?>);

      for (let i = 1; i <= 6; i++) {
        formData.append('tahap' + i, document.getElementById('tahap' + i).value || 0);
      }

      formData.append('total', skor.total);
      formData.append('rata', skor.rata);

      fetch('simpan_nilai.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.text())
      .then(data => alert(data))
      .catch(err => alert('Gagal simpan nilai: ' + err));
    }
      </script>


      </div>
    </div>
    

    
    <script src="js/script.js"></script>
  </body>
</html>
