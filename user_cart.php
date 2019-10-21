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
  <title>cart</title>

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

    <h2 class="mt-5"> <?php
                      include('db.php');
                      $query = mysqli_query($dbcon, "SELECT * FROM `tb_login` WHERE login_id='" . $_SESSION['id'] . "'");
                      $row = mysqli_fetch_array($query);
                      $cid = $row['login_id'];
                      ?>รายการสินค้าของ
                      <?echo $_SESSION['username'];?>
    </h2>
    <a class="btn btn-primary btn-round" href="user_index.php"><i class="now-ui-icons shopping_basket"></i> &nbsp ซื้อสินค้าเพิ่ม</a>
    <hr color="orange">

    <div class="col-md-12">
      <br>

      <div class="panel panel-success panel-size-custom">
        <div class="panel-body">

          <?php
          $user_id = $_SESSION['id'];

          $query3 = mysqli_query($dbcon, "SELECT * FROM order_details WHERE login_id='$user_id' AND order_id=''") or die(mysql_error());
          $count2 = mysqli_num_rows($query3);
          ?>

          <form method="post" action="user_payment.php">
            <h5>[ <small><?php echo $count2; ?> </small>] จำนวนสินค้า</h5>
            <table class="table table-condensed table-bordered">
              <thead>
                <tr>
                  <th>สินค้า</th>
                  <th>รายละเอียดสินค้า</th>
                  <th width="100">จำนวน</th>
                  <th width="110">ราคา(บาท)</th>
                  <th width="110">รวม(บาท)</th>
                  <th width="80">ตัวเลือก</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = mysqli_query($dbcon, "SELECT * FROM order_details WHERE login_id='$user_id' and order_id=''") or die(mysqli_connect_error());
                while ($row = mysqli_fetch_array($query)) {
                  $count = mysqli_num_rows($query);
                  $prod_id = $row['prod_id'];

                  $query2 = mysqli_query($dbcon, "SELECT * FROM products WHERE prod_id='$prod_id'") or die(mysqli_connect_error());
                  $row2 = mysqli_fetch_array($query2);
                  ?>
                  <tr>
                    <td> <img width="100" height="100" src="uploads/<?php echo $row2['prod_pic1']; ?>" alt="" /></td>
                    <td><b><?php echo $row2['prod_name']; ?></b><br><br>
                      <?php echo $row2['prod_desc'];
                        ?>
                    </td>
                    <td><br><?php echo $row['prod_qty']; ?></td>
                    <td><br><?php echo $row2['prod_price']; ?></td>
                    <td><br><?php echo $row['total']; ?></td>
                    <td class="text-center">
                      <a href="user_order_edit.php?order_id=<?php echo $row['order_details_id']; ?>"><button class="btn btn-warning btn-round mb-2" type="button">เปลี่ยนจำนวน</button></a>
                      <a href="user_order_delete.php?order_id=<?php echo $row['order_details_id']; ?>"><button class="btn btn-danger btn-round" onclick="return confirm('คุณแน่ใจที่ต้องการลบรายการสินค้า?')" type="button">ลบ</button></a>
                    </td>
                  <?php
                  } ?>
                  </tr>

                  <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2" class="text-right"><b>รวมทั้งหมด</b></td>
                    <td class="label label-important"> <strong>
                        <?php
                        $result5 = mysqli_query($dbcon, "SELECT sum(total) FROM order_details WHERE login_id='$user_id' and order_id=''");
                        while ($row5 = mysqli_fetch_array($result5)) {
                          echo  $row5['sum(total)'] . 'บาท';
                          echo '<input type="hidden" name="total" value="' . $row5['sum(total)'] . '">';
                        }
                        ?></strong>
                    </td>
                    <td></td>
                  </tr>

              </tbody>
            </table>


            <?php
            if ($count2 == 0) {
              ?>

              <script type="text/javascript">
                alert("ไม่มีสินค้าในตะกร้า! กรุณาเพิ่มสินค้า.");
                window.location = "user_index.php";
              </script>

            <?php
            } else {
              ?>

              <button type="submit" id="" onclick="return confirm('Are you sure you want to Checkout?')" name="submit" class="btn btn-success btn-round pull-right" data-toggle="modal" data-target="#myModal">
                <i class="now-ui-icons shopping_bag-16"></i> สั่งซื้อ</button>

            <?php
            }
            ?>

            <!-- Modal Core -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">ที่อยู่การจัดส่งสินค้า:</h4>
                  </div>
                  <div class="modal-body">

                    <div class="form-group">
                      <input type="text" class="form-control" name="shipaddress" placeholder="ที่อยู่ในการจัดส่งสินค้าของคุณ." required />
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-round" data-dismiss="modal"> ยกเลิก</button>
                    <a><button type="submit" name="submit" class="btn btn-success btn-round"> ตกลง</button></a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="src/js/jquery-3.3.1.min.js"></script>
  <script src="src/js/bootstrap.min.js"></script>


</body>

</html>