<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once "includes/auth.php";
require_once "includes/customer_functions.php";

$id = (int)($_GET['id'] ?? 0);

if($id <= 0){
    die("شناسه مشتری نامعتبر است.");
}

$customer = getCustomer($id);

if(!$customer){
    die("مشتری یافت نشد.");
}

$success = false;
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fullname        = trim($_POST["fullname"] ?? "");
    $contact_number  = trim($_POST["contact_number"] ?? "");
    $desired_number  = trim($_POST["desired_number"] ?? "");
    $username        = trim($_POST["username"] ?? "");
    $status          = trim($_POST["status"] ?? "");
    $platform        = trim($_POST["platform"] ?? "");
    $source          = trim($_POST["source"] ?? "");

    if($fullname == ""){

        $error = "نام و نام خانوادگی الزامی است.";

    }else{

        global $conn;

        $stmt = $conn->prepare("
            UPDATE users
            SET

                fullname=?,
                contact_number=?,
                desired_number=?,
                username=?,
                status=?,
                platform=?,
                source=?,
                updated_at=NOW()

            WHERE id=?
        ");

        $stmt->bind_param(

            "sssssssi",

            $fullname,
            $contact_number,
            $desired_number,
            $username,
            $status,
            $platform,
            $source,
            $id

        );

        if($stmt->execute()){

            $success = true;

            $customer = getCustomer($id);

        }else{

            $error = "خطا در ذخیره اطلاعات.";

        }

    }

}

include "includes/header.php";
include "includes/sidebar.php";

?>

<div class="main">

    <div class="content">

        <div class="page-title">

            <div>

                <h2>

                    ویرایش اطلاعات مشتری

                </h2>

                <span>

                    <?= htmlspecialchars($customer['fullname'] ?? '') ?>

                </span>

            </div>

            <a href="customer.php?id=<?= $customer['id'] ?>" class="btn btn-primary">

                <i class="bi bi-arrow-right"></i>

                بازگشت

            </a>

        </div>

        <?php if($success): ?>

        <div class="alert-success">

            اطلاعات مشتری با موفقیت بروزرسانی شد.

        </div>

        <?php endif; ?>

        <?php if($error!=""): ?>

        <div class="alert-error">

            <?= htmlspecialchars($error) ?>

        </div>

        <?php endif; ?>

        <form method="post" class="customer-edit-form">

            <div class="form-grid">

                <div class="form-group">

                    <label>

                        نام و نام خانوادگی

                    </label>

                    <input type="text" name="fullname" value="<?= htmlspecialchars($customer['fullname'] ?? '') ?>">

                </div>

                <div class="form-group">

                    <label>

                        شماره تماس

                    </label>

                    <input type="text" name="contact_number"
                        value="<?= htmlspecialchars($customer['contact_number'] ?? '') ?>">

                </div>

                <div class="form-group">

                    <label>

                        شماره درخواستی

                    </label>

                    <input type="text" name="desired_number"
                        value="<?= htmlspecialchars($customer['desired_number'] ?? '') ?>">

                </div>

                <div class="form-group">

                    <label>

                        نام کاربری

                    </label>

                    <input type="text" name="username" value="<?= htmlspecialchars($customer['username'] ?? '') ?>">

                </div>

            </div>

        <div class="form-group">

            <label>

                وضعیت

            </label>

            <select name="status">

                <option value="START" <?=$customer['status']=="START" ? "selected" : "" ?>>

                    START

                </option>

                <option value="COMPLETE" <?=$customer['status']=="COMPLETE" ? "selected" : "" ?>>

                    COMPLETE

                </option>

            </select>

        </div>

        <div class="form-group">

            <label>

                پلتفرم

            </label>

            <select name="platform">

                <option value="eitaa" <?=$customer['platform']=="eitaa" ? "selected" : "" ?>>

                    ایتا

                </option>

                <option value="bale" <?=$customer['platform']=="bale" ? "selected" : "" ?>>

                    بله

                </option>

                <option value="manual" <?=$customer['platform']=="manual" ? "selected" : "" ?>>

                    ثبت دستی

                </option>

            </select>

        </div>

        <div class="form-group">

            <label>

                منبع

            </label>

            <input type="text" name="source" value="<?= htmlspecialchars($customer['source'] ?? '') ?>">

        </div>

        <div class="form-group">

            <label>

                شناسه کاربر (user_id)

            </label>

            <input type="text" value="<?= htmlspecialchars($customer['user_id'] ?? '') ?>" disabled>

        </div>

        <div class="form-group">

            <label>

                تاریخ ثبت

            </label>

            <input type="text" value="<?= htmlspecialchars($customer['created_at'] ?? '') ?>" disabled>

        </div>

        <div class="form-group">

            <label>

                آخرین بروزرسانی

            </label>

            <input type="text" value="<?= htmlspecialchars($customer['updated_at'] ?? '') ?>" disabled>

        </div>

    </div>

    <div class="form-actions">

        <button type="submit" class="btn btn-primary">

            <i class="bi bi-check-circle-fill"></i>

            ذخیره تغییرات

        </button>

        <a href="customer.php?id=<?= $customer['id'] ?>" class="btn btn-secondary">

            <i class="bi bi-x-circle"></i>

            انصراف

        </a>

    </div>

    </form>

</div>

</div>

<?php include "includes/footer.php"; ?>