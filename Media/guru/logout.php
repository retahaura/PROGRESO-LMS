<?php
session_start();
unset($_SESSION['id_user']);
echo "<script>window.location='../index.php';</script>";
?>