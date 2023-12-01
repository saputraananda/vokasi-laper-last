<?php
$servername = "localhost";  // Ganti dengan nama host server Anda
$username = "root";     // Ganti dengan nama pengguna database Anda
$password = "";     // Ganti dengan kata sandi database Anda
$dbname = "vokasilaper";  // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Set karakter set ke UTF-8 (opsional)
$conn->set_charset("utf8");

// File ini dapat di-include di file lain yang memerlukan koneksi ke database
?>
