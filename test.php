        <div class="tab-pane  active" id="">
          <ul class="thumbnails">
            <?php
            $query = "SELECT * FROM products ORDER BY prod_id ASC";
            $result = mysqli_query($dbcon, $query);
            while ($res = mysqli_fetch_array($result)) {
              $prod_id = $res['prod_id'];
              ?>
              <div class="row-sm-3">
                <div class="thumbnail">
                  <?php if ($res['prod_pic1'] != "") : ?>
                    <img src="uploads/<?php echo $res['prod_pic1']; ?> " width="300px" height="300px">
                  <?php else : ?>
                    <img src="uploads/default.png" width="300px" height="200px">
                  <?php endif; ?>
                  <div class="caption">
                    <h5><b><?php echo $res['prod_name']; ?></b></h5>
                  </div>
                </div>
                <hr color="orange">
              </div>
            <?php } ?>
          </ul>
        </div>