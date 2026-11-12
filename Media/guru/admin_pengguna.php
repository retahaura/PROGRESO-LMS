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
    <title>Admin-pengguna</title>
    <link rel="stylesheet" href="css/admin-pengguna.css" />
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
        <div class="judul-section-besar">
          <h1>Data Pengguna</h1>
        </div>
          
        <!-- Tombol Tambah -->
        <div class="actions">
          <button id="btnTambah">+ Tambah Pengguna</button>
        </div>

        <!-- Tabel Pengguna -->
        <section class="user-table">
            <table>
            <thead>
                <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    $no = 1;
                    $data = mysqli_query($conn, "SELECT * from users");
                    while($row = mysqli_fetch_array($data)){
                    ?>
            
                <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['role'] ?></td>
                <td>
                <button class="edit-btn" data-id="<?= $row['id_user'] ?>" data-nama="<?= $row['nama'] ?>" data-username="<?= $row['username'] ?>" data-role="<?= $row['role'] ?>">Edit</button>
                <button class="delete-btn" data-id="<?= $row['id_user'] ?>">Hapus</button>
              </td>
                </tr>
                <!-- Tambah data dinamis lainnya -->
                 <?php
                    }
                ?>
            </tbody>
            </table>
        </section>

        <!-- Modal Tambah data dinamis lainnya -->
        <div class="modal" id="modalForm">
        <div class="modal-content">
          <h2 id="modalTitle">Tambah Pengguna</h2>
          <form id="formPengguna">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>

            <label>Nama pengguna</label>
            <input type="text" name="username" required>

            <label>Kata Sandi</label>
            <input type="password" name="password" required>

            <label>kategori</label>
            <select name="role" required>
              <option value="">--Pilih Kategori--</option>
              <option value="siswa">Siswa</option>
              <option value="guru">Guru</option>
            </select>

            <div class="modal-actions">
              <button type="submit"class="btn-simpan">Simpan</button>
              <button type="button" id="btnClose" class="btn-batal">Batal</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Modal EDit Data -->
       <div class="modal" id="editModal">
      <div class="modal-content">
        <h2>Edit Data Siswa</h2>
        <form id="formEditSiswa">
          <input type="hidden" name="id_user" id="editId">

          <label>Nama Lengkap</label>
          <input type="text" name="nama" id="editNama" required>

          <label>Nama Pengguna</label>
          <input type="text" name="username" id="editUsername" required>

          <label>Kategori</label>
          <select name="role" id="editRole" required>
            <option value="siswa">Siswa</option>
            <option value="guru">Guru</option>
          </select>

          <div class="modal-actions">
            <button type="submit"class="btn-simpan">Simpan Perubahan</button>
            <button type="button" id="btnEditClose" class="btn-batal">Batal</button>
          </div>
        </form>
      </div>
      </div>


      </div>
    </div>
    
    <script src="js/script.js"></script>
    <script>
  document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("modalForm");
  const btnOpen = document.getElementById("btnTambah");
  const btnClose = document.getElementById("btnClose");
  const form = document.getElementById("formPengguna");

  // Buka modal
  btnOpen.addEventListener("click", function () {
    modal.style.display = "block";
  });

  // Tutup modal
  btnClose.addEventListener("click", function () {
    modal.style.display = "none";
  });

  // Klik di luar modal => tutup
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };

  // Submit form via AJAX
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch("insert-user.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.text())
    .then(response => {
      console.log("Response:", response);
      if (response.trim() === "success") {
        alert("✅ Pengguna berhasil ditambahkan!");
        form.reset();
        modal.style.display = "none";
        // TODO: Reload tabel data pengguna jika ada
      } else {
        alert("❌ Gagal: " + response);
      }
    })
    .catch(err => {
      alert("❌ Gagal mengirim data ke server.");
      console.error(err);
    });
  });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const editModal = document.getElementById("editModal");
  const form = document.getElementById("formEditSiswa");

  // Klik tombol Edit → buka modal dan isi data
  document.querySelectorAll(".edit-btn").forEach(button => {
    button.addEventListener("click", function () {
      document.getElementById("editId").value = this.dataset.id;
      document.getElementById("editNama").value = this.dataset.nama;
      document.getElementById("editUsername").value = this.dataset.username;
      document.getElementById("editRole").value = this.dataset.role;

      editModal.style.display = "block";
    });
  });

  // Tutup modal
  document.getElementById("btnEditClose").addEventListener("click", () => {
    editModal.style.display = "none";
  });

  // Klik di luar modal → tutup
  window.onclick = function (e) {
    if (e.target === editModal) {
      editModal.style.display = "none";
    }
  };

  // Submit form (update data ke PHP)
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch("update_user.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.text())
    .then(response => {
      if (response.trim() === "success") {
        alert("✅ Data berhasil diperbarui!");
        editModal.style.display = "none";
        location.reload(); // reload tabel
      } else {
        alert("❌ Gagal: " + response);
      }
    });
  });
});
</script>


  </body>
</html>

