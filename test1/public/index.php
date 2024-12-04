<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Хэрэв хэрэглэгч нэвтрээгүй бол login.php руу шилжүүлэх
    header("Location: login.php");
    exit;
}
?>


<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Streaming</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Header with KuZo Logo -->
    <header>
    <button class="menu-toggle" id="menuToggle">☰</button>
    <div class="logo">KuZo</div>
</header>

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

    <!-- Гол агуулга -->
    <div class="main-content">
        <h1>Trending Anime</h1>
        <div class="search-container">
            <input type="text" id="searchBox" placeholder="Search Anime...">
        </div>
        <div class="anime-grid" id="animeList">
            <?php
            $result = $conn->query("SELECT * FROM anime");
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='anime-card' data-title='{$row['title']}'>
                    <a href='view.php?id={$row['id']}'>
                        <img src='images/{$row['image_url']}' alt='{$row['title']}'>
                    </a>
                    <h3>{$row['title']}</h3>
                    <p>Rating: {$row['rating']}</p>
                    <p>{$row['description']}</p>
                </div>
                ";
            }
            ?>
        </div>
    </div>

    <div class="theme-toggle">
        <button id="toggleTheme">🌞 / 🌙</button>
    </div>

    <footer>
        <p>2024 © KuZo Аниме Вэбсайт</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
