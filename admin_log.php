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
    <title>Admin log</title>
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
        <div class="col-md-12 text-center">
            <div class="row collections">
                <br>
                <div class="mt-2">
                    <h3>ประวัติการเพิ่มรายการสินค้า</h3>
                </div>
                <?php
                include('db.php');
                ?>
                <br><br>
                <table id="" class="table table-bordered table-striped">
                    <?php
                    $query = mysqli_query($dbcon, "SELECT * FROM logs ORDER BY date DESC") or die(mysqli_connect_error());
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo $row['action'] . " แล้ว เมื่อ " . $row['date']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</body>

</html>