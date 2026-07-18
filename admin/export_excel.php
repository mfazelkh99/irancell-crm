<?php

require_once "../config.php";
require_once "../lib/SimpleXLSXGen.php";

use Shuchkin\SimpleXLSXGen;

$sql = "SELECT
            user_id,
            fullname,
            contact_number,
            desired_number,
            username,
            platform,
            source,
            status,
            report_sent,
            created_at,
            updated_at
        FROM users
        ORDER BY created_at DESC";

$result = $conn->query($sql);

$rows = [];

// عنوان ستون‌ها
$rows[] = [
    "ردیف",
    "User ID",
    "نام",
    "شماره تماس",
    "شماره درخواستی",
    "نام کاربری",
    "پلتفرم",
    "منبع",
    "وضعیت",
    "گزارش ارسال شد",
    "تاریخ ثبت",
    "آخرین بروزرسانی"
];

$i = 1;

while($user = $result->fetch_assoc()){

    $rows[] = [

        $i,

        $user["user_id"],

        $user["fullname"],

        $user["contact_number"],

        $user["desired_number"],

        $user["username"],

        $user["platform"],

        $user["source"],

        $user["status"],

        $user["report_sent"] ? "بله" : "خیر",

        $user["created_at"],

        $user["updated_at"]

    ];

    $i++;
}

$filename = "users_" . date("Y-m-d_H-i-s") . ".xlsx";

SimpleXLSXGen::fromArray($rows)->downloadAs($filename);

exit;