<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>حساب ذهني - تسنيم عاصم الدواخ</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        body {
            background-color: #1D809F; /* لون خلفية جميع الصفحة */
            color: #ffffff; /* لون النص الافتراضي */
        }

        header.masthead {
            padding: 20px 0; /* إضافة بعض الحشو */
        }

        .card-container {
            display: flex; /* استخدام Flexbox لتوزيع الكاردات أفقياً */
            flex-wrap: wrap; /* يسمح بلف الكاردات عند الحاجة */
            justify-content: space-between; /* توزيع الكاردات بالتساوي */
            margin-top: 20px;
        }

        .card {
            flex: 1 1 30%; /* كل كارد يحتل 30% من العرض كحد أقصى */
            margin: 10px; /* هامش بين الكاردات */
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #fff; /* خلفية الكاردات بيضاء لتباين جيد */
            color: #000; /* لون النص داخل الكاردات */
        }

        .card h5 {
            color: #1D809F; /* لون عنوان الكارد */
        }

        .btn-custom {
            background-color: #1D809F; /* لون الزر */
            color: white; /* لون نص الزر */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: #145a73; /* لون الزر عند التمرير */
        }

        /* إضافة تنسيق خاص للرسالة */
        #dynamic-text {
            font-size: 1.5rem;
            margin-top: 20px;
        }
    </style>
</head>
<body id="page-top">
    <!-- Navigation-->
    <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand"><a href="#page-top">Start Bootstrap</a></li>
            <li class="sidebar-nav-item"><a href="#page-top">Home</a></li>
            <li class="sidebar-nav-item"><a href="#about">About</a></li>
            <li class="sidebar-nav-item"><a href="#services">Services</a></li>
            <li class="sidebar-nav-item"><a href="#portfolio">Portfolio</a></li>
            <li class="sidebar-nav-item"><a href="admin_login.php">admin</a></li>
            <li class="sidebar-nav-item"><a href="login.php">الحساب الذهني</a></li>
        </ul>
    </nav>
    <!-- Header-->
    <header class="masthead d-flex align-items-center">
        <div class="container px-4 px-lg-5 text-center">
            <h1 class="mb-1">الحساب الذهني</h1>
            <h3 id="dynamic-text" class="mb-5"></h3> <!-- عنصر لعرض الرسالة -->
            <a class="btn btn-primary btn-xl" href="login.php">ابدأ الآن</a>
        </div>
    </header>

    <div class="container">
        <div class="card-container">
            <!-- Card for Mental Calculation -->
            <div class="card">
                <h5>ما هو الحساب الذهني؟</h5>
                <p>الحساب الذهني هو القدرة على إجراء العمليات الحسابية دون استخدام الآلات الحاسبة أو الأقلام والورق. يتطلب الأمر التركيز والمهارة في التفكير السريع.</p>
            </div>

            <div class="card">
                <h5>أهمية الحساب الذهني</h5>
                <p>تحسين القدرة على التركيز، تعزيز مهارات التفكير النقدي، وزيادة الثقة بالنفس في التعامل مع الأرقام.</p>
            </div>

            <div class="card">
                <h5>كيف تبدأ؟</h5>
                <p>يمكنك البدء بتحديات بسيطة ثم الانتقال إلى المستويات الأكثر تعقيدًا. استمتع بالتعلم وتحدى أصدقائك!</p>
                <a class="btn-custom" href="login.php">انطلق في التحدي</a>
            </div>
        </div>
    </div>

    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container px-4 px-lg-5">
            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!"><i class="icon-social-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!"><i class="icon-social-twitter"></i></a>
                </li>
            </ul>
            <p class="text-muted small mb-0">&copy; تسنيم عاصم الدواخ 2023</p>
        </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

    <script>
        // دالة لكتابة النص تدريجياً
        function typeText(element, text, delay) {
            let index = 0;
            function type() {
                if (index < text.length) {
                    element.innerHTML += text.charAt(index);
                    index++;
                    setTimeout(type, delay);
                }
            }
            type();
        }

        // تشغيل دالة الكتابة عند تحميل الصفحة
        window.onload = function() {
            const dynamicTextElement = document.getElementById('dynamic-text');
            const textToType = "اختبر ذكائك مع تحديات مثيرة!";
            typeText(dynamicTextElement, textToType, 80); // 80 مللي ثانية لكل حرف
        };
    </script>
</body>
</html>