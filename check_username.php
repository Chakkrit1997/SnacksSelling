<?php
require 'db.php';
if(isset($_POST['username'])){
    $name=$_POST['username'];
    $query="SELECT * FROM tb_login WHERE login_username='$name'";
    $result=mysqli_query($dbcon,$query);
    if($result->num_rows>0)
    {
    echo "มีผู้ใช้นี้อยู่แล้ว";
    }
    else
    {
    echo "สามารถใช้ได้";
    }
    exit();
}
