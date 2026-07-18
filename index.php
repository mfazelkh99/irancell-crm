<?php

// اجازه دادن به ایتا برای نمایش برنامک در نسخه وب (رفع محدودیت iframe)

header_remove("X-Frame-Options");

?>

<!DOCTYPE html>

<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>استعلام و رزرو خطوط 0900 ایرانسل</title>

    <script src="https://developer.eitaa.com/eitaa-web-app.js"></script>

    <script>

        // مقداردهی اولیه برنامک ایتا

        window.EitaaWebApp.ready();

    </script>

    <!-- Bootstrap RTL CSS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">

    <!-- Vazir Font -->

    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />

    <style>

        body { font-family: 'Vazirmatn', sans-serif; background-color: #f8f9fa; color: #333; }

        .card { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }

        .bg-irancell { background: linear-gradient(135deg, #ffcc00, #ffb300); color: #000; }

        .btn-submit { background-color: #f57c00; color: white; font-weight: bold; }

        .btn-submit:hover { background-color: #e65100; color: white; }

    </style>

</head>

<body>



<div class="container my-4">

    <!-- Header -->

    <div class="card bg-irancell text-center p-4 mb-4">

        <h4 class="fw-bold m-0">سامانه استعلام و رزرو سیم‌کارت 0900</h4>

        <small class="text-muted d-block mt-2">مرکز ارتباط با ایرانسل (یزد)</small>

    </div>



    <!-- Alert Message -->

    <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>

        <div class="alert alert-success text-center" role="alert">

            ✨ اطلاعات شما با موفقیت ثبت شد. به زودی برای اعلام استعلام قیمت با شما تماس خواهیم گرفت.

        </div>

    <?php endif; ?>



    <!-- Form Card -->

    <div class="card p-4 mb-4">

        <h5 class="fw-bold mb-3 text-warning-emphasis">📋 فرم درخواست شماره</h5>

        <form action="submit.php" method="POST" id="mainForm">

            <input type="hidden" id="user_id" name="user_id" value="">

    

            <div class="mb-3">

                <label for="fullname" class="form-label">نام و نام خانوادگی:</label>

                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="مثال: علی محمدی" required>

            </div>

    

            <div class="mb-3">

                <label for="desired_number" class="form-label">شماره 0900 مدنظر شما:</label>

                <input type="tel" class="form-control text-start" id="desired_number" name="desired_number" placeholder="مثال: 09001234567" dir="ltr" pattern="0900[0-9]{7}" title="شماره باید با 0900 شروع شده و 11 رقم باشد" required>

            </div>



            <div class="mb-3">

                <label for="contact_number" class="form-label">شماره تماس در دسترس:</label>

                <input type="tel" class="form-control text-start" id="contact_number" name="contact_number" placeholder="مثال: 09131234567" dir="ltr" pattern="0[0-9]{10}" title="شماره تماس معتبر 11 رقمی وارد کنید" required>

            </div>



            <button type="submit" class="btn btn-submit w-100 py-2.5">🔍 ثبت و استعلام شماره</button>

        </form>



        <script>

        document.addEventListener('DOMContentLoaded', () => {

            // گرفتن اطلاعات رسمی از شیء Eitaa

            const eitaaApp = window.Eitaa ? window.Eitaa.WebApp : null;

    

            if (eitaaApp && eitaaApp.initDataUnsafe && eitaaApp.initDataUnsafe.user) {

                document.getElementById('user_id').value = eitaaApp.initDataUnsafe.user.id;

            } else {

                // مقادیر تست برای محیط لپ‌تاپ

                document.getElementById('user_id').value = "";

            }

        });

        </script>

        

        <script>

            function sendDataToEitaaBot(event) {

                event.preventDefault(); // جلوگیری از رفرش شدن صفحه

    

                const eitaaApp = window.Eitaa ? window.Eitaa.WebApp : null;

    

                // جمع‌آوری اطلاعات فرم در قالب یک شیء

                const formData = {

                    action: "submit_request",

                    fullname: document.getElementById('fullname').value,

                    desired_number: document.getElementById('desired_number').value,

                    contact_number: document.getElementById('contact_number').value

                };



                if (eitaaApp) {

                    // متد رسمی ایتا برای فرستادن دیتا به ربات و بستن وب‌اپ

                    eitaaApp.sendData(JSON.stringify(formData));

                } else {

                    alert("لطفاً این برنامک را داخل پیام‌رسان ایتا باز کنید.");

                }

            }

        </script>

        

    </div>

    

    <script>

        // به محض بالا آمدن برنامک، آی‌دی کاربر را می‌گیریم و درون فرم قرار می‌دهیم

        document.addEventListener('DOMContentLoaded', () => {

        const eitaaApp = window.Eitaa ? window.Eitaa.WebApp : null;

        if (eitaaApp && eitaaApp.initDataUnsafe && eitaaApp.initDataUnsafe.user) {

            // قرار دادن آی‌دی عددی در فیلد مخفی فرم

            document.getElementById('user_id').value = eitaaApp.initDataUnsafe.user.id;

        } else {

            // برای تست روی لپ‌تاپ یا خارج از ایتا، یک مقدار پیش‌فرض یا تصادفی می‌گذاریم

            document.getElementById('user_id').value = "test_user_" + Math.floor(Math.random() * 1000);

        }

        });

    </script>

    

    <!-- Info Card -->

    <div class="card p-4">

        <h5 class="fw-bold mb-3 text-primary">📞 راه های ارتباطی و خدمات</h5>

        <p class="text-justify lh-lg">هماکنون آماده‌ی پاسخگویی به شما هستیم.</p>

        

        <ul class="list-unstyled lh-lg mb-4">

            <li>✅ انجام کلیه امور مربوط به ایرانسل - استعلام، خدمات سیم کارت و مودم، محصولات سازمانی و شرکتی، خدمات خطوط اتباع، خدمات سیم کارت متوفی و ...</li>

            <li>✅ امکان انجام خدمات به صورت غیرحضوری</li>

        </ul>



        <div class="bg-light p-3 rounded mb-3">

            <p class="mb-2"><strong>📍 آدرس:</strong> میدان امام علی(ع)، خ ذوالفقار، بعد از فاز دو مجتمع امام علی(ع)، مرکز ارتباط با ایرانسل</p>

            <p class="mb-1"><strong>⏰ تایم کاری صبح:</strong> 8:30 تا 13:30</p>

            <p class="mb-0"><strong>⏰ تایم کاری عصر:</strong> 17:00 تا 21:00</p>

        </div>



        <div class="row g-2 mb-3">

            <div class="col-6">

                <a href="tel:03537208897" class="btn btn-outline-secondary w-100 text-nowrap">☎️ 03537208897</a>

            </div>

            <div class="col-6">

                <a href="tel:09335121009" class="btn btn-outline-secondary w-100 text-nowrap">📱 09335121009</a>

            </div>

        </div>



        <div class="d-grid gap-2">

            <button onclick="window.Eitaa.WebApp.openEitaaLink('https://eitaa.com/yazdirancell65016')" class="btn btn-warning fw-bold text-dark">📢 کانال ما در ایتا</button>

    

            <button onclick="window.Eitaa.WebApp.openLink('https://rubika.ir/yazdirancell65016')" class="btn btn-danger fw-bold">📢 کانال ما در روبیکا</button>

        </div>

    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html> 

