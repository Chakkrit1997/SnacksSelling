<?php
session_start();
include('db.php');
session_start();
if ($_SESSION["status"] !== "user") {
  header("Location: user_login_page.php");
}

?>

<?php
$user_id = $_SESSION['id'];
$order_id = $_GET['order_id'];
$result = mysqli_query($dbcon, "DELETE FROM order_details WHERE order_details_id=$order_id");
header('location: user_cart.php');
?>
