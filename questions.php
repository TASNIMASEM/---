<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['level'])) {
    $level = $_GET['level'];
} else {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM questions WHERE level_id = $level";
$result = $conn->query($sql);

if (!$result) {
    die("خطأ في الاستعلام: " . $conn->error); // في حال فشل الاستعلام
}

if (!isset($_SESSION['end_time'])) {
    $_SESSION['end_time'] = time() + 600; // 1 دقيقة (60 ثانية)
}

$remaining_time = $_SESSION['end_time'] - time();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>الأسئلة</title>
    <script src="timer.js"></script> <!-- ربط الملف الخارجي -->
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
            margin: 0;
            padding: 0;
        }

        /* تنسيق الحاوية */
        .container {
            max-width: 600px;
            margin-top: 100px;
            margin-left: auto;
            margin-right: auto;
        }

        /* تنسيق النموذج */
        .form-container {
            background-color: var(--bs-white);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* حركة العنوان */
        @keyframes bounce {
            0% { transform: translateY(0); }
            25% { transform: translateY(-10px); }
            50% { transform: translateY(0); }
            75% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        /* تنسيق عنوان المستوى */
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--bs-dark);
            font-size: 24px;
            animation: bounce 1s ease infinite; /* تأثير القفز */
        }

        /* تنسيق الوقت المتبقي */
        #timer {
            font-size: 20px;
            font-weight: bold;
            color: var(--bs-dark);
        }

        /* تنسيق الأسئلة */
        form p {
            font-size: 18px;
            margin-bottom: 15px;
            color: var(--bs-dark);
        }

        /* تنسيق الحقول */
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        /* تغيير اللون عند التركيز داخل الحقل */
        input[type="number"]:focus {
            border-color: var(--bs-blue);
            box-shadow: 0 0 0 0.2rem rgba(29, 128, 159, 0.25);
        }

        /* زر الإرسال */
        button {
            background-color: var(--bs-blue);
            color: var(--bs-white);
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: var(--bs-blue-dark);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>الأسئلة - المستوى <?php echo $level; ?></h1>
            <p>الوقت المتبقي: <span id="timer"></span></p> <!-- عرض العداد الزمني -->

            <form action="submit_answers.php?level=<?php echo $level; ?>" method="post">
                <?php
                if ($result->num_rows > 0) {
                    while ($question = $result->fetch_assoc()) {
                        echo "<p>" . $question['questions_text'] . "</p>";
                        echo '<input type="number" name="answers[' . $question['id'] . ']" required>';
                    }
                } else {
                    echo "<p>لا توجد أسئلة لهذا المستوى.</p>";
                }
                ?>
                <button type="submit">إرسال الإجابات</button>
            </form>
        </div>
    </div>
</body>
</html>