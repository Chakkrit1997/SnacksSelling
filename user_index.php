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
        <input type="button" class="btn btn-outline-success float-right mx-3 btn-sm" value="Product" onclick="window.location.href='user_index.php'">
      </li>
      <li>
        <input type="button" class="btn btn-outline-primary float-right mx-3 btn-sm" value="Cart" onclick="window.location.href='user_cart.php'">
      </li>
      <li>
        <input type="button" class="btn btn-outline-primary float-right mx-3 btn-sm" value="User Order Detail" onclick="window.location.href='admin_order_detail.php'">
      </li>
      <li class="nav-item">
        <input type="button" class="btn btn-outline-danger float-right mx-3 btn-sm" value="Logout" onclick="window.location.href='logout.php'">
      </li>
    </ul>


  </div>

  <br>
  <div class="main">
    <div class="section section-basic">
      <div class="container">
        <br>
        <div class="col-md-12">
          <h2 class="title">Products</h2>
          <div class="typography-line">
            <p>
              ช้อปปิ้งออนไลน์ ขนมราคาพิเศษ ที่ Snacks Selling Online โปรโมชั่นพิเศษ พร้อมบริการจัดส่งสินค้า
            </p>
          </div>
        </div>
        <hr color="orange">

        <div class="container">
          <div class="row">
            <?php
            $query = "SELECT * FROM products ORDER BY prod_id ASC";
            $result = mysqli_query($dbcon, $query);
            while ($res = mysqli_fetch_array($result)) {
              $prod_id = $res['prod_id'];
              ?>
              <div class="col-sm-3">
                <div class="thumbnail">
                  <?php if ($res['prod_pic1'] != "") : ?>
                    <img src="uploads/<?php echo $res['prod_pic1']; ?> " width="300px" height="300px">
                  <?php else : ?>
                    <img src="uploads/default.png" width="300px" height="200px">
                  <?php endif; ?>

                  <div class="caption text-center">
                    <h5><b><?php echo $res['prod_name']; ?></b> <b><?php echo $res['prod_price']; ?></b></h5>
                    <h6><a class="btn btn-success btn-round" title="Click for more details!" href="user_product_detail.php?prod_id=<?php echo $res['prod_id']; ?>"><i class="now-ui-icons gestures_tap-01"></i>View</a>
                  </div>

                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer" data-background-color="black">
    <div class="container">
      <nav>
        <ul>
          <li>Brought To You By <a href="https://code-projects.org/">code-projects</a> | Thanks to Billy Revellame</li>
        </ul>
      </nav>
      <div class="copyright">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, Designed and Coded by Serve(8) Web Solutions, Inc.
      </div>
    </div>
  </footer>
  </div>

</body>

</html>