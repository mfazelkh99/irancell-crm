<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once "includes/auth.php";
require_once "../config.php";

$success = false;
$error = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $fullname        = trim($_POST["fullname"] ?? "");
    $contact_number  = trim($_POST["contact_number"] ?? "");
    $desired_number  = trim($_POST["desired_number"] ?? "");
    $username        = trim($_POST["username"] ?? "");

    $status   = trim($_POST["status"] ?? "START");
    $platform = trim($_POST["platform"] ?? "manual");
    $source   = trim($_POST["source"] ?? "admin");

    if($fullname==""){

        $error = "نام و نام خانوادگی الزامی است.";

    }else{
        $user_id = "MANUAL_" . date("YmdHis") . "_" . rand(1000,9999);
        $stmt = $conn->prepare("

            INSERT INTO users
            (
                user_id,
                fullname,
                contact_number,
                desired_number,
                username,
                status,
                platform,
                source,
                created_at,
                updated_at
            )
            VALUES
            (
            ?,?,?,?,?,
            ?,?,?,
            NOW(),
            NOW()
            )

        ");

        $stmt->bind_param(

            "ssssssss",
            $user_id,
            $fullname,
            $contact_number,
            $desired_number,
            $username,

            $status,
            $platform,
            $source

        );

        if($stmt->execute()){

            $newCustomerId = $conn->insert_id;

            header("Location: customer.php?id=".$newCustomerId);
            exit;

        }else{

            die($stmt->error);

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

                    افزودن مشتری جدید

                </h2>

                <span>

                    ثبت دستی مشتری در سامانه

                </span>

            </div>

            <a href="customers.php" class="btn btn-secondary">

                <i class="bi bi-arrow-right"></i>

                بازگشت

            </a>

        </div>

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

                    <input type="text" name="fullname" required
                        value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>">

                </div>

                <div class="form-group">

                    <label>

                        شماره تماس

                    </label>

                    <input type="text" name="contact_number"
                        value="<?= htmlspecialchars($_POST['contact_number'] ?? '') ?>">

                </div>

                <div class="form-group">

                    <label>

                        شماره درخواستی

                    </label>

                    <input type="text" name="desired_number"
                        value="<?= htmlspecialchars($_POST['desired_number'] ?? '') ?>">

                </div>

                <div class="form-group">

                    <label>

                        نام کاربری

                    </label>

                    <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">

                </div>
                <div class="form-group">

                    <label>

                        وضعیت

                    </label>

                    <select name="status">

                        <option value="START" <?=(($_POST['status'] ?? 'START' )=="START" ) ? "selected" : "" ?>>

                            START

                        </option>

                        <option value="COMPLETE" <?=(($_POST['status'] ?? '' )=="COMPLETE" ) ? "selected" : "" ?>>

                            COMPLETE

                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label>

                        پلتفرم

                    </label>

                    <select name="platform">

                        <option value="manual" <?=(($_POST['platform'] ?? 'manual' )=="manual" ) ? "selected" : "" ?>>

                            ثبت دستی

                        </option>

                        <option value="eitaa" <?=(($_POST['platform'] ?? '' )=="eitaa" ) ? "selected" : "" ?>>

                            ایتا

                        </option>

                        <option value="bale" <?=(($_POST['platform'] ?? '' )=="bale" ) ? "selected" : "" ?>>

                            بله

                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label>

                        منبع

                    </label>

                    <input type="text" name="source" value="<?= htmlspecialchars($_POST['source'] ?? 'admin') ?>">

                </div>

                <div class="form-group">

                    <label>

                        شناسه کاربر (user_id)

                    </label>

                    <input type="text" value="به صورت خودکار پس از ثبت توسط ربات تکمیل می‌شود" disabled>

                </div>

            </div>

            <div class="form-actions">

                <button type="submit" class="btn btn-primary">

                    <i class="bi bi-person-plus-fill"></i>

                    ثبت مشتری

                </button>

                <a href="customers.php" class="btn btn-secondary">

                    <i class="bi bi-x-circle"></i>

                    انصراف

                </a>

            </div>

        </form>

    </div>

</div>

<?php include "includes/footer.php"; ?>