<?php

require_once "includes/auth.php";

include "includes/header.php";

include "includes/sidebar.php";

?>

<div class="main">

    <div class="header">

        <div class="header-title">

            <h1>داشبورد</h1>

            <span>سامانه مدیریت مرکز ارتباط با ایرانسل</span>

        </div>

        <div class="header-user">

            <div>

                <strong>مدیر سیستم</strong>

                <br>

                <small>خوش آمدید 👋</small>

            </div>

            <div class="avatar">

                <i class="bi bi-person-fill"></i>

            </div>

        </div>

    </div>
    
        <div class="welcome-banner">

        <div class="welcome-text">

            <h2>
                👋 خوش آمدید مدیر سیستم
            </h2>

            <p>
                امروز       
                <?php echo date("Y/m/d"); ?>
                می‌توانید وضعیت مشتریان، گزارش‌ها و ثبت‌نام‌های جدید را مدیریت کنید.
            </p>

        </div>

        <div class="welcome-image">

            <i class="bi bi-broadcast-pin"></i>

        </div>

    </div>
    
    <div class="stats">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <div class="stat-info">

                <span>کل مشتریان</span>

                <h2>245</h2>

            </div>

        </div>

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-person-check-fill"></i>

            </div>

            <div class="stat-info">

                <span>ثبت‌نام امروز</span>

                <h2>12</h2>

            </div>

        </div>

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-sim"></i>

            </div>

            <div class="stat-info">

                <span>سیم‌کارت‌های 0900</span>

                <h2>84</h2>

            </div>

        </div>

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-bar-chart-fill"></i>

            </div>

            <div class="stat-info">

                <span>گزارش امروز</span>

                <h2>18</h2>

            </div>

        </div>

    </div>
    

    <div class="content">

        <div class="dashboard-cards">

            <a href="export_excel.php" class="dashboard-card">

                <div class="dashboard-card-icon yellow">
                    <i class="bi bi-download"></i>
                </div>

                <div class="dashboard-card-title">
                    دانلود اکسل
                </div>

                <div class="dashboard-card-desc">
                     دریافت آخرین اطلاعات مشتریان
                    در قالب فایل Excel
                </div>

                <div class="dashboard-card-arrow">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </div>

            </a>


            <a href="customers.php" class="dashboard-card">

                <div class="dashboard-card-icon blue">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div class="dashboard-card-title">
                    لیست مشتریان
                </div>

                <div class="dashboard-card-desc">
                    مشاهده، جستجو و مدیریت
                    تمامی مشتریان
                </div>

                <div class="dashboard-card-arrow">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </div>

            </a>


            <a href="customer_add.php" class="dashboard-card">

                <div class="dashboard-card-icon green">
                    <i class="bi bi-person-plus-fill"></i>
                </div>

                <div class="dashboard-card-title">
                    افزودن مشتری
                </div>

                <div class="dashboard-card-desc">
                    ثبت سریع مشتری جدید
                    در سامانه
                </div>

                <div class="dashboard-card-arrow">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </div>

            </a>

        </div>

    </div>

</div>

<?php

include "includes/footer.php";

?>