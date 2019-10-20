<?php
include 'db.php';

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
            if (isset($_POST['submit'])) {
                $prod_name = $_POST['prod_name'];
                $prod_desc = $_POST['prod_desc'];
                $prod_qty = $_POST['prod_qty'];
                $prod_cost = $_POST['prod_cost'];
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

                    $query = "INSERT INTO products (prod_name, prod_desc, prod_qty, prod_cost, prod_price, prod_pic1) 
         VALUES ('$prod_name','$prod_desc','$prod_qty','$prod_cost','$prod_price','$prod_pic1')";

                    $result = mysqli_query($dbcon, $query);

                    if ($result) {

                        $prod_name = $_POST['prod_name'];
                        $prod_qty = $_POST['prod_qty'];

                        date_default_timezone_set('Asia/Bangkok');

                        $date = date("Y-m-d H:i:s");
                        //$id = $_SESSION['id'];

                        $query = mysqli_query($dbcon, "SELECT prod_name FROM products WHERE prod_id='$prod_name'") or die(mysqli_error($dbcon));

                        $row = mysqli_fetch_array($query);
                        $product = $row['prod_name'];
                        $remarks = "added a new product $prod_qty of $prod_name";

                        //mysqli_query($dbcon, "INSERT INTO logs (user_id,action,date) VALUES ('$id','$remarks','$date')") or die(mysqli_error($dbcon));

                        //redirecting to the display page.
                        echo "เพิ่มขนมสำเร็จ";
                        header("Location: admin_productinfo.php");
                    }
                }
            }

            ?>



            <div class="panel panel-success panel-size-custom">
                <div class="panel-heading">
                    <h3>Add Purchased Products</h3>
                </div>


                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form group">
                            <div class="form group">
                                <button type="submit" class="btn btn-success btn-round" id="submit" name="submit">
                                    <i class="now-ui-icons ui-1_check"></i> Add Product
                                </button>
                            </div>
                            <label for="prod_name">Product Name :</label>
                            <input type="text" class="form-control" id="prod_name" name="prod_name" placeholder="Product Name" />
                            <label for="prod_desc">Product Description :</label>
                            <input type="text" class="form-control" id="prod_desc" name="prod_desc" placeholder="Product Description" />
                            <label for="prod_cost">Product Cost :</label>
                            <input type="text" class="form-control" id="prod_cost" name="prod_cost" placeholder="" />
                            <label for="prod_price">Product Price :</label>
                            <input type="text" class="form-control" id="prod_price" name="prod_price" placeholder="" />
                            <label for="prod_qty">Quantity:</label>
                            <input type="text" class="form-control" id="prod_qty" name="prod_qty" placeholder="" />
                            <label for="prod_pic1">Picture 1 :</label>
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