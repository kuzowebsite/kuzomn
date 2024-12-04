<?php
session_start();
include 'db.php'; // MySQL холболтыг оролцуулах

// Админ нэвтрэх хэсэг
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Нууц үг давхцахгүй бол алдаа
    if ($password !== $password_confirm) {
        $error = "Нууц үг таарахгүй байна!";
    } else {
        // Нууц үгийг хэшлэх
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Админ хэрэглэгчийг бүртгэх
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $hashed_password);

        // Бүртгэл амжилттай бол
        if ($stmt->execute()) {
            $success = "Админ амжилттай бүртгэгдлээ!";
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
    <title>Админ бүртгэх</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Админ бүртгэх</h2>

    <!-- Амжилттай бүртгэгдсэн бол -->
    <?php if (isset($success)) { echo "<p style='color: green;'>$success</p>"; } ?>

    <!-- Алдаа гарсан бол -->
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

    <form method="POST" action="adminview.php">
        <label for="username">Хэрэглэгчийн нэр:</label>
        <input type="text" name="username" required><br><br>

        <label for="password">Нууц үг:</label>
        <input type="password" name="password" required><br><br>

        <label for="password_confirm">Нууц үг давтах:</label>
        <input type="password" name="password_confirm" required><br><br>

        <button type="submit">Бүртгэх</button>
    </form>

    <p><a href="admin.php">Админ хуудас руу шилжих</a></p> <!-- admin.php руу шилжих холбоос -->
</body>
</html>
