<?php
include 'db.php';
session_start();

// Check login status
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Add question functionality
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $questions_text = $_POST['questions_text'];
    $level_id = $_POST['level_id'];
    $correct_answer = $_POST['answer'];

    $sql = "INSERT INTO questions (questions_text, level_id, answer) VALUES ('$questions_text', $level_id, '$correct_answer')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center;'>تمت إضافة السؤال بنجاح!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>حدث خطأ: " . $conn->error . "</p>";
    }
}

// Fetch user answers
$sql_answers = "SELECT u.name, u.age, q.questions_text, ua.user_answer
                FROM user_answers ua
                JOIN questions q ON ua.questions_id = q.id
                JOIN users u ON ua.user_id = u.id
                ORDER BY u.id";

$result_answers = $conn->query($sql_answers);

$user_answers = [];
while ($row = $result_answers->fetch_assoc()) {
    $user_answers[$row['name']][] = [
        'age' => $row['age'],
        'question' => $row['questions_text'],
        'answer' => $row['user_answer']
    ];
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة سؤال ونتائج المستخدمين</title>
    <style>
      body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9; /* لون الخلفية */
    color: #333; /* لون النص */
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.container {
    width: 90%;
    max-width: 800px;
    margin: 20px auto;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.card {
    background-color: #fff; /* لون خلفية الكارد */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #1D809F; /* لون العنوان */
    text-align: center;
    margin-bottom: 20px;
}

.form-group label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc; /* لون الحدود */
    transition: border-color 0.3s;
    box-sizing: border-box; /* لضمان عدم تجاوز العرض */
}

.form-group input:focus {
    border-color: #1D809F; /* لون الحدود عند التركيز */
    outline: none;
}

.btn-custom {
    background-color: #1D809F; /* لون زر الإرسال */
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.btn-custom:hover {
    background-color: #145a73; /* لون الزر عند التمرير */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table, th, td {
    border: 1px solid #ddd; /* لون حدود الجدول */
}

th, td {
    padding: 12px; /* مساحة داخل الخلايا */
    text-align: right; /* محاذاة النص إلى اليمين */
}

th {
    background-color: #1D809F; /* لون خلفية رؤوس الجدول */
    color: white; /* لون نص رؤوس الجدول */
}

tr:hover {
    background-color: #f1f1f1; /* لون الصف عند التمرير */
}
    </style>
</head>
<body>

<div class="container">
    <!-- Card for Adding Questions -->
    <div class="card">
        <h2>إضافة سؤال</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="questions_text">نص السؤال:</label>
                <input type="text" id="questions_text" name="questions_text" required>
            </div>
            <div class="form-group">
                <label for="level_id">المستوى:</label>
                <input type="number" id="level_id" name="level_id" required>
            </div>
            <div class="form-group">
                <label for="answer">الإجابة الصحيحة:</label>
                <input type="number" id="answer" name="answer" required>
            </div>
            <button type="submit" class="btn-custom">إضافة السؤال</button>
        </form>
    </div>

    <!-- Card for Displaying User Answers -->
    <div class="card">
        <h2>إجابات المستخدمين</h2>
        <?php if (!empty($user_answers)) { ?>
            <table>
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>العمر</th>
                        <th>الأسئلة والإجابات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user_answers as $name => $answers) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($name); ?></td>
                            <td><?php echo htmlspecialchars($answers[0]['age']); ?></td>
                            <td>
                                <?php 
                                    foreach ($answers as $index => $answer) {
                                        echo htmlspecialchars($answer['question']) . ": " . htmlspecialchars($answer['answer']);
                                        if ($index < count($answers) - 1) {
                                            echo "<br>";
                                        }
                                    } 
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>لا توجد إجابات لهذه الأسئلة بعد.</p>
        <?php } ?>
    </div>
</div>

</body>
</html>