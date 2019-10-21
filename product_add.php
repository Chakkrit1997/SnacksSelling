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
    <div class="container mt-5 ">
        <h2>เพิ่มรายการสินค้า</h2>
        <hr color="orange">
        <a href='admin_productinfo.php' class='btn btn-warning btn-round'>กลับสู่หน้าหลัก</a>
        <br>
        <div class="col-md-12">
            <?php
            if (isset($_POST['submit'])) {
                //$id = $_POST['id'];
                $prod_name = $_POST['prod_name'];
                $prod_desc = $_POST['prod_desc'];
                $prod_qty = $_POST['prod_qty'];
                $prod_cost = $_POST['prod_cost'];
                $category = $_POST['category'];
                $prod_price = $_POST['prod_price'];

                move_uploaded_file($_FILES["prod_pic1"]["tmp_name"], "uploads/" . $_FILES["prod_pic1"]["name"]);
                $prod_pic1 = $_FILES["prod_pic1"]["name"];

                // checking empty fields
                if (
                    empty($prod_name) || empty($prod_desc) || empty($prod_qty) || empty($prod_cost) || empty($prod_price)
                    || empty($prod_pic1)
                ) {

                    if (empty($prod_name)) {
                        echo "<font color='red'>Product name field is empty!</font><br/>";
                    }

                    if (empty($prod_desc)) {
                        echo "<font color='red'>Product description field is empty!</font><br/>";
                    }

                    if (empty($prod_qty)) {
                        echo "<font color='red'>Quantity field is empty!</font><br/>";
                    }

                    if (empty($prod_price)) {
                        echo "<font color='red'>Product price field is empty!</font><br/>";
                    }

                    if (empty($prod_pic1)) {
                        echo "<font color='red'>Picture1 field is empty!</font><br/>";
                    }
                } else {

                    $query = "INSERT INTO products (prod_name, prod_desc, prod_qty, prod_cost, prod_price, prod_pic1, category) 
         VALUES ('$prod_name','$prod_desc','$prod_qty','$prod_cost','$prod_price','$prod_pic1', '$category')";

                    $result = mysqli_query($dbcon, $query);

                    if ($result) {

                        $prod_name = $_POST['prod_name'];
                        $prod_qty = $_POST['prod_qty'];

                        date_default_timezone_set('Asia/Bangkok');

                        $date = date("Y-m-d H:i:s");

                        $query = mysqli_query($dbcon, "SELECT prod_name FROM products WHERE prod_id='$prod_name'") or die(mysqli_error($dbcon));

                        $row = mysqli_fetch_array($query);
                        $product = $row['prod_name'];
                        $username = $_SESSION['username'];
                        $id = $_SESSION['id'];
                        $remarks = "$username ได้ทำการเพิ่มสินค้าใหม่ชื่อว่า [$prod_name] จำนวน ($prod_qty)";

                        mysqli_query($dbcon, "INSERT INTO logs (login_id,action,date) VALUES ('$id','$remarks','$date')") or die(mysqli_error($dbcon));

                        //redirecting to the display page.
                        echo "เพิ่มขนมสำเร็จ";
                        header("Location: admin_productinfo.php");
                    }
                }
            }

            ?>



            <div class="panel panel-success panel-size-custom">
                <div class="panel-heading mt-2">
                   
                </div>


                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form group">
                            <div class="form group">
                                <button type="submit" class="btn btn-success btn-round" id="submit" name="submit">
                                    <i class="now-ui-icons ui-1_check"></i> เพิ่มสินค้า
                                </button>
                            </div>
                            <label for="prod_name">ชื่อสินค้า :</label>
                            <input type="text" class="form-control" id="prod_name" name="prod_name" placeholder="ขนม" />
                            <label for="prod_desc">รายละเอียดสินค้า :</label>
                            <input type="text" class="form-control" id="prod_desc" name="prod_desc" placeholder="ขนมอร่อยมาก" />
                            <label for="prod_cost">ราคาต้นทุน :</label>
                            <input type="text" class="form-control" id="prod_cost" name="prod_cost" placeholder="5,000" />
                            <label for="prod_price">ราคาขาย :</label>
                            <input type="text" class="form-control" id="prod_price" name="prod_price" placeholder="50,000" />
                            <label for="prod_qty">จำนวน :</label>
                            <input type="text" class="form-control" id="prod_qty" name="prod_qty" placeholder="1,000,000" />
                            <label for="category">ประเภท :</label>
                            <div class="input-group">
                                <select class="form-control" id="category" name="category" required>
                                    <?php
                                    include('db.php');
                                    $query = mysqli_query($dbcon, "SELECT cat_title FROM categories ORDER BY cat_title ASC") or die(mysqli_error($dbcon));
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <option value="<?php echo $row['cat_title']; ?>"><?php echo $row['cat_title']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            
                            <label for="prod_pic1">เพิ่มรูปสินค้า :</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="prod_pic1" name="prod_pic1">
                            </div>
                        </div>
                        <br>


                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>



</body>

</html>