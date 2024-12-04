<?php
include 'db.php';

// Хайлтын өгөгдөл
$searchQuery = "";
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
}

// Аниме-ийн жагсаалтыг гаргах
$sql = "SELECT * FROM anime WHERE title LIKE '%$searchQuery%'";
$result = $conn->query($sql);

// Аниме устгах
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $conn->query("DELETE FROM anime WHERE id = '$deleteId'");
    header("Location: animeedit.php"); // Устгасны дараа хуудсыг шинэчлэх
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аниме Засах болон Устгах</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Аниме хайлт хийх</h2>
    <form action="animeedit.php" method="POST">
        <input type="text" name="search" placeholder="Аниме хайх..." value="<?php echo $searchQuery; ?>">
        <button type="submit">Хайх</button>
    </form>

    <h2>Аниме жагсаалт</h2>
    <div class="anime-list">
        <?php
        if ($result->num_rows > 0) {
            while ($anime = $result->fetch_assoc()) {
                // Аниме-ийн зураг, видео, тайлбар, үнэлгээ гаргах
                echo '<div class="anime-item">';
                echo '<img src="images/' . $anime['image_url'] . '" alt="' . $anime['title'] . '" class="anime-image">';
                echo '<div class="anime-info">';
                echo '<h3>' . $anime['title'] . '</h3>';
                echo '<p>' . $anime['description'] . '</p>';
                echo '<p>Үнэлгээ: ' . $anime['rating'] . '</p>';
                echo '</div>';
                echo '<div class="anime-actions">';
                // Засах, Устгах гэсэн товчнууд
                echo '<a href="animeeditform.php?id=' . $anime['id'] . '">Засах</a>';
                echo ' | ';
                echo '<a href="?delete_id=' . $anime['id'] . '" onclick="return confirm(\'Та энэ аниме-г устгах гэж байна. Үүнийг устгах уу?\')">Устгах</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Хайлтаар аниме олдсонгүй.</p>';
        }
        ?>
    </div>
</body>
</html>
