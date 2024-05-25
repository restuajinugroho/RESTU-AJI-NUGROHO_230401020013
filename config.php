<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stock";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}
   
?>