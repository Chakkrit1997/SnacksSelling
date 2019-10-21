<?php
include 'db.php';
session_start();
if ($_SESSION["status"] !== "user") {
    header("Location: user_login_page.php");
}else{
    header("Location: user_login_page.php");
}
