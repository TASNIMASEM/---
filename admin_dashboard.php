<?php
include 'db.php';
session_start();

// التحقق من أن المستخدم هو المسؤول
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المسؤول</title>
</head>
<body>
    <h1>مرحبا بك في لوحة تحكم المسؤول</h1>
    <h2>إضافة سؤال جديد</h2>
    <form action="add_question.php" method="post">
        <label>اختر المستوى:</label>
        <select name="level" required>
            <option value="1">المستوى 1</option>
            <option value="2">المستوى 2</option>
            <option value="3">المستوى 3</option>
        </select>
        <br>
        <label>نص السؤال:</label>
        <input type="text" name="question_text" required>
        <br>
        <label>الإجابة الصحيحة:</label>
        <input type="text" name="correct_answer" required>
        <br>
        <button type="submit">إضافة السؤال</button>
    </form>
</body>
</html>
