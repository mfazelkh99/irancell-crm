<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// اجازه دادن به ایتا برای نمایش برنامک در نسخه وب (رفع محدودیت iframe)
header_remove("X-Frame-Options");
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    
    // دریافت مقادیر فرم بدون اجبار
    $fullname = trim($_POST['fullname']);
    $desired_number = trim($_POST['desired_number']);
    $contact_number = trim($_POST['contact_number']);

    // اعتبارسنجی فرمت شماره 0900 فقط در صورتی که پر شده باشد
    if (!empty($desired_number) && !preg_match('/^0900[0-9]{7}$/', $desired_number)) {
        echo "<script>alert('فرمت شماره 0900 وارد شده صحیح نیست.'); window.history.back();</script>";
        exit();
    }

    // بررسی وجود کاربر در دیتابیس
    $check_query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // سناریو اول: کاربر از قبل وجود دارد -> به‌روزرسانی هوشمند فیلدها
        $existing_data = $check_result->fetch_assoc();

        // اگر فیلدی در فرم جدید خالی بود، از مقدار قبلی دیتابیس استفاده کن
        $final_fullname = !empty($fullname) ? $fullname : $existing_data['fullname'];
        $final_desired_number = !empty($desired_number) ? $desired_number : $existing_data['desired_number'];
        $final_contact_number = !empty($contact_number) ? $contact_number : $existing_data['contact_number'];
        

        // تمیزکاری نهایی برای تزریق به دیتابیس
        $final_fullname = mysqli_real_escape_string($conn, $final_fullname);
        $final_desired_number = mysqli_real_escape_string($conn, $final_desired_number);
        $final_contact_number = mysqli_real_escape_string($conn, $final_contact_number);

        $update_sql = "UPDATE users SET 
                        fullname = '$final_fullname', 
                        desired_number = '$final_desired_number', 
                        contact_number = '$final_contact_number',
                        status = 'COMPLETE'
                      WHERE user_id = '$user_id'";
                      
                      
        if ($conn->query($update_sql) === TRUE) {

            // require_once "admin_report.php";

            // sendAdminReport($conn, $user_id);

            echo "<script>alert('اطلاعات درخواست شما با موفقیت به‌روزرسانی شد.'); window.location.href = 'index.php';</script>";
            exit();
        } else {
            echo "خطا در به‌روزرسانی: " . $conn->error;
        }

    } else {
        // سناریو دوم: کاربر جدید است -> ثبت اوليه اطلاعات
        $final_fullname = mysqli_real_escape_string($conn, $fullname);
        $final_desired_number = mysqli_real_escape_string($conn, $desired_number);
        $final_contact_number = mysqli_real_escape_string($conn, $contact_number);

        $insert_sql = "INSERT INTO users (user_id, fullname, desired_number, contact_number, status) 
                       VALUES ('$user_id', '$final_fullname', '$final_desired_number', '$final_contact_number', 'COMPLETE')";

        if ($conn->query($insert_sql) === TRUE) {

            // require_once "admin_report.php";

            // sendAdminReport($conn, $user_id);

            echo "<script>window.location.href = 'index.php?status=success';</script>";
            exit();
        } else {
            echo "خطا در ثبت اطلاعات: " . $conn->error;
        }
    }
}
$conn->close();
?>