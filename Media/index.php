<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing page</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="siswa/css/page.css">
</head>
<body class="bg-white text-gray-800">


  <!-- Header -->
   <header class="header">
        <div class="container">
            <div class="logo">PROGRESO</div>
            <nav>
                <a href="daftar1.php">Daftar |</a>
                <a href="login-guru.php">Masuk sebagai Guru |</a>
                <a href="biodata.php">Profil</a>
            </nav>
        </div>
    </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-text">
        <h2>Belajar Logika Jadi Menyenangkan</h2>
        <p>Platform pembelajaran interaktif berbasis logika dan eksplorasi untuk siswa kreatif dan cerdas.</p>
        <a href="#login" class="btn-primary">Mulai Sekarang</a>
        <a href="TP.php" class="btn-primary">Tujuan Pembelajaran</a>
      </div>
      <div class="hero-image">
        <img src="siswa/assets/4.png" alt="Ilustrasi Belajar">
      </div>
    </div>
  </section>

  <!-- Login Form -->
  <section id="login" class="login-section">
    <div class="login-container">
      <h2>Masuk ke PROGRESO</h2>
      <form method="POST" action="proses-login.php">
        <label for="username">Nama Pengguna</label>
        <input type="text" id="username" name="username" placeholder="Nama pengguna" required>

        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>

        <div class="form-options">
          <label class="remember">
            <input type="checkbox"> Ingat saya
          </label>
          <a href="#" class="forgot">Lupa Kata Sandi?</a>
        </div>

        <button type="submit" class="btn-primary">Masuk</button>
      </form>
      <p class="signup-text">Belum punya akun? <a href="daftar1.php">Daftar</a></p>
    </div>
  </section>

  <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>© 2025 PROGRESO. Hak cipta dilindungi.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

  <!-- Font Awesome for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
</body>
</html>
