<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "includes/auth.php";

require_once "includes/customer_functions.php";

$search = $_GET['search'] ?? "";

$status = $_GET['status'] ?? "";

$platform = $_GET['platform'] ?? "";

$sort = $_GET['sort'] ?? "newest";

$customers = getCustomers(
    $search,
    $status,
    $platform,
    $sort
);

$totalCustomers = countCustomers();

include "includes/header.php";

include "includes/sidebar.php";
?>
<div class="main">
    <div class="content">
        <div class="page-title">

            <div>

                <h2>لیست مشتریان</h2>

                <span>

                    تعداد کل مشتریان :
                    <?= $totalCustomers ?>

                </span>

            </div>

            <a href="customer_add.php" class="btn btn-primary">

                <i class="bi bi-plus-lg"></i>

                افزودن مشتری

            </a>

        </div>

        <form class="customer-filters" method="get">

            <input type="text" name="search" placeholder="جستجوی نام، شماره، آی دی..."
                value="<?= htmlspecialchars($search) ?>">

            <select name="status">

                <option value="">همه وضعیت ها</option>

                <option value="COMPLETE">

                    COMPLETE

                </option>

                <option value="START">

                    START

                </option>

            </select>

            <select name="platform">

                <option value="">همه پلتفرم ها</option>

                <option value="bale">

                    بله

                </option>

                <option value="eitaa">

                    ایتا

                </option>

            </select>

            <select name="sort">

                <option value="newest">

                    جدیدترین

                </option>

                <option value="oldest">

                    قدیمی ترین

                </option>

                <option value="updated">

                    آخرین بروزرسانی

                </option>

                <option value="name">

                    نام

                </option>

            </select>

            <button class="btn btn-primary">

                جستجو

            </button>

        </form>

        <div class="customers-grid">

            <?php foreach($customers as $customer): ?>

            <a href="customer.php?id=<?= $customer['id'] ?>" class="customer-card">

                <div class="customer-header">

                    <h3>

                        <?= htmlspecialchars($customer['fullname']) ?>

                    </h3>

                    <span class="status-badge <?= strtolower($customer['status']) ?>">

                        <?= $customer['status'] ?>

                    </span>

                </div>

                <div class="customer-body">

                    <p>

                        📱

                        <?= htmlspecialchars($customer['contact_number']) ?>

                    </p>

                    <p>

                        ☎️

                        <?= htmlspecialchars($customer['desired_number']) ?>

                    </p>

                    <p>

                        🆔

                        <?= $customer['user_id'] ?>

                    </p>

                    <p>

                        📍

                        <?= htmlspecialchars($customer['source']) ?>

                    </p>

                </div>

                <div class="customer-footer">

                    <span class="platform <?= $customer['platform'] ?>">

                        <?= $customer['platform'] ?>

                    </span>

                    <span>

                        <?= date(
                        "Y/m/d",
                        strtotime(
                        $customer['created_at']
                        )
                    ) ?>

                    </span>

                </div>

            </a>

            <?php endforeach; ?>

        </div>

    </div>
</div>
<?php
include "includes/footer.php";

?>