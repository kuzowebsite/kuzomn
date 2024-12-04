<?php
// Өгөгдлийн сангийн холболт
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "anime_db"; // Энэ нь таны өгөгдлийн сангийн нэр байна

// Холболтыг шалгах
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Холболт амжилтгүй: " . $conn->connect_error);
}
?>
