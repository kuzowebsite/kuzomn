<?php
session_start();
if (isset($_SESSION['user_id'])) {
    // Хэрэв хэрэглэгч аль хэдийн нэвтэрсэн бол index.php руу шилжүүлэх
    header("Location: index.php");
    exit;
}
?>

<?php
session_start();
include 'db.php'; // Database холболт

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Хэрэглэгчийн мэдээллийг авах
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Хэрэглэгч байвал
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Role-ийг шалгаж тохирох хуудсанд шилжих
        if ($user['role'] == 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $error = "Нэвтрэх нэр эсвэл нууц үг буруу байна!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нэвтрэх</title>
</head>
<body>
    <h2>Нэвтрэх</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="login.php">
        <label for="username">Хэрэглэгчийн нэр:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Нууц үг:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Нэвтрэх</button>
    </form>

    <p>Шинэ хэрэглэгч бол <a href="register.php">Бүртгүүлэх</a></p>
</body>
</html>
