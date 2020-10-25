<?php

include('header.php');
require_once('dbconn.php');

?>
<div class="container">
<div class="row justify-content-md-center">
  <div id="carouselExampleIndicators" class="col-sm- col-md- col-lg- col-xl- carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
          <div class="carousel-item active">
          <img class="d-block w-100" src="images/imghome.png" width="auto" height="300px" alt="First slide">
          </div>
          <div class="carousel-item">
          <img class="d-block w-100" src="images/imghome1.png" width="auto" height="300px" alt="Second slide">
          </div>
          <div class="carousel-item">
          <img class="d-block w-100" src="images/imghome2.png" width="auto" height="300px" alt="Third slide">
          </div>
          <div class="carousel-item">
          <img class="d-block w-100" src="images/imghome3.png" width="auto" height="300px" alt="Fourth slide">
          </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
      </a>
  </div>
</div>
</div>


    <?php
        $sql = "SELECT `item_code`, `item_name`, `discount_price` FROM tbl_items";
        $stmt = mysqli_prepare($conn, $sql);

        $res = mysqli_stmt_execute($stmt);
        if($res){
          mysqli_stmt_bind_result($stmt, $item_code,  $item_name, $discount_price); ?>

                      <!--Item panel -->
                      <div class="container">
                      <div class="row justify-content-center">

          <?php
          while(mysqli_stmt_fetch($stmt)){    
          ?>

                      <div class="col- col-sm- col-md- col-lg- col-xl- itme"> <a class="itemlink" href="item.php? itemid=<?php echo $item_code;?>"> 
              
                        <div class="img-box">
                          <img class="item-logo" width="180px" height="180px" alt="N/A" src="images/<?php echo $item_name;?>.png">
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
