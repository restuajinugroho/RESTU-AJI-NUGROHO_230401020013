<?php
include 'config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];

    $sqli = "INSERT INTO users (jenis, jumlah, satuan) VALUES ('$name', '$jumlah', '$satuan')";
    if ($conn->query($sqli) === TRUE) {
        $_SESSION['sukses'] = "Berhasil memasukkan data baru";
    } else {
        $_SESSION['error'] = "Gagal memasukkan data";
    }
    header("Location: index.php");
    exit;
}
?>