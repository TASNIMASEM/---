<?php
include 'db.php';
session_start();

// تحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// جلب جميع المستخدمين
$sql_users = "SELECT id, name, age FROM users";
$result_users = $conn->query($sql_users);

if (!$result_users) {
    die("خطأ في استرجاع بيانات المستخدمين: " . $conn->error);
}

// جلب إجابات جميع المستخدمين على الأسئلة
$sql_answers = "SELECT u.name, u.age, q.questions_text, ua.user_answer
                FROM user_answers ua
                JOIN questions q ON ua.questions_id = q.id
                JOIN users u ON ua.user_id = u.id";

$result_answers = $conn->query($sql_answers);

if (!$result_answers) {
    die("خطأ في استرجاع إجابات المستخدمين: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>نتائج المستخدمين</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #1D809F;
        }

        .answers {
            margin-top: 20px;
        }

        .answers table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .answers table, .answers th, .answers td {
            border: 1px solid #ddd;
        }

        .answers th, .answers td {
            padding: 10px; 
            text-align: right;
        }

        .answers th {
            background-color: #1D809F;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>نتائج المستخدمين</h1>

        <div class="answers">
            <h2>إجابات المستخدمين على الأسئلة</h2>
            <?php if ($result_answers->num_rows > 0) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>العمر</th>
                            <th>السؤال</th>
                            <th>إجابتك</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($answer = $result_answers->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($answer['name']) . "</td>
                                    <td>" . htmlspecialchars($answer['age']) . "</td>
                                    <td>" . htmlspecialchars($answer['questions_text']) . "</td>
                                    <td>" . htmlspecialchars($answer['user_answer']) . "</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>لا توجد إجابات لهذه الأسئلة بعد.</p>
            <?php } ?>
        </div>
    </div>

</body>
</html>
