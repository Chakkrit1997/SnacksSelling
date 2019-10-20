<?php
require 'db.php';

$login_username = mysqli_real_escape_string($dbcon, $_REQUEST['username']);
$login_password = mysqli_real_escape_string($dbcon, $_REQUEST['password']);

$sult = 'snackrajamangalauniversityoftechnologylanna';
$hash_login_password = hash_hmac('sha256', $login_password, $sult);

$date = date("Y-m-d H:i:s"); 

$sql = "SELECT * FROM tb_login WHERE login_username=? AND login_password=?";
$stmt = mysqli_prepare($dbcon, $sql);
mysqli_stmt_bind_param($stmt, "ss", $login_username, $hash_login_password);
mysqli_execute($stmt);
$result_user = mysqli_stmt_get_result($stmt);

if ($result_user->num_rows == 1) {
    session_start();
    $row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC);
    $_SESSION['id'] = $row_user['login_id'];
    $_SESSION['status'] = $row_user["login_status"];

    if ($_SESSION["status"] == "user") {
        header("Location: user_index.php");
    }

    if ($_SESSION["status"] == "admin") {
        header("Location: admin_index.php");
    }


} else {
    
    echo "<script type='text/javascript'>";
    echo "alert('ล็อคอินไม่สำเร็จ ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง!');";
    echo "window.location = 'form.php'; ";
    echo "</script>";
        //echo "รหัสผู้ใช้หรือหรัสผ่านไม่ถูกต้อง";
}
