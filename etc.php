<?php

include('dbcon.php');
$prod_id = $_GET['prod_id'];
$query = "SELECT * FROM products WHERE prod_id='$prod_id'";
$result = mysqli_query($dbconn, $query);
while ($res = mysqli_fetch_array($result)) {
    $prod_id = $res['prod_id'];
    $prod_price = $res['prod_price'];
    $user_id = $_SESSION['id'];

    if (isset($_POST['submit'])) {
        $prod_id = $prod_id;
        $prod_price = $prod_price;
        $prod_qty = $_POST['prod_qty'];
        $total = $prod_price * $_POST['prod_qty'];
        $user_id = $user_id;
        $date = date("Y-m-d");

        if (empty($prod_qty)) {
            if (empty($prod_qty)) {
                echo "<br><center><h4><font color='red'><b>Error!</b> Enter Product Quantity.</font></h4></center>";
            }
        } else {
            mysqli_query($dbconn, "INSERT INTO order_details (prod_id,prod_qty,total,user_id) VALUES ('$prod_id','$prod_qty','$total','$user_id')") or die(mysql_error());
            ?>
            <script type="text/javascript">
                alert("Product Added To Cart!");
                window.location = "user_cart.php";
            </script>
<?php
        }
    }
} ?>