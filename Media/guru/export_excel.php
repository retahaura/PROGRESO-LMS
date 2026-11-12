<?php
ob_start(); // Mulai output buffering
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include "../dbconn/dbconn.php";

// Buat spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set judul sheet
$sheet->setTitle("Export Data");

// Header untuk tabel "users"
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Nama Kategori');
$sheet->setCellValue('D1', 'Soal');
$sheet->setCellValue('E1', 'Jawaban Siswa');
$sheet->setCellValue('F1', 'Jawaban Benar');
$sheet->setCellValue('G1', 'Keterangan');

// Pastikan database menggunakan UTF-8
$conn->set_charset("utf8mb4");

// Ambil data dari tabel "users"
$query1 = "SELECT d.id_detail, u.nama, k.kategori, t.pertanyaan, d.jawaban_siswa, d.jawaban_benar, d.keterangan
            FROM hasil_tes_detail d LEFT JOIN users u ON d.id_siswa = u.id_siswa
            LEFT JOIN kategori k ON d.id_kategori = k.id_kategori
            LEFT JOIN tes t ON d.id_tes = t.id_tes";
$result1 = $conn->query($query1);

// Tulis data ke spreadsheet
$rowNumber = 2; // Mulai dari baris kedua
while ($row = $result1->fetch_assoc()) { 
    $sheet->setCellValue('A' . $rowNumber, $row['id_detail']);
    $sheet->setCellValue('B' . $rowNumber, utf8_encode($row['nama']));
    $sheet->setCellValue('C' . $rowNumber, utf8_encode($row['kategori']));
    $sheet->setCellValue('D' . $rowNumber, utf8_encode($row['pertanyaan']));
    $sheet->setCellValue('E' . $rowNumber, utf8_encode($row['jawaban_siswa']));
    $sheet->setCellValue('F' . $rowNumber, utf8_encode($row['jawaban_benar']));
    $sheet->setCellValue('G' . $rowNumber, utf8_encode($row['keterangan']));
    $rowNumber++;
}


// Set header HTTP untuk mengunduh file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="export_data.xlsx"');
header('Cache-Control: max-age=0');

// Tulis file Excel ke output
$writer = new Xlsx($spreadsheet);

// Bersihkan buffer sebelum menulis file
ob_end_clean(); 
$writer->save('php://output');

// Tutup koneksi database
$conn->close();
exit; // Hentikan eksekusi

?>