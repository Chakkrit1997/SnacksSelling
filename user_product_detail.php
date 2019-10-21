<?php
include 'db.php';
session_start();
if ($_SESSION["status"] !== "user") {
    header("Location: user_login_page.php");
}
?>

<?php

include('db.php');
$prod_id = $_GET['prod_id'];
$query = "SELECT * FROM products WHERE prod_id='$prod_id'";
$result = mysqli_query($dbcon, $query);
while ($res = mysqli_fetch_array($result)) {
    $prod_id = $res['prod_id'];
    $prod_price = $res['prod_price'];
    $user_id = $_SESSION['id'];

    if (isset($_POST['submit'])) {
        $prod_id = $prod_id;
        $prod_price = $prod_price;
        $prod_qty = $_POST['prod_qty'];
        $total = $prod_price * $prod_qty;
        $user_id = $user_id;
        $date = date("Y-m-d");

        if (empty($prod_qty)) {
            if (empty($prod_qty)) {
                echo "<br><center><h4><font color='red'><b>Error!</b> Enter Product Quantity.</font></h4></center>";
            }
        } else {
            mysqli_query($dbcon, "INSERT INTO order_details (prod_id,prod_qty,total,login_id) VALUES ('$prod_id','$prod_qty','$total','$user_id')") or die(mysql_error());
            ?>
            <script type="text/javascript">
                alert("เพิ่มสินค้าลงตระกร้าแล้ว!");
                window.location = "user_index.php";
            </script>
<?php
        }
    }
} ?>

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
    <div class="wrapper">
        <br>
        <div class="main">
            <div class="section section-basic">

                <div class="section" id="carousel">
                    <div class="container">
                        <h2>รายละเอียดสินค้า</h2>
                        <a class="btn btn-primary btn-round" href="user_index.php"><i class="now-ui-icons arrows-1_minimal-left"></i> &nbsp กลับสู่หน้าหลัก</a>
                        <hr color="orange">
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-8">
                                    <?php
                                    include('db.php');
                                    $prod_id = $_GET['prod_id'];
                                    $query = "SELECT * FROM products WHERE prod_id='$prod_id'";
                                    $result = mysqli_query($dbcon, $query);
                                    while ($res = mysqli_fetch_array($result)) {
                                        //getting product id
                                        ?>
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
                                            </ol>
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <?php if ($res['prod_pic1'] != "") : ?>
                                                        <img class="d-block" src="uploads/<?php echo $res['prod_pic1']; ?>" alt="First slide">
                                                    <?php else : ?>
                                                        <img src="uploads/default.png">
                                                    <?php endif; ?>
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h5><?php echo $res['prod_name']; ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                <i class="now-ui-icons arrows-1_minimal-left"></i>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                <i class="now-ui-icons arrows-1_minimal-right"></i>
                                            </a> -->
                                        </div>
                                </div>
                            </div>
                        </div>

                        <h4><br><br>

                            <ul><b>ชื่อสินค้า : </b>
                                <?php echo $res['prod_name']; ?>
                            </ul>
                            <ul><b>รายละเอียดสินค้า : </b>
                                <?php echo $res['prod_desc']; ?>
                            </ul>
                            <ul><b>ประเภท : </b>
                                <?php echo $res['category']; ?>
                            </ul>
                            <ul><b>ราคา : </b>
                                <?php echo  $res['prod_price'] . ' บาท'; ?>
                            </ul>
                            <ul>
                                <?php $prod_qty = $res['prod_qty']; ?>
                                <?php
                                    if ($prod_qty <= 0) {
                                        ?>
                                    <span style="color:red;">สินค้าหมด!</span>
                                <?php
                                    } else {
                                        ?>
                                    <b>สินค้าคงเหลือ : </b><?php echo $res['prod_qty']; ?>
                            </ul>
                        <?php
                            }
                            ?>
                    <?php } ?>

                        </h4>

                        <!-- Button trigger modal -->
                        <div class="form-group">
                            <button class="btn btn-success btn-round pull-right" data-toggle="modal" data-target="#myModal">เพิ่มลงตระกร้า</button>
                        </div>


                        <!-- Modal Core -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form group">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">.จำนวนสินค้า:</h4>
                                            </div>
                                            <div class="modal-body">
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

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">ยกเลิก</button>
                                                <a><button type="submit" name="submit" class="btn btn-success btn-round">เพิ่ม</button></a>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="src/js/jquery-3.3.1.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>

</body>

</html>