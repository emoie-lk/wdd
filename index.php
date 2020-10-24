<?php

include('header.php');
require_once('dbconn.php');

?>

<!--Item panel
<div class="container">
  <div class="row">


    <div id ="col" class="col-sm-2 itme">
      
      <div class="img-box">
      Image of the product
      </div>

      <div class="itm-des">
        <p> Item description</p>
      </div>

      <div class="itm-price">
        <lable>Rs.2750.00</lable>
      </div>

      <div class="star">
        <span class="fa fa-star checked" ></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
      </div>


    </div>


  </div>
</div><br/>  -->


    <?php
        $sql = "SELECT `item_code`, `item_name`, `discount_price` FROM tbl_items";
        $stmt = mysqli_prepare($conn, $sql);

        $res = mysqli_stmt_execute($stmt);
        if($res){
          mysqli_stmt_bind_result($stmt, $item_code,  $item_name, $discount_price); ?>

                      <!--Item panel -->
                      <div class="container">
                      <div class="row">

          <?php
          while(mysqli_stmt_fetch($stmt)){    
          ?>

                      <div id ="col" class="col- itme"> <a class="itemlink" href="item.php? itemid=<?php echo $item_code;?>"> 
              
                        <div class="img-box">
                          <img class="item-logo" width="180px" height="180px" alt="N/A" src="images/<?php echo $item_name;?>.PNG">
                        </div>

                        <div class="itm-des">
                          <p> <?php echo $item_name; ?></p>
                        </div>

                        <div class="itm-price">
                          <lable>Rs.<?php echo $discount_price; ?></lable>
                        </div>

                        <div class="star">
                          <span class="fa fa-star checked" ></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                        </div>

                      </a> 
                      </div>

                  <?php  
                  }
                  ?>
              
                </div>
              </div><br/>

          <?php  
          }
          ?>








    
    
    
<?php

include('footer.php');

?>