<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "تم التسجيل بنجاح!";
        } else {
            echo "خطأ: " . $conn->error;
        }
    } else {
        echo "البريد الإلكتروني مستخدم مسبقًا.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل</title>
</head>
<body>
    <form action="register.php" method="post">
        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" required>
        <br>
        <label>كلمة المرور:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">تسجيل</button>
    </form>
</body>
</html>
