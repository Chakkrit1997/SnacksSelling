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
                <h3>รายละเอียดสินค้า</h3>
            </div>
        </div>
        <a class="btn btn-success btn-round" href="product_add.php"><i class="now-ui-icons ui-1_simple-add"></i> เพิ่มสินค้า </a>
        <br>

        <?php
        $action = isset($_GET['action']) ? $_GET['action'] : "";
        if ($action == 'deleted') {
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }
        $query = "SELECT * FROM products ORDER BY prod_id DESC";
        $result = mysqli_query($dbcon, $query);
        ?>
        <br>
        <br>
        <table id="" class="table table-condensed table-striped">
            <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>รายละเอียดสินค้า</th>
                <th>ราคาต้นทุน(บาท)</th>
                <th>ราคาขาย(บาท)</th>
                <th>จำนวนสินค้าคงเหลือ</th>
                <th>ประเภทสินค้า</th>
                <th>ผู้ผลิต</th>
                <th>ตัวเลือก</th>
            </tr>
            <?php
            if ($result) {
                while ($res = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $res['prod_id'] . "</td>";
                    echo "<td>" . $res['prod_name'] . "</td>";
                    echo "<td>" . $res['prod_desc'] . "</td>";
                    echo "<td>" . $res['prod_cost'] . "</td>";
                    echo "<td>" . $res['prod_price'] . "</td>";

                    $prod_qty = $res['prod_qty'];

                    if ($prod_qty <= 9) {
                        ?>
                        <td><span style="color:red;"><?php echo $res['prod_qty']; ?> : Reorder!</span></td>
                    <?php
                            } else {
                                ?>
                        <td><?php echo $res['prod_qty']; ?></td>
                        </ul>
            <?php }

                    echo "<td>" . $res['category'] . "</td>";
                    echo "<td>" . $res['supplier'] . "</td>";
                    // echo '<td class="text-center">
                    //         <a class="btn btn-outline-warning shadow-sm btn-md mb-2" href="product_update.php?prod_id='.$res['prod_id'].'" class="btn" >Edit</a>
                    //         <a class="btn btn-outline-danger shadow-sm btn-md" href="product_delete.php?prod_id='.$res['prod_id'].'" >Delete</a>
                    //     </tr>';
                    echo "<td class=\"text-center\">
                            <a class=\"btn btn-outline-warning shadow-sm btn-md mb-2\" href=\"product_update.php?prod_id=$res[prod_id]\" >แก้ไข</a>
                            <a class=\"btn btn-outline-danger shadow-sm btn-md\" href=\"product_delete.php?prod_id=$res[prod_id]\" onClick=\"return confirm('คุณแน่ใจที่ต้องการลบรายการสินค้านี้ ?')\">ลบ</a>
                        </tr>";
                }
            } ?>
        </table>
    </div>
</body>