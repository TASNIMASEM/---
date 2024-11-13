let timeLeft = 600; // 1 دقيقة (60 ثانية)

function startTimer() {
    const timer = document.getElementById('timer');
    const interval = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(interval);
            document.forms[0].submit(); // إرسال النموذج تلقائيًا عند انتهاء الوقت
            timer.textContent = "انتهى الوقت!"; // رسالة عند انتهاء الوقت
        } else {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            timer.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`; // عرض الثواني بصيغة ثنائية الرقم
            timeLeft--;
        }
    }, 1000);
}

window.onload = startTimer;