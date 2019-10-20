<?php

$dbcon = mysqli_connect("localhost","root","","snack") or die("ไม่สามารถติดต่อฐานข้อมูลได้" .mysqli_connect_error());
mysqli_set_charset($dbcon,'utf8');
date_default_timezone_set("Asia/Bangkok"); 
//$result = mysqli_query($dbcon,$sql);
//echo "ติดต่อสำเร็จ";
?>