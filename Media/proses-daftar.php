<?php
include 'dbconn/dbconn.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'siswa';

    $sql = "INSERT INTO users (nama, username, password, role) VALUES('$nama', '$username', '$password', '$role')";

    if($conn->query($sql) === TRUE) {
        echo "Akun berhasil dibuat!";
        echo "<script>location='index.php'</script>";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

