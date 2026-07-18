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

if($_SERVER['REQUEST_METHOD']=="POST"){

    $note = trim($_POST['note'] ?? "");

    if($note != ""){

        // فعلا admin_id را NULL میگذاریم
        addCustomerNote($customer['id'], null, $note);

        header("Location: customer.php?id=".$customer['id']);
        exit;
    }

}

$notes = getCustomerNotes($customer['id']);

include "includes/header.php";
include "includes/sidebar.php";

?>

<div class="main">

    <div class="content">

        <div class="page-title">

            <div>

                <h2>

                    <?= htmlspecialchars($customer['fullname']) ?>

                </h2>

                <span>

                    جزئیات مشتری

                </span>

            </div>

            <a href="customer_edit.php?id=<?= $customer['id'] ?>" class="btn btn-primary">

                <i class="bi bi-pencil-square"></i>

                ویرایش اطلاعات

            </a>

        </div>

        <div class="customer-info-card">

            <div class="info-grid">

                <div class="info-item">

                    <label>نام و نام خانوادگی</label>

                    <p>
                        <?= htmlspecialchars($customer['fullname']) ?>
                    </p>

                </div>

                <div class="info-item">

                    <label>شماره تماس</label>

                    <p>
                        <?= htmlspecialchars($customer['contact_number']) ?>
                    </p>

                </div>

                <div class="info-item">

                    <label>شماره درخواستی</label>

                    <p>
                        <?= htmlspecialchars($customer['desired_number']) ?>
                    </p>

                </div>

                <div class="info-item">

                    <label>پلتفرم</label>

                    <p>
                        <?= htmlspecialchars($customer['platform']) ?>
                    </p>

                </div>

                <div class="info-item">

                    <label>وضعیت</label>

                    <p>
                        <?= htmlspecialchars($customer['status']) ?>
                    </p>

                </div>

                <div class="info-item">

                    <label>user_id</label>

                    <p>
                        <?= htmlspecialchars($customer['user_id']) ?>
                    </p>

                </div>

                <div class="info-item">

                    <label>منبع</label>

                    <p>
                        <?= htmlspecialchars($customer['source']) ?>
                    </p>

                </div>

                <div class="info-item">

                    <label>تاریخ ثبت</label>

                    <p>
                        <?= $customer['created_at'] ?>
                    </p>

                </div>

            </div>

        </div>

        <div class="notes-box">

            <div class="notes-header">

                <h3>

                    <i class="bi bi-journal-text"></i>

                    توضیحات و پیگیری ها

                </h3>

            </div>

            <form method="post" class="note-form">

                <textarea name="note" rows="5" placeholder="توضیح جدید را وارد کنید..." required></textarea>

                <button class="btn btn-primary">

                    <i class="bi bi-plus-circle"></i>

                    ثبت توضیح

                </button>

            </form>

            <div class="notes-list">

                <?php if(count($notes)==0): ?>

                <div class="empty-notes">

                    هنوز هیچ توضیحی ثبت نشده است.

                </div>

                <?php endif; ?>

                <?php foreach($notes as $note): ?>

                <div class="note-card">

                    <div class="note-date">

                        <i class="bi bi-clock-history"></i>

                        <?= $note['created_at'] ?>

                    </div>

                    <div class="note-text">

                        <?= nl2br(htmlspecialchars($note['note'])) ?>

                    </div>

                </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>