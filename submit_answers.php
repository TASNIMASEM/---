<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_answers = $_POST['answers'] ?? [];
$user_id = $_SESSION['user_id'];
$level = $_GET['level'] ?? null;

if (empty($user_answers) || empty($level)) {
    echo "الرجاء التحقق من البيانات المدخلة.";
    exit;
}

$correct_count = 0;
$wrong_count = 0;
$final_results = '';

$correct_sound = "<audio id='correct-sound' src='correct_answer.mp3'></audio>";
$wrong_sound = "<audio id='wrong-sound' src='تصفيق الجمهور مونتاج.mp3'></audio>";

// جلب الأسئلة بناءً على level_id
$sql = "SELECT id, answer FROM questions WHERE level_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $level);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while ($question = $result->fetch_assoc()) {
    $questions[$question['id']] = $question['answer'];
}

$question_number = 1; // عداد الأسئلة

// تقييم إجابات المستخدم
foreach ($user_answers as $question_id => $user_answer) {
    if (isset($questions[$question_id])) {
        $correct_answer = $questions[$question_id];

        if ($user_answer == $correct_answer) {
            $correct_count++;
            $final_results .= "<div class='result-card correct-answer'>
                                    <strong>السؤال رقم $question_number:</strong> ✅ إجابة صحيحة!
                                    $correct_sound
                                </div>";
        } else {
            $wrong_count++;
            $final_results .= "<div class='result-card wrong-answer'>
                                    <strong>السؤال رقم $question_number:</strong> ❌ إجابة خاطئة!
                                    $wrong_sound
                                </div>";
        }

        // إدخال الإجابة في قاعدة البيانات
        $insert_sql = "INSERT INTO user_answers (questions_id, user_answer, user_id) 
                       VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("isi", $question_id, $user_answer, $user_id);
        
        if (!$insert_stmt->execute()) {
            echo "حدث خطأ عند حفظ الإجابة: " . $conn->error . "<br>";
        }
        
        $question_number++; // زيادة العداد بعد كل سؤال
    } else {
        $final_results .= "<div class='error'>السؤال رقم $question_number غير موجود!</div>";
        $question_number++; // زيادة العداد حتى في حالة وجود سؤال غير موجود
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتائج الاختبار</title>
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
            flex-direction: column;
        }

        .container {
            max-width: 600px;
            text-align: center;
        }

        .result-card {
            background-color: var(--bs-white);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            color: var(--bs-dark);
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .correct-answer {
            background-color: #e9fbe9;
            color: green;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px;
            animation: fadeIn 0.5s ease-out;
        }

        .wrong-answer {
            background-color: #f8d7da;
            color: red;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px;
            animation: fadeIn 0.5s ease-out;
        }

        .error {
            background-color: #fff3cd;
            color: orange;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .final-results {
            margin-top: 30px;
            background-color: var(--bs-white);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 18px;
            font-weight: bold;
            color: var(--bs-dark);
        }

        .btn {
            display: inline-block;
            padding: 15px 20px;
            font-size: 20px;
            font-weight: bold;
            color: var(--bs-white);
            background-color: var(--bs-blue);
            border-radius: 50px;
            text-decoration: none;
            margin-top: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: var(--bs-blue-dark);
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(2px) scale(0.98);
        }
    </style>
</head>
<body>
    <audio id="entry-sound" src="correct_answer.mp3"></audio>

    <div class="container">
        <h2>نتائج الاختبار</h2>
        <?= $final_results ?>

        <div class="final-results">
            <p>عدد الإجابات الصحيحة: <?= $correct_count ?></p>
            <p>عدد الإجابات الخاطئة: <?= $wrong_count ?></p>
        </div>

        <a href="index.php" class="btn">العودة إلى الصفحة الرئيسية</a>
    </div>

    <script>
        const entrySound = document.getElementById('entry-sound');
        entrySound.play();
    </script>
</body>
</html>