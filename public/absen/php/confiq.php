<?php 
$servername = "localhost"; // Ganti dengan nama server Anda
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$database = "absen";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn){
    die("Koneksi gagal ".mysqli_connect_error());
}




?>
