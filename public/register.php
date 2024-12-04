<?php
session_start();
include 'db.php'; // Database холболт

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Нууц үг таарахгүй бол
    if ($password != $password_confirm) {
        $error = "Нууц үг таарахгүй байна!";
    } else {
        // Нууц үгийг зөөврийн ашиглалт
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Хэрэглэгчийн бүртгэл нэмэх
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, 'user')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $hashed_password);
        if ($stmt->execute()) {
            // Бүртгэл амжилттай бол хэрэглэгчийг нэвтрэх хуудсанд шилжүүлэх
            header("Location: login.php");
            exit;
        } else {
            $error = "Алдаа гарлаа, дахин оролдоно уу!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бүртгүүлэх</title>
</head>
<body>
    <h2>Бүртгүүлэх</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="register.php">
        <label for="username">Хэрэглэгчийн нэр:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Нууц үг:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="password_confirm">Нууц үг давтах:</label>
        <input type="password" id="password_confirm" name="password_confirm" required><br><br>

        <button type="submit">Бүртгүүлэх</button>
    </form>

    <p>Нэвтрэх бол <a href="login.php">Энд дарна уу</a></p>
</body>
</html>
