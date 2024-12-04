<?php
include 'db.php';

// Анимэний ID-г URL-аас авах
$anime_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Анимэний мэдээллийг авах
$query = "SELECT * FROM anime WHERE id = $anime_id";
$result = $conn->query($query);
$anime = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $anime['title']; ?> - Anime Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Тэмдэглэл хийх товч -->
<button class="menu-toggle" id="menuToggle">☰</button>

<!-- Зүүн талын sidebar -->
<div class="sidebar" id="sidebar">
    <button class="close-btn" id="closeBtn">×</button>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Movies</a></li>
        <li><a href="#">Anime</a></li>
        <li><a href="#">Manga</a></li>
        <li><a href="#">Settings</a></li>
    </ul>
</div>


    <div class="anime-details">
        <h1><?php echo $anime['title']; ?></h1>

        <!-- Видео хэсэг -->
        <div class="anime-video">
            <video width="100%" controls>
                <source src="videos/<?php echo $anime['video_url']; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <!-- Рейтинг -->
        <div class="anime-rating">
            <h3>Rating: <?php echo $anime['rating']; ?></h3>
        </div>

        <!-- Тайлбар -->
        <div class="anime-description">
            <p><?php echo $anime['description']; ?></p>
        </div>
    </div>
    <script src="/main.js"></script>
</body>
</html>
