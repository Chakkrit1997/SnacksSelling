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
        <h2>Purchased Product Information</h2>
        <hr color="orange">
        <a href='admin_productinfo.php' class='btn btn-warning btn-round'>Back to Index</a>
        <br>
        <div class="col-md-12">
            <?php
            if (isset($_POST['update'])) {
                $id = $_POST['prod_id'];
                $prod_name = $_POST['prod_name'];
                $prod_desc = $_POST['prod_desc'];
                $prod_qty = $_POST['prod_qty'];
                $prod_cost = $_POST['prod_cost'];
                $prod_price = $_POST['prod_price'];
                $category = $_POST['category'];

                // move_uploaded_file($_FILES["prod_pic1"]["tmp_name"], "uploads/" . $_FILES["prod_pic1"]["name"]);
                // $prod_pic1 = $_FILES["prod_pic1"]["name"];

                // checking empty fields
                if (
                    empty($prod_name) || empty($prod_desc) || empty($prod_qty) || empty($prod_cost) || empty($prod_price)
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
                } else {

                    $query = "UPDATE products SET prod_name='$prod_name', prod_desc='$prod_desc', category='$category',
                                prod_qty='$prod_qty', prod_cost='$prod_cost', prod_price='$prod_price' WHERE prod_id=$id";

                    $result = mysqli_query($dbcon, $query) or die(mysqli_connect_error($dbcon));

                    if ($result) {
                        //redirecting to the display page.
                        echo "เแก้ไข ขนมสำเร็จ!";
                        header("Location: admin_productinfo.php");
                    }
                }
            }

            ?>

            <?php
            //getting id from url
            $id = isset($_GET['prod_id']) ? $_GET['prod_id'] : die('ERROR: Record ID not found.');
            //selecting data associated with this particular id
            $result = mysqli_query($dbcon, "SELECT * FROM products WHERE prod_id=$id");
            while ($res = mysqli_fetch_array($result)) {
                $prod_name = $res['prod_name'];
                $prod_desc = $res['prod_desc'];
                $prod_qty = $res['prod_qty'];
                $prod_cost = $res['prod_cost'];
                $prod_price = $res['prod_price'];
                $category = $res['category'];
                $prod_pic = $res['prod_pic1'];
            }
            ?>



            <div class="panel panel-success panel-size-custom">
                <div class="panel-heading">
                    <h3>Update Products</h3>
                </div>


                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form group">
                            <div class="form group">
                                <button type="submit" class="btn btn-success btn-round" id="submit" name="update">
                                    <i class="now-ui-icons ui-1_check"></i> บันทึก ข้อมูลสินค้า
                                </button>
                            </div>
                            <div class="text-center">
                                <img src="uploads/<?php echo $prod_pic; ?> " width="300px" height="300px">
                            </div>
                            <input type="hidden" class="form-control" id="prod_id" name="prod_id" value=<?php echo $_GET['prod_id']; ?>>
                            <label for="prod_name">Product Name :</label>
                            <input type="text" class="form-control" id="prod_name" name="prod_name" placeholder="Product Name" value="<?php echo $prod_name; ?>" />
                            <label for="prod_desc">Product Description :</label>
                            <input type="text" class="form-control" id="prod_desc" name="prod_desc" placeholder="Product Description" value="<?php echo $prod_desc; ?>" />
                            <label for="prod_cost">Product Cost :</label>
                            <input type="text" class="form-control" id="prod_cost" name="prod_cost" placeholder="" value="<?php echo $prod_cost; ?>" />
                            <label for="prod_price">Product Price :</label>
                            <input type="text" class="form-control" id="prod_price" name="prod_price" placeholder="" value="<?php echo $prod_price; ?>" />
                            <label for="prod_qty">Quantity:</label>
                            <input type="text" class="form-control" id="prod_qty" name="prod_qty" placeholder="" value="<?php echo $prod_qty; ?>" />
                            <label for="category">Category:</label>
                            <div class="input-group">
                                <select class="form-control" id="category" name="category" required>
                                    <?php
                                    include('db.php');
                                    $query = mysqli_query($dbcon, "SELECT cat_title FROM categories ORDER BY cat_title ASC") or die(mysqli_connect_error());
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <option value="<?php echo $row['cat_title']; ?>"><?php echo $row['cat_title']; ?></option>
                                    <?php } ?>
                                </select>
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