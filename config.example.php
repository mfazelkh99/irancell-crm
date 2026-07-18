<?php

$db_host = "localhost";
$db_user = "your_username";
$db_pass = "your_password";
$db_name = "your_database";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("اتصال به دیتابیس برقرار نشد: " . $conn->connect_error);    die("Database connection failed.");
}

$conn->set_charset("utf8mb4");

define("BOT_TOKEN", "YOUR_BOT_TOKEN");
define("ADMIN_CHAT_ID", "YOUR_CHAT_ID");
define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "password");