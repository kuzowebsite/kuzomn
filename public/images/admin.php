<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Шалгах: POST өгөгдөл болон файлууд орж ирсэн үү
    if (isset($_POST['title'], $_POST['description'], $_POST['rating'], $_FILES['image'], $_FILES['video'])) {
        // Формын өгөгдлийг авах
        $title = $_POST['title'];
        $description = $_POST['description'];
        $rating = $_POST['rating'];

        // Зургийн файл болон нэрийг шалгах
        $image = str_replace("'", "", $_FILES['image']['name']);  // ' тэмдэгтийг устгах
        $target_dir_image = "images/";  // Зургийг хадгалах хавтас
        $target_file_image = $target_dir_image . basename($image);  // Зургийн бүрэн зам

        // Видео файл шалгах
        $video = str_replace("'", "", $_FILES['video']['name']);  // ' тэмдэгтийг устгах
        $target_dir_video = "videos/";  // Видеог хадгалах хавтас
        $target_file_video = $target_dir_video . basename($video);  // Видеоны бүрэн зам

        // Зургийн өргөтгөл шалгах
        $imageFileType = strtolower(pathinfo($target_file_image, PATHINFO_EXTENSION));
        $allowedImageTypes = ['jpg', 'jpeg', 'png', 'gif'];  // Зөвшөөрөгдсөн зураг төрлүүд

        // Видеоны өргөтгөл шалгах
        $videoFileType = strtolower(pathinfo($target_file_video, PATHINFO_EXTENSION));
        $allowedVideoTypes = ['mp4', 'avi', 'mov', 'mkv'];  // Зөвшөөрөгдсөн видео төрлүүд

        // Өргөтгөл зөвшөөрөгдсөн эсэхийг шалгах
        if (in_array($imageFileType, $allowedImageTypes) && in_array($videoFileType, $allowedVideoTypes)) {
            // Зургийг хөдөлгөх
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file_image)) {
                // Видеог хөдөлгөх
                if (move_uploaded_file($_FILES['video']['tmp_name'], $target_file_video)) {
                    // Өгөгдлийг SQL руу оруулах
                    $sql = "INSERT INTO anime (title, description, rating, image_url, video_url) VALUES ('$title', '$description', '$rating', '$image', '$video')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Anime амжилттай нэмэгдлээ!";
                    } else {
                        echo "Алдаа гарлаа: " . $conn->error;
                    }
                } else {
                    echo "Видеог оруулахад алдаа гарлаа.";
                }
            } else {
                echo "Зургийг оруулахад алдаа гарлаа.";
            }
        } else {
            echo "Зураг болон видеоны өргөтгөл зөвшөөрөгдсөнгүй. (Зураг: jpg, jpeg, png, gif; Видео: mp4, avi, mov, mkv)";
        }
    } else {
        echo "Өгөгдөл илгээгдээгүй байна.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Anime Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Anime нэмэх</h2>
    <form action="admin.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="rating">Rating:</label>
        <input type="number" step="0.1" name="rating" required><br>

        <label for="image">Зураг:</label>
        <input type="file" name="image" accept="image/*" required><br>

        <label for="video">Видео:</label>
        <input type="file" name="video" accept="video/mp4, video/avi, video/mov, video/mkv" required><br>

        <button type="submit">Нэмэх</button>
    </form>

    <p>Админ нэвтрэх бол <a href="adminview.php">Энд дарна уу</a></p> 
    <p><a href="animeedit.php">Аниме засах</a></p>
</body>
</html>
