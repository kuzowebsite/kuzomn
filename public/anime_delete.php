<?php
include 'db.php';

// Аниме устгах
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM anime WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Аниме амжилттай устгагдлаа!";
        // Устгасны дараа админ хуудас руу буцах
        header("Location: admin.php");
        exit();
    } else {
        echo "Алдаа гарлаа: " . $conn->error;
    }
}
?>
