<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختيار المستوى</title>
    <!-- تنسيقات CSS داخلية -->
    <style>
        /* إعداد الألوان */
        :root {
            --bs-blue: #1D809F; /* اللون الأزرق الأساسي */
            --bs-blue-dark: #145a73; /* لون أغمق للتأثير */
            --bs-yellow: #ecb807; /* خلفية الصفحة */
            --bs-white: #fff;
            --bs-dark: #212529; /* لون النص */
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
            text-align: center;
        }

        .form-container {
            background-color: var(--bs-white);
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--bs-dark);
        }

        .levels-list {
            list-style-type: none;
            padding: 0;
        }

        .levels-list li {
            margin: 15px 0;
        }

        .level-button {
            display: inline-block;
            width: 100%;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            color: var(--bs-white);
            background-color: var(--bs-blue);
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .level-button:hover {
            background-color: var(--bs-blue-dark);
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .level-button:active {
            transform: translateY(2px) scale(0.98);
        }

        /* تأثير النبض */
        .level-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            background-color: rgba(29, 128, 159, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(1);
            opacity: 0;
            transition: transform 0.5s ease, opacity 0.5s ease;
            z-index: -1;
        }

        .level-button:hover::after {
            transform: translate(-50%, -50%) scale(1.4);
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
           
            <center> 
            <h2>اختر مستوى</h2>
            <ul class="levels-list">
                <li><a class="level-button" href="questions.php?level=1">المستوى 1</a></li>
                <li><a class="level-button" href="questions.php?level=2">المستوى 2</a></li>
                <li><a class="level-button" href="questions.php?level=3">المستوى 3</a></li>
            </ul> </center>
        </div>
    </div>
</body>
</html>
