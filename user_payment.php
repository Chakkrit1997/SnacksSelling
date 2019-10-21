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

          $query = mysqli_query($dbcon, "SELECT * FROM `tb_login` WHERE login_id=$user_id ");
          $row = mysqli_fetch_array($query);
          $firstname = $row['firstname'];
          $lastname = $row['lastname'];
          $email = $row['login_email'];
          // $contact = $row['contact'];


          // เลือกทั้งหมด ที่ id 122 order_id=''
          $query3 = mysqli_query($dbcon, "SELECT * FROM order_details WHERE login_id='$user_id' AND order_id=''") or die(mysqli_connect_error());
          $row3 = mysqli_fetch_array($query3);
          $count = mysqli_num_rows($query3); // นับแถว แปลกๆ

          $prod_id = $row3['prod_id'];
          $qty = $row3['prod_qty'];

          $query2 = mysqli_query($dbcon, "SELECT * FROM products WHERE prod_id='$prod_id'") or die(mysqli_connect_error());
          $row2 = mysqli_fetch_array($query2);
          $prod_qty = $row2['prod_qty'];

          //อัพเดทหลัง
          mysqli_query($dbcon, "UPDATE products SET prod_qty = prod_qty - $qty WHERE prod_id ='$prod_id' AND prod_qty='$prod_qty'");

          //ผลรวมของ ID นั้นๆ
          $cart_table = mysqli_query($dbcon, "SELECT sum(total) FROM order_details WHERE login_id='$user_id' AND order_id=''") or die(mysqli_connect_error());

          //
          $cart_count = mysqli_num_rows($cart_table);

          while ($cart_row = mysqli_fetch_array($cart_table)) {

            $total = $cart_row['sum(total)'];
            date_default_timezone_set('Asia/Bangkok');
            $date = date("Y-m-d H:i:s");
            
            $track_num = $user_id . $user_id + 1000;
            $shipaddress = $_POST['shipaddress'];
            // $city = $_POST['city'];
            $ship_add = $shipaddress;
            echo 'login_id = ' . $user_id . '<br>';
            echo 'track_num = ' . $track_num . '<br>';
            echo 'ชื่อ = ' . $firstname . '<br>';
            echo 'นามสกุล = ' . $lastname . '<br>';
            echo 'อีเมลล์ = ' . $email . '<br>';
            echo 'shipping_add = ' . $ship_add . '<br>';
            echo 'order_date = ' . $date . '<br>';
            echo 'totalprice = ' . $total . '<br>';
            


            echo '********* หมายเลขคำสั่งซื้อของคุณ : ' . $track_num . ' | ';
            echo 'ทั้งหมด : ' . $total . ' บาท | ';
            echo 'ส่งไปที่อยู่ : ' . $ship_add . ' *********';


            $query9 = "INSERT INTO order (login_id, track_num, firstname, lastname, email , shipping_add, order_date, statuss, totalprice) 
                                VALUES ('$user_id','$track_num','$firstname','$lastname','$email','$ship_add','$date','pending','$total')";
            mysqli_query($dbcon, $query9) or die(mysqli_connect_error());


            mysqli_query($dbcon, "UPDATE order_details SET order_id = order_id+1 WHERE login_id='$user_id' AND order_id=''") or die(mysqli_connect_error());
            mysqli_query($dbcon, "UPDATE order_details SET total_qty =$prod_qty - $qty WHERE prod_id ='$prod_id' AND total_qty='' ");
          }

          ?>

          <hr color="orange">
          <br><br>
          <h3>Payment type will be a <b>Cash On Delivery</b></h3>
          <h3>Delivery process time, minimum of three(3) days and maximum of five(5) working days.</h3><br>
          <h5>Electricks Technology, Inc.</h5>

          <button type="button" class="btn btn-warning btn-round" onclick="window.print()"><span class="now-ui-icons ui-1_check"></span> Print</button>
          <a href="user_index.php"><button type="button" class="btn btn-success btn-round"><span class="now-ui-icons ui-1_check"></span> Back to Homepage</button></a>



        </div>



      </div>
    </div>
  </div>




</body>

</html>