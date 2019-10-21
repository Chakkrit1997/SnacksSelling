<?php
include 'db.php';
session_start();
if ($_SESSION["status"] !== "admin") {
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
        <ul class="nav justify-content-center mt-5">
            <li>
                <input type="button" class="btn btn-outline-success mx-3 btn-sm" value="รายการสินค้า" onclick="window.location.href='admin_index.php'">
            </li>
            <li>
                <input type="button" class="btn btn-outline-primary float-right mx-3 btn-sm" value="รายละเอียดสินค้า" onclick="window.location.href='admin_productinfo.php'">
            </li>
            <li>
                <input type="button" class="btn btn-outline-primary float-right mx-3 btn-sm" value="รายการสั่งซื้อลูกค้า" onclick="window.location.href='admin_check.php'">
            </li>
            <li>
                <input type="button" class="btn btn-outline-primary float-right mx-3 btn-sm" value="ประวัติการเพิ่มรายการสินค้า" onclick="window.location.href='admin_log.php'">
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
            <a class="btn btn-danger btn-round" href="admin_check.php"><i class="now-ui-icons ui-1_simple-add"></i> กลับ </a>
        </div>

        <div>
            <label for="category">อัพเดทสถานะ :</label>

            <form action="admin_check_status.php" method="post">
                <input type="hidden" id="track_num" name="track_num" value="<?php echo "$_GET[track_num]"; ?>">
                <div class="input-group">
                    <select class="form-control " id="category" name="category" required>
                        <?php
                        include('db.php');
                        $query = mysqli_query($dbcon, "SELECT status_title FROM status ") or die(mysqli_connect_error());
                        while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <option value="<?php echo $row['status_title']; ?>"><?php echo $row['status_title']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-round mt-2" id="submit">
                    <i class="now-ui-icons ui-1_check"></i> บันทึก สถานะการส่งสินค้า
                </button>
            </form>
        </div>



        <?php

        $action = isset($_GET['action']) ? $_GET['action'] : "";
        if ($action == 'deleted') {
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }


        ?>

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