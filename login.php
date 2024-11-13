<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];

    // استعلام لإدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO users (name, age) VALUES ('$name', '$age')";
    
    if ($conn->query($sql) === TRUE) {
        // تسجيل الدخول مباشرة وتوجيه المستخدم إلى صفحة المستويات
        $user_id = $conn->insert_id;
        $_SESSION['user_id'] = $user_id;
        header("Location: levels.php");
        exit;
    } else {
        $error = "خطأ في التسجيل: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-blue: #1D809F;
            --bs-blue-dark: #145a73;
            --bs-yellow: #ecb807; /* اللون الأصفر */
            --bs-white: #fff;
            --bs-dark: #212529;
            --bs-gray: #6c757d;
        }

        body {
            background-color: var(--bs-yellow); /* إعادة الخلفية إلى اللون الأصفر */
            height: 100vh; /* يغطي ارتفاع الشاشة بالكامل */
            font-family: 'Arial', sans-serif;
            direction: rtl; /* محاذاة النصوص لليمين */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 400px;
            opacity: 0; /* لجعلها غير مرئية في البداية */
            animation: fadeIn 0.5s forwards; /* إضافة الرسوم المتحركة */
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .form-container {
            background-color: var(--bs-white);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(20px); /* تحريكها للأسفل */
            animation: slideInUp 0.5s forwards; /* إضافة الرسوم المتحركة */
        }

        @keyframes slideInUp {
            to {
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--bs-dark);
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            transition: border-color 0.3s ease, box-shadow 0.3s ease; /* تأثير على الحقول */
        }

        .form-control:focus {
            border-color: var(--bs-blue);
            box-shadow: 0 0 0 0.2rem rgba(29, 128, 159, 0.25);
        }

        .btn-custom {
            background: linear-gradient(45deg, var(--bs-blue), var(--bs-blue-dark)); /* تدرج لوني */
            color: var(--bs-white);
            border: none;
            border-radius: 40px; /* شكل دائري للزر */
            padding: 12px 34px; /* إضافة حشوة */
            font-size: 18px; /* حجم خط أكبر */
            transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            position: relative; /* لجعل التحولات تعمل بشكل صحيح */
            overflow: hidden; /* إخفاء التأثيرات الزائدة */
            cursor: pointer; /* تغيير شكل المؤشر عند التمرير */
        }

        .btn-custom:hover {
            background: linear-gradient(45deg, var(--bs-blue-dark), var(--bs-blue)); /* عكس التدرج عند التمرير */
            transform: scale(1.05); /* تكبير الزر عند التمرير */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .alert {
            opacity: 0; /* لجعلها غير مرئية في البداية */
            animation: fadeInAlert 0.5s forwards; /* إضافة الرسوم المتحركة */
        }

        @keyframes fadeInAlert {
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>تسجيل الدخول</h2>
            <form action="login.php" method="post">
                <div class="mb-3 form-group">
                    <label for="name">الاسم:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3 form-group">
                    <label for="age">العمر:</label>
                    <input type="number" class="form-control" id="age" name="age" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">تسجيل الدخول</button>
            </form>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger mt-3">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>