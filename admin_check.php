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

        <?php
        $action = isset($_GET['action']) ? $_GET['action'] : "";
        if ($action == 'deleted') {
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }
        $id = $_SESSION['id'];
        $query = "SELECT * FROM order2  ORDER BY order_id DESC";
        $result = mysqli_query($dbcon, $query);
        ?>

        <br>
        <br>
        <table class="table table-condensed table-striped">
            <tr>
                <th>หมายเลขออเดอร์</th>
                <th>หมายเลขคำสั่งซื้อ</th>
                <th>ส่งไปยัง ที่อยู่</th>
                <th>ชื่อ นามสกุล</th>
                <th>เวลา</th>
                <th>สถานะการสั่งซื้อ</th>

            </tr>
            <?php
            if ($result) {
                while ($res = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $res['order_id'] . "</td>";
                    echo "<td>" . $res['track_num'] . "</td>";
                    echo "<td>" . $res['shipping_add'] . "</td>";
                    echo "<td>" . $res['firstname'] . "  " . $res['lastname'] . "</td>";
                    echo "<td>" . $res['order_date'] . "</td>";
                    echo "<td>" . $res['statuss'] . "<a class=\"btn btn-outline-primary shadow-sm btn-md ml-2\" href=\"admin_check2.php?track_num=$res[track_num]\" >ดู</a></td>";
                    $prod_qty = $res['order_id'];

                    // echo "<td>" . $res['category'] . "</td>";
                    // echo "<td>" . $res['supplier'] . "</td>";
                    // echo "<td class=\"text-center\">
                    //         <a class=\"btn btn-outline-warning shadow-sm btn-md mb-2\" href=\"product_update.php?prod_id=$res[prod_id]\" >แก้ไข</a>
                    //         <a class=\"btn btn-outline-danger shadow-sm btn-md\" href=\"product_delete.php?prod_id=$res[prod_id]\" onClick=\"return confirm('คุณแน่ใจที่ต้องการลบรายการสินค้านี้ ?')\">ลบ</a>
                    //     </tr>";
                }
            }

            ?>

        </table>


    </div>
</body>