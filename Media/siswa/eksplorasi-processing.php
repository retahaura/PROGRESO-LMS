<?php
include '../dbconn/dbconn.php';
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php");
    exit();
}
$id_siswa = $_SESSION['id_user'];
$id_materi = $_GET['id_materi'];

//Ambil gambar dari DB
$sql = "SELECT * FROM drag_drop ORDER BY RAND()";
$result = $conn->query($sql);
$images = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      $images[] = $row;
  }
}



$sql = "SELECT * FROM pg_materi WHERE id_materi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_materi);
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
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Data Processing</title>
        <link rel="stylesheet" href="css/topside.css" />
        <link rel="stylesheet" href="css/eksplorasi-layout.css" />
        <link rel="stylesheet" href="css/eksplorasi-processing.css?v=<?= time(); ?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
 
    <body>
        <div class="layout-container">
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
                </div>

                <!-- Konten -->
                <!-- Problem Statement Page (php) -->
                <section class="explore-section">
                    <div class="explore-container">
                        <div class="section-title">
                        <h2>Tahap 4</h2>
                            <p>Analisis dan olah data hasil eksplorasi yang telah kamu temukan!</p>
                        </div>

                        <div class="progress-bar-container">
                            <div class="progress-text">Tahap 4 dari 6: Pengolahan Data (60%)</div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 60%;"></div>
                            </div>
                            
                            <div class="quiz-box">
                            <?php
                            // Materi otomatis berdasarkan id_materi
                            $deskripsi = "";
                            
                            if ($id_materi == 11) {
                                $deskripsi = "Susun perangkat pada urutan yang benar berdasarkan alur jaringan.";
                            }
                            
                            elseif ($id_materi == 14) {
                                $deskripsi = "Susunlah urutan generasi jaringan dari yang paling lambat > tercepat:";
                            }
                            
                            elseif ($id_materi == 15) {
                                $deskripsi = "Urutan proteksi data pribadi harus dilakukan dari dasar > perlindungan tambahan > perawatan keamanan.";
                            }
                            ?>
                            
                            <!-- BOX MATERI -->
                            <div class="case-box" style="margin-bottom:20px; padding:18px; background:#f1f9ff; border-left:5px solid #3b82f6; border-radius:12px;">
                                <p><strong>keterangan:</strong><br>
                                    <?= !empty($deskripsi) ? $deskripsi : "Materi belum tersedia untuk materi ini."; ?>
                                </p>
                            </div>

                            
                            
                            
                            
                                <div class="instruksi-box">
                                    <p>Susunlah urutan komponen dibawah ini dengan cara <strong>drag & drop</strong> gambar ke kotak yang tersedia di bawah sesuai urutan yang benar.</p>
                                </div>
                                <!-- Urutan Komponen Jaringan -->
                                <div class="drag-container">
                                    <input type="hidden" id="id_materi" value="<?php echo $id_materi; ?>">
                                    <input type="hidden" id="id_user" value="<?php echo $id_siswa; ?>">
                                    <div class="images">
                                        <!-- Gambar akan dimuat dari database -->
                                    </div>
                                    <div class="labels">
                                        <!-- Label akan dimuat dari database -->
                                    </div><br>
                                    <button onclick="submitAnswer()" class="btn-primary2">Submit Jawaban</button>
                                </div>
                            </div>
                            
                            <!-- FORM PG -->
                            <div class="question-card">
                                <div class="instruksi-box">
                                    <p>Bacalah soal berikut secara teliti, kemudian tentukan jawaban yang menurutmu benar.</p>
                                </div>
                                <form action="jawaban-pg.php" method="post">
                                    <input type="hidden" name="id_materi" value="<?php echo $id_materi; ?>">
    
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
                                                    $inputId = "q{$question['id']}{$opt}";
                                            ?>
                                                <label for="<?php echo $inputId; ?>">
                                                    <input type="radio" id="<?php echo $inputId; ?>" 
                                                            name="question[<?php echo $question['id']; ?>]" 
                                                            value="<?php echo strtoupper($opt); ?>">
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
                            </div>
                         
                    <?php if (isset($_GET['show'])): ?>
                    <div class="feedback-box" 
                        style="
                            margin-top:25px;
                            padding:20px;
                            border-radius:18px;
                            background:#e7f9ff;
                            border-left:6px solid #06b6d4;
                            box-shadow:0 4px 12px rgba(0,0,0,0.05);
                            animation: fadeIn 0.3s ease-out;
                        ">
                        
                    <?php
                        if ($id_materi == 11) {
                            echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                                    <strong style='color:#0284c7;'>Bagus! </strong><br>
                                    Penyusunan alurmu sudah benar. Pemahamanmu semakin kuat 💡
                                 </p>";
                        } elseif ($id_materi == 14) {
                            echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                                    <strong style='color:#0284c7;'></strong><br>
                                    Nicee! Kamu sudah bisa mengurutkan dan memilih koneksi paling pas. Tinggal sedikit lagi menuju kesimpulan!
                                 </p>";
                        } elseif ($id_materi == 15) {
                            echo "<p style='margin:0; font-size:15px; line-height:1.6; color:#0b3c49;'>
                                    <strong style='color:#0284c7;'></strong><br>
                                    Bagus! Kamu sudah menyusun langkah proteksi dengan benar ðŸ’¡
                                 </p>";
                        }
                    ?>
                    </div>
                
                    <style>
                        @keyframes fadeIn {
                            from { opacity:0; transform: translateY(10px); }
                            to { opacity:1; transform: translateY(0); }
                        }
                    </style>
                    <?php endif; ?>

                            <div class="submit">
                                <a href="eksplorasi-verification.php?id_materi=<?= $id_materi?>" class="btn-primary2">Lanjutkan</a>
                            </div>
                        </div>   
                    </div>
                </section>  
            </div>
        </div>    
        <script>
            // Contoh untuk halaman Problem Statement
            document.addEventListener("DOMContentLoaded", function () {
            // Ganti angka di sini sesuai tahapnya
            localStorage.setItem("discoveryProgress", "60");

            // Kalau ingin juga update progress bar lokal (di halaman ini)
            const progressFill = document.querySelector(".progress-fill");
            const progressText = document.querySelector(".progress-text");
            if (progressFill && progressText) {
            progressFill.style.width = "60%";
            progressText.innerText = "Tahap 4 dari 6: Pengolahan Data (60%)";
            }
            });
        </script>
        
        <!-- Script Drag n Drop -->
        <script>
            document.addEventListener('DOMContentLoaded', loadQuiz);

            // Memuat data dari server
            function loadQuiz() {
            const idMateri = document.getElementById("id_materi").value; // Ambil ID pembelajaran

            fetch(`get_quiz_data.php?id_materi=${idMateri}`)
                .then(response => response.json())
                .then(data => {
                    const imagesContainer = document.querySelector('.images');
                    const labelsContainer = document.querySelector('.labels');

                    // Bersihkan kontainer sebelumnya
                    imagesContainer.innerHTML = '';
                    labelsContainer.innerHTML = '';

                    // Tambahkan gambar dan label
                    data.forEach(item => {
                        // Tambahkan gambar
                        const imgDiv = document.createElement('div');
                        imgDiv.classList.add('imageItem');
                        imgDiv.setAttribute('draggable', 'true');
                        imgDiv.setAttribute('data-id', item.id);
                        imgDiv.innerHTML = `<img src="../guru/${item.gambar}" alt="Image" style="max-width: 100px;">`;
                        imagesContainer.appendChild(imgDiv);

                        // Tambahkan label
                        const labelDiv = document.createElement('div');
                        labelDiv.classList.add('labelItem');
                        labelDiv.setAttribute('data-label', item.label);
                        labelDiv.innerHTML = `<span>${item.label}</span>`;
                        labelsContainer.appendChild(labelDiv);
                    });

                    enableDragAndDrop();
                })
                .catch(error => console.error('Error fetching quiz data:', error));
            }

            // Mengaktifkan fungsi drag and drop
            function enableDragAndDrop() {
                const draggables = document.querySelectorAll('.imageItem');
                const droppables = document.querySelectorAll('.labelItem');

                // Tambahkan event listener untuk elemen draggable
                draggables.forEach(draggable => {
                    draggable.addEventListener('dragstart', () => {
                        draggable.classList.add('dragging');
                    });

                    draggable.addEventListener('dragend', () => {
                        draggable.classList.remove('dragging');
                    });
                });

                // Tambahkan event listener untuk elemen droppable
                droppables.forEach(droppable => {
                    droppable.addEventListener('dragover', e => {
                        e.preventDefault(); // Mengizinkan drop
                    });

                    droppable.addEventListener('drop', e => {
                        e.preventDefault();

                        const dragged = document.querySelector('.dragging');
                        if (dragged) {
                            // Cek jika label sudah memiliki gambar
                            if (!droppable.querySelector('.imageItem')) {
                                droppable.appendChild(dragged);
                            } else {
                                alert('Setiap label hanya dapat memiliki satu gambar.');
                            }
                        }
                    });
                });
            }

            // Mengirim jawaban ke server
            function submitAnswer() {
                const idMateri  = document.getElementById("id_materi").value; // ID kategori
                const answers = [];

                document.querySelectorAll('.labelItem').forEach(label => {
                    const image = label.querySelector('.imageItem');
                    if (image) {
                        answers.push({
                            id: image.dataset.id,
                            pilih_label: label.dataset.label
                        });
                    }
                });

                // Kirim data ke backend
                fetch('jawaban-dragdrop.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        id_materi: idMateri,
                        answers: answers
                    })
                })
                .then(res => res.text())
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        alert(`Skor Anda: ${data.score.toFixed(2)}\n${data.message}`);
                    } catch (err) {
                        console.error("Bukan JSON, isi respon:", text);
                        alert("Terjadi error di server, cek console!");
                    }
                })
                .catch(err => console.error('Fetch error:', err));
            }
        </script>
        <script src="js/script.js"></script>
    </body>
</html>
      

    