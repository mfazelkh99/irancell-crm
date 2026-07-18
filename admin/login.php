<?php

session_start();
require_once "../config.php";

if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true){
    header("Location: dashboard.php");
    exit;
}

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if(
        $username === ADMIN_USERNAME &&
        $password === ADMIN_PASSWORD
    ){

        session_regenerate_id(true);

        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_username"]  = $username;

        header("Location: dashboard.php");
        exit;

    }else{

        $error = "نام کاربری یا رمز عبور اشتباه است.";

    }

}

?>
<!DOCTYPE html>

<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>ورود به پنل مدیریت</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo filemtime(__DIR__.'/assets/css/style.css'); ?>">

</head>

<body class="login-page">

    <div class="login-wrapper">

        <div class="login-card">

            <div class="login-logo">

                <img src="assets/images/irancell-logo3.png">

                <h1>

                    سامانه مدیریت

                </h1>

                <p>

                    مرکز ارتباط با ایرانسل

                </p>

            </div>

            <?php if($error!=""): ?>

            <div class="login-error">

                <i class="bi bi-exclamation-triangle-fill"></i>

                <?= htmlspecialchars($error) ?>

            </div>

            <?php endif; ?>

            <form method="post">

                <div class="login-input">

                    <i class="bi bi-person-fill"></i>

                    <input type="text" name="username" placeholder="نام کاربری" required>

                </div>

                <div class="login-input">

                    <i class="bi bi-lock-fill"></i>

                    <input id="password" type="password" name="password" placeholder="رمز عبور" required>

                    <button type="button" class="toggle-password" onclick="togglePassword()">

                        <i id="eyeIcon" class="bi bi-eye"></i>

                    </button>

                </div>

                <button type="submit" class="login-btn">

                    <i class="bi bi-box-arrow-in-left"></i>

                    ورود به پنل مدیریت

                </button>

            </form>

            <div class="login-footer">

                Irancell CRM Panel

                <br>

                Version 1.0

            </div>

        </div>

    </div>

    <script>

        function togglePassword() {

            const input = document.getElementById("password");
            const icon = document.getElementById("eyeIcon");

            if (input.type === "password") {

                input.type = "text";
                icon.className = "bi bi-eye-slash";

            } else {

                input.type = "password";
                icon.className = "bi bi-eye";

            }

        }

    </script>

</body>

</html>