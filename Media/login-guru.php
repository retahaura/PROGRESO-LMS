<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Sebagai Guru - PROGRESO</title>
    <link rel="stylesheet" href="siswa/css/daftar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo">PROGRESO</div>
            <nav>
                <a href="index.php">Keluar</a>
            </nav>
        </div>
    </header>

    <!-- Form -->
    <main class="form-section">
        <div class="form-container">
            <h2>Masuk Sebagai Guru</h2>
            <form action="proses-guru.php" method="post">
                 <label for="username">Nama Pengguna</label>
                <input type="text" id="username" name="username" placeholder="Nama pengguna" required>

                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Minimal 3 karakter" required>

                <button type="submit">Masuk</button>
            </form>

            <p class="login-link">Sudah punya akun? <a href="index.php">Masuk di sini</a></p>
        </div>
    </main>

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

</body>
</html>
