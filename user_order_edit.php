<?php
include 'db.php';
session_start();
if ($_SESSION["status"] !== "user") {
    header("Location: user_login_page.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="src/css/bootstrap.min.css">

    <!-- Google Fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="src/css/style.css">
</head>

<body>
    <div class="container">
        <h2> <?php
                include('db.php');
                $query = mysqli_query($dbcon, "SELECT * FROM `tb_login` WHERE login_id='" . $_SESSION['id'] . "'");
                $row = mysqli_fetch_array($query);
                $cid = $row['login_id'];
                ?>รายการสินค้าของ
                <?
                echo $row['firstname'];
                ?>
        </h2>
        <a class="btn btn-primary btn-round" href="user_index.php"><i class="now-ui-icons shopping_basket"></i> &nbsp ซื้อสินค้าเพิ่ม</a>
        <hr color="orange">

        <div class="col-md-12">
            <br>
            <div class="panel panel-success panel-size-custom">
                <div class="panel-body">
                    <?php
                    $user_id = $_SESSION['id'];

                    $query3 = mysqli_query($dbcon, "SELECT * FROM order_details WHERE login_id='$user_id' AND order_id=''") or die(mysql_error());
                    $count2 = mysqli_num_rows($query3);
                    ?>
                    <?php
                    if (isset($_POST['submit'])) {

                        $order_id = $_GET['order_id'];
                        $prod_qty = $_POST['prod_qty'];
                        $total = $_POST['prod_qty'] * $_POST['total'];

                        date_default_timezone_set('Asia/Bangkok');
                        $date = date("Y-m-d H:i:s");

                        mysqli_query($dbcon, "UPDATE order_details SET prod_qty='$prod_qty',total='$total' WHERE order_details_id='$order_id'")
                            or die(mysqli_connect_error());
                        ?>

                        <script type="text/javascript">
                            alert("เพิ่มรายการสินค้าแล้ว");
                            window.location = "user_cart.php";
                        </script>
                    <?php
                    }
                    ?>
                    <form method="post">
                        
                        <button type="submit" name="submit" class="btn btn-success btn-round">ตกลง</button>
                        <a href="user_cart.php" class="btn btn-large btn-danger"><i class="icon-arrow-left"></i> ยกเลิก </a>
                        <table class="table table-bordered table-condensed mt-2">
                            <thead>
                                <tr>
                                    <th>สินค้า</th>
                                    <th>รายละเอียดสินค้า</th>
                                    <th width="100">จำนวน</th>
                                    <th width="100">ราคา(บาท)</th>
                                    <th width="100">รวม(บาท)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_SESSION['id'];
                                $order_id = $_GET['order_id'];

                                $query = mysqli_query($dbcon, "SELECT * FROM order_details WHERE order_details_id='$order_id'") or die(mysqli_connect_error());
                                $row = mysqli_fetch_array($query);
                                $count = mysqli_num_rows($query);
                                $prod_id = $row['prod_id'];
                                $query2 = mysqli_query($dbcon, "SELECT * FROM products WHERE prod_id='$prod_id'") or die(mysqli_conncet_error());
                                $row2 = mysqli_fetch_array($query2);
                                $prod_qty = $row2['prod_qty'];
                                ?>
                                <tr>
                                    <td> <img width="100" height="100" src="uploads/<?php echo $row2['prod_pic1']; ?>" alt="" /></td>
                                    <td><b><?php echo $row2['prod_name']; ?></b><br><br>
                                        <?php $string = $row2['prod_desc']; ?></td>
                                    <td>
                                        <div class="input-append">
                                            <?php
                                            echo "<select class='btn btn-warning btn-round dropdown-toggle' size='1' name='prod_qty' id='prod_qty'>";
                                            $i = 1;
                                            $prod_qty = $prod_qty;
                                            while ($i <= $prod_qty) {
                                                echo "<option value=" . $i . ">" . $i . "</option>";
                                                $i++;
                                            }
                                            echo "</select>";
                                            ?>

                                        </div>
                                    </td>
                                    <td><?php echo $row2['prod_price']; ?></td>
                                    <td><?php echo $row['total']; ?></td>
                                    <input type="hidden" name="total" value="<?php echo $row2['prod_price']; ?>">
                                </tr>
                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
        </div>
    </div>





</body>

</html>