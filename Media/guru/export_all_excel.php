<?php
require '../vendor/autoload.php';
include '../dbconn/dbconn.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// === BUAT FILE EXCEL === //
$spreadsheet = new Spreadsheet();

// =============================
// === SHEET 1: REKAP HASIL ===
// =============================
$sheet1 = $spreadsheet->getActiveSheet();
$sheet1->setTitle('Rekap Hasil Tes');

// Header Sheet 1
$sheet1->setCellValue('A1', 'No');
$sheet1->setCellValue('B1', 'Nama Siswa');
$sheet1->setCellValue('C1', 'Kategori');
$sheet1->setCellValue('D1', 'Skor');
$sheet1->setCellValue('E1', 'ID Hasil');

// Query Rekap
$query = "
    SELECT 
        u.nama,
        h.skor,
        h.id_kategori,
        h.id_hasil,
        k.kategori
    FROM users u
    LEFT JOIN hasil_tes h ON u.id_user = h.id_siswa
    LEFT JOIN kategori_tes k ON h.id_kategori = k.id
    WHERE u.role = 'siswa'
    ORDER BY u.nama
";

$result = mysqli_query($conn, $query);

$rowExcel = 2;
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
    $sheet1->setCellValue("A$rowExcel", $no++);
    $sheet1->setCellValue("B$rowExcel", $row['nama']);
    $sheet1->setCellValue("C$rowExcel", $row['kategori'] ?? '-');
    $sheet1->setCellValue("D$rowExcel", $row['skor'] ?? 'Belum Mengerjakan');
    $sheet1->setCellValue("E$rowExcel", $row['id_hasil']);

    $rowExcel++;
}


// ====================================
// === SHEET 2: DETAIL SEMUA HASIL ===
// ====================================
$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Detail Jawaban');

// Header Sheet 2
$sheet2->setCellValue('A1', 'ID Hasil');
$sheet2->setCellValue('B1', 'Nama Siswa');
$sheet2->setCellValue('C1', 'Kategori');
$sheet2->setCellValue('D1', 'Pertanyaan');
$sheet2->setCellValue('E1', 'Jawaban Siswa');
$sheet2->setCellValue('F1', 'Jawaban Benar');
$sheet2->setCellValue('G1', 'Keterangan');

// Query detail semua hasil
$queryDetail = "
    SELECT 
        h.id_hasil,
        u.nama,
        k.kategori,
        t.pertanyaan,
        d.jawaban_siswa,
        d.jawaban_benar,
        d.keterangan
    FROM hasil_tes_detail d
    LEFT JOIN hasil_tes h ON d.id_hasil = h.id_hasil
    LEFT JOIN users u ON h.id_siswa = u.id_user
    LEFT JOIN kategori_tes k ON h.id_kategori = k.id
    LEFT JOIN tes t ON d.id_tes = t.id_tes
    ORDER BY h.id_hasil, d.id_detail
";

$detailResult = mysqli_query($conn, $queryDetail);

$rowDetail = 2;

while ($row = mysqli_fetch_assoc($detailResult)) {
    $sheet2->setCellValue("A$rowDetail", $row['id_hasil']);
    $sheet2->setCellValue("B$rowDetail", $row['nama']);
    $sheet2->setCellValue("C$rowDetail", $row['kategori']);
    $sheet2->setCellValue("D$rowDetail", $row['pertanyaan']);
    $sheet2->setCellValue("E$rowDetail", $row['jawaban_siswa']);
    $sheet2->setCellValue("F$rowDetail", $row['jawaban_benar']);
    $sheet2->setCellValue("G$rowDetail", $row['keterangan']);

    $rowDetail++;
}


// ===========================
// === EXPORT EXCEL FILE ===
// ===========================

$filename = "rekap_nilai_pretest_posttest.xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
?>
