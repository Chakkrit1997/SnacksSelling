<?php
include 'db.php';
session_start();
if ($_SESSION["status"] !== "admin") {
    header("Location: user_login_page.php");
}


if (isset($_POST['track_num'])) {
    $track = $_POST['track_num'];
    $status = $_POST['category'];
    $query = "UPDATE order2 SET statuss='$status' WHERE track_num=$track";
    $result = mysqli_query($dbcon, $query) or die(mysqli_connect_error($dbcon));
    if ($result) {
        //redirecting to the display page.
        echo "อัพเดทสถานะการส่ง สำเร็จ!";
        header("Location: admin_check.php");
    }
}
