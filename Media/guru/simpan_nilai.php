<?php
include '../dbconn/dbconn.php';

$id_user   = $_POST['id_user'];
$id_materi = $_POST['id_materi'];

$t1 = $_POST['tahap1'];
$t2 = $_POST['tahap2'];
$t3 = $_POST['tahap3'];
$t4 = $_POST['tahap4'];
$t5 = $_POST['tahap5'];
$t6 = $_POST['tahap6'];
$total = $_POST['total'];
$rata  = $_POST['rata'];

// Cek apakah sudah ada data
$cek = mysqli_query($conn, "SELECT * FROM nilai_akhir WHERE id_user=$id_user AND id_materi=$id_materi");

if (mysqli_num_rows($cek) > 0) {
    // update
    $query = "UPDATE nilai_akhir SET 
              tahap1=$t1, tahap2=$t2, tahap3=$t3, tahap4=$t4, tahap5=$t5, tahap6=$t6, 
              total=$total, rata_rata=$rata 
              WHERE id_user=$id_user AND id_materi=$id_materi";
} else {
    // insert
    $query = "INSERT INTO nilai_akhir 
              (id_user, id_materi, tahap1, tahap2, tahap3, tahap4, tahap5, tahap6, total, rata_rata) 
              VALUES ($id_user, $id_materi, $t1, $t2, $t3, $t4, $t5, $t6, $total, $rata)";
}

if (mysqli_query($conn, $query)) {
    echo "✅ Nilai berhasil disimpan.";
} else {
    echo "❌ Gagal menyimpan nilai: " . mysqli_error($conn);
}
?>
