<?php
session_start();
include 'db.php'; // قم بإنشاء ملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // استعلام التحقق من وجود المستخدم
    $query = "SELECT * FROM admin_dashboard WHERE email = ? AND pass = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        header("Location: add_question.php"); // تحويل المستخدم لصفحة الأدمن بعد تسجيل الدخول
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>البريد الإلكتروني أو كلمة المرور غير صحيحة</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <style>
        :root {
            --bs-blue: #1D809F;
            --bs-blue-dark: #145a73;
            --bs-yellow: #ecb807;
            --bs-white: #fff;
            --bs-dark: #212529;
            --bs-gray: #6c757d;
        }

        body {
            background-color: var(--bs-yellow);
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
            margin-top: 100px;
        }

        .form-container {
            background-color: var(--bs-white);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--bs-dark);
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid var(--bs-gray);
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: var(--bs-blue);
            box-shadow: 0 0 0 0.2rem rgba(29, 128, 159, 0.25);
        }

        .btn-custom {
            background-color: var(--bs-blue);
            color: var(--bs-white);
            border: none;
            padding: 10px 20px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--bs-blue-dark);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>تسجيل الدخول</h2>
            <form method="POST" action="admin_login.php">
                <div class="form-group">
                    <label for="email">البريد الإلكتروني:</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="pass">كلمة المرور:</label>
                    <input type="password" id="pass" name="pass" required>
                </div>
                <button type="submit" class="btn-custom">تسجيل الدخول</button>
            </form>
        </div>
    </div>
</body>
</html>
