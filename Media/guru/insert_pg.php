<?php
include '../dbconn/dbconn.php';
session_start();

// pastikan hanya guru yang bisa akses
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'guru') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_materi = $_POST['id_materi'];
    $soalList = $_POST['soal'];

    // fungsi upload file khusus untuk struktur nested $_FILES
    function uploadFile($field, $index, $subfield) {
        if (isset($_FILES[$field]['name'][$index][$subfield]) && 
            $_FILES[$field]['error'][$index][$subfield] === 0) {
            
            $tmp  = $_FILES[$field]['tmp_name'][$index][$subfield];
            $name = uniqid() . '_' . basename($_FILES[$field]['name'][$index][$subfield]);
            $target = '../uploads/' . $name;

            if (move_uploaded_file($tmp, $target)) {
                return $name;
            }
        }
        return null;
    }

    foreach ($soalList as $index => $soal) {
        $pertanyaan = mysqli_real_escape_string($conn, $soal['pertanyaan']);
        $opsi_a = mysqli_real_escape_string($conn, $soal['jawaban_a']);
        $opsi_b = mysqli_real_escape_string($conn, $soal['jawaban_b']);
        $opsi_c = mysqli_real_escape_string($conn, $soal['jawaban_c']);
        $opsi_d = mysqli_real_escape_string($conn, $soal['jawaban_d']);
        $opsi_e = mysqli_real_escape_string($conn, $soal['jawaban_e']);
        $kunci  = mysqli_real_escape_string($conn, $soal['jawaban_benar']);

        // upload semua gambar sesuai index
        $gambar_pertanyaan = uploadFile('soal', $index, 'gambar_pertanyaan');
        $gambar_a = uploadFile('soal', $index, 'gambar_a');
        $gambar_b = uploadFile('soal', $index, 'gambar_b');
        $gambar_c = uploadFile('soal', $index, 'gambar_c');
        $gambar_d = uploadFile('soal', $index, 'gambar_d');
        $gambar_e = uploadFile('soal', $index, 'gambar_e');

        $sql = "INSERT INTO pg_materi (
                    id_materi, pertanyaan, gambar_pertanyaan,
                    jawaban_a, gambar_a, jawaban_b, gambar_b,
                    jawaban_c, gambar_c, jawaban_d, gambar_d,
                    jawaban_e, gambar_e, jawaban_benar
                ) VALUES (
                    '$id_materi', '$pertanyaan', '$gambar_pertanyaan',
                    '$opsi_a', '$gambar_a', '$opsi_b', '$gambar_b',
                    '$opsi_c', '$gambar_c', '$opsi_d', '$gambar_d',
                    '$opsi_e', '$gambar_e', '$kunci'
                )";

        mysqli_query($conn, $sql);
    }

    echo "<script>
        alert('Semua soal berhasil disimpan!');
        window.location.href='tahap4a.php?materi=$id_materi';
    </script>";
}
?>
