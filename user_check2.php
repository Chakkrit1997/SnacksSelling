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
    <title>Welcome to Snacks Selling</title>

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
        <ul class="nav justify-content-center mt-5">
            <li>
                <input type="button" class="btn btn-outline-success float-right mx-3 btn-sm" value="รายการสินค้า" onclick="window.location.href='user_index.php'">
            </li>
            <li>
                <input type="button" class="btn btn-outline-primary float-right mx-3 btn-sm" value="ตระกร้าสินค้า" onclick="window.location.href='user_cart.php'">
            </li>
            <li>
                <input type="button" class="btn btn-outline-primary float-right mx-3 btn-sm" value="สถานะการสั่งซื้อ" onclick="window.location.href='user_check.php'">
            </li>
            <li class="nav-item">
                <input type="button" class="btn btn-outline-danger float-right mx-3 btn-sm" value="ออกจากระบบ" onclick="window.location.href='logout.php'">
            </li>
        </ul>


    </div>
    <div class="container">

        <div class="row">
            <div>
                <h3>สถานะการสั่งซื้อ</h3>
            </div>
        </div>
        <?
        $track_num = $_GET['track_num'];

        ?>
        <div>
            <a class="btn btn-danger btn-round" href="user_check.php"><i class="now-ui-icons ui-1_simple-add"></i> กลับ </a>
        </div>

        <br>
        <br>
        <table class="table table-condensed table-striped">
            <tr>
                <th>สินค้า</th>
                <th>รายละเอียดสินค้า</th>
                <th>จำนวน</th>
                <th>ราคา</th>

            </tr>

            <?php
            $track_num = $_GET['track_num'];
            $id = $_SESSION['id'];
            $query = "SELECT * FROM order_details INNER JOIN products ON order_details.prod_id = products.prod_id WHERE track_num='$track_num'";
            $result = mysqli_query($dbcon, $query);
            if ($result) {
                while ($res = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td> <img width="150" height="150" src="uploads/<?php echo $res['prod_pic1']; ?>" alt="" /> </td>
                        <td><b><?php echo $res['prod_name']; ?></b><br><br>
                            <?php echo $res['prod_desc'];
                                    ?>
                        </td>
                        <td> <?php echo $res['prod_qty']; ?> </td>
                        <td> <?php echo $res['prod_price'] ?> </td>
                <?php }
                }

                ?>




        </table>
    </div>

</body>

</html>