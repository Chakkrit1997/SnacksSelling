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
  <title>Payment</title>

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
  <div class="container mt-5">
    <h2> <?php
          echo $_SESSION['username'];
          ?>'s Checking Out!
    </h2>
    <hr color="orange">
    <div class="col-md-12">
      <br>
      <div class="panel panel-success panel-size-custom">
        <div class="panel-body text-center">
          <?php
          $user_id = $_SESSION['id'];

          $query = mysqli_query($dbcon, "SELECT * FROM tb_login WHERE login_id=$user_id ");
          $row = mysqli_fetch_array($query);
          //print_r($row);
          $firstname = $row['firstname'];
          $lastname = $row['lastname'];
          $email = $row['login_email'];
          // $contact = $row['contact'];



          // เลือกทั้งหมด ที่ id 122 order_id=''

          //print_r($query3);
          //echo "<br><br>";
          //$row3 = mysqli_fetch_array($query3);
          //print_r($row3);
          //echo"<br><br>";

          $query3 = mysqli_query($dbcon, "SELECT * FROM order_details WHERE login_id='$user_id' AND order_id='' ") or die(mysqli_connect_error());
          while ($res = mysqli_fetch_array($query3)) {
            $row3 = $res;
            $prod_id = $row3['prod_id']; // ไอดี สินค้า 
            $qty = $row3['prod_qty']; // จำนวน ที่ซื้อ
            $query2 = mysqli_query($dbcon, "SELECT * FROM products WHERE prod_id='$prod_id'") or die(mysqli_connect_error());
            $row2 = mysqli_fetch_array($query2);
            $prod_qty = $row2['prod_qty']; // จำนวนขนมทั้งหมด ที่ชนิดนี้ มี
            mysqli_query($dbcon, "UPDATE products SET prod_qty = prod_qty - $qty WHERE prod_id ='$prod_id' AND prod_qty='$prod_qty'");
            //อัพเดทหลัง จำนวนที่เหลือ = จำนวนทั้งหมด - จำนวนที่สั่งซื้อ
          }


          //$count = mysqli_num_rows($query3); // นับแถว แปลกๆ
          //print_r($count);
          //echo "<br><br>";


          //$prod_id = $row3['prod_id']; //printf($prod_id); // ไอดี สินค้า 
          //echo " <br><br>";
          //$qty = $row3['prod_qty']; // จำนวน ที่ซื้อ
          // printf($qty); 
          //$query2 = mysqli_query($dbcon, "SELECT * FROM products WHERE prod_id='$prod_id'") or die(mysqli_connect_error());
          //$row2 = mysqli_fetch_array($query2);

          //$prod_qty = $row2['prod_qty']; // จำนวนขนมทั้งหมด ที่ชนิดนี้ มี
          //printf($prod_qty);

          //อัพเดทหลัง จำนวนที่เหลือ = จำนวนทั้งหมด - จำนวนที่สั่งซื้อ
          //mysqli_query($dbcon, "UPDATE products SET prod_qty = prod_qty - $qty WHERE prod_id ='$prod_id' AND prod_qty='$prod_qty'");



          //ผลรวมราคา ของ ID นั้นๆ

          //print_r($cart_table);

          //
          //$cart_count = mysqli_num_rows($cart_table);
          //print_r($cart_count);
          $cart_table = mysqli_query($dbcon, "SELECT sum(total) FROM order_details WHERE login_id='$user_id' AND order_id=''") or die(mysqli_connect_error());
          while ($cart_row = mysqli_fetch_array($cart_table)) {

            $total = $cart_row['sum(total)'];
            $date = date("Y-m-d H:i:s");
            $tp = $row3['order_details_id'];

            $track_num = $user_id . $tp;
            $shipaddress = $_POST['shipaddress'];
            $ship_add = $shipaddress;
            echo 'login_id = ' . $user_id . '<br>';
            echo 'track_num = ' . $track_num . '<br>';
            echo 'ชื่อ = ' . $firstname . '<br>';
            echo 'นามสกุล = ' . $lastname . '<br>';
            echo 'อีเมลล์ = ' . $email . '<br>';
            echo 'shipping_add = ' . $ship_add . '<br>';
            echo 'order_date = ' . $date . '<br>';
            echo 'totalprice = ' . $total . '<br>';



            echo '********* หมายเลขคำสั่งซื้อของคุณ : <b>' . $track_num . '</b> ***********<br> ';
            echo '********* ทั้งหมด : ' . $total . ' บาท **************<br> ';
            echo '********* เมื่อวันที่ : ' . $date . ' **************<br> ';
            echo '********* ส่งไปที่อยู่ : ' . $ship_add . ' **************<br>';


            $query9 = "INSERT INTO order2 (login_id, track_num, firstname, lastname, email , shipping_add, order_date, statuss, totalprice) VALUES ('$user_id','$track_num','$firstname','$lastname','$email','$ship_add','$date','รอจัดส่ง','$total')";
            mysqli_query($dbcon, $query9) or die(mysqli_error($dbcon));

            mysqli_query($dbcon, "UPDATE order_details SET track_num= $track_num WHERE login_id='$user_id' AND order_id=''") or die(mysqli_connect_error());
            mysqli_query($dbcon, "UPDATE order_details SET statuss = 'รอจัดส่ง' WHERE login_id='$user_id' AND order_id=''") or die(mysqli_connect_error());
            mysqli_query($dbcon, "UPDATE order_details SET order_id = order_id+1 WHERE login_id='$user_id' AND order_id=''") or die(mysqli_connect_error());
            
            mysqli_query($dbcon, "DELETE FROM `order2` WHERE `order2`.`track_num` = $user_id") or die(mysqli_connect_error());


            //mysqli_query($dbcon, "INSERT INTO order_details(track_num) VALUES ('$track_num') WHERE login_id='$user_id' AND order_id=''") or die(mysqli_connect_error());
            //mysqli_query($dbcon, "UPDATE order_details SET total_qty =$prod_qty - $qty WHERE prod_id ='$prod_id' AND total_qty='' ");
          }

          ?>

          <hr color="orange">
          <br><br>
          <h3>ประเภทการชำระเงินจะเป็นแบบ <b>ชำระเงินปลายทาง</b></h3>
          <h3>เวลาดำเนินการจัดส่งขั้นต่ำ 3 วัน และช้าสุด 7 วันทำการ</h3>
          <h2>ขอบคุณที่ใช้บริการ</h2>
          <br>
          <h5>Snacks Sellings, Inc.</h5>

          <!-- <button type="button" class="btn btn-warning btn-round" onclick="window.print()"><span class="now-ui-icons ui-1_check"></span> Print</button> -->
          <a href="user_index.php"><button type="button" class="btn btn-success btn-round"><span class="now-ui-icons ui-1_check"></span> Back to Homepage</button></a>



        </div>



      </div>
    </div>
  </div>




</body>

</html>