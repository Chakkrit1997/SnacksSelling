<?php
include 'db.php';
session_start();
if ($_SESSION["status"] !== "user") {
  header("Location: user_login_page.php");
}

if(isset($_GET['itemname'])){
    $word= $_GET['itemname'];
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

  <br>
  <div class="main">
    <div class="section section-basic">
      <div class="container">
        <br>
        <div class="col-md-12">
          <h2 class="title">รายการสินค้า</h2>
          <div>
            <form action="" class="form-inline" name="searchform" id="searchform" method="get">
              <div class="form-group">
                <label for="textsearch">ชื่อสินค้า</label>
                <input type="text" name="itemname" id="itemname" class="form-control ml-2 mr-2" placeholder="ข้อความ คำค้นหา!" autocomplete="off">
              </div>
              <button type="submit" class="btn btn-primary" id="btnSearch">
                ค้นหา
              </button>
            </form>
          </div>


          <div class="typography-line">
            <p>
              <h5>ช้อปปิ้งออนไลน์ ขนมราคาพิเศษ ที่ Snacks Selling Online โปรโมชั่นพิเศษ พร้อมบริการจัดส่งสินค้า</h5>
            </p>
          </div>
        </div>
        <hr color="orange">

        <div class="container">
          <div class="row">
            <?php
            $query = "SELECT * FROM products WHERE prod_name LIKE '%$word%' ORDER BY prod_id ASC";
            $result = mysqli_query($dbcon, $query);
            while ($res = mysqli_fetch_array($result)) {
              $prod_id = $res['prod_id'];
              ?>
              <div class="col-sm-3 mb-5">
                <div class="thumbnail">
                  <?php if ($res['prod_pic1'] != "") : ?>
                    <img src="uploads/<?php echo $res['prod_pic1']; ?> " width="300px" height="300px">
                  <?php else : ?>
                    <img src="uploads/default.png" width="300px" height="200px">
                  <?php endif; ?>

                  <div class="caption text-center">
                    <h5><b><?php echo $res['prod_name']; ?></b> <b><?php echo "$res[prod_price] บาท" ?></b></h5>
                  </div>
                  <div class="text-center">
                    <a class="btn btn-success btn-round mr-2" title="Click for more details!" href="user_product_detail.php?prod_id=<?php echo $res['prod_id']; ?>">ดูรายละเอียดสินค้า</a>
                  </div>

                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center mt-2">
    <footer class="footer">
      <div class="container">
        <div class="copyright align-right">
          <a href="">&copy;
            <script>
              document.write(new Date().getFullYear())
            </script>,</a> Designed and Coded by Chakkrit Tha-aphai, Pongsakorn Pitakkanitkul, Wuttipong Sootlek, Boonrit Duanghirunphuckdee
        </div>
      </div>
    </footer>
  </div>
  </div>

</body>

</html>