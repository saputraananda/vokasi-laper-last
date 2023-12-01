<?php
// Buat koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vokasilaper";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data lokasi dari tabel 'lokasi'
$sql = "SELECT * FROM lokasi";
$result = $conn->query($sql);

$locations = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($locations);

$conn->close();
?>
