<?php
include 'db.php';
$id = $_GET['prod_id'];

printf($id);
$query ="DELETE FROM products WHERE prod_id=$id";
$result = mysqli_query($dbcon, $query);
header("Location:admin_productinfo.php");
