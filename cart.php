<?php

include('header.php');
require_once('dbconn.php');

?>

<!------------------Shopping Cart---------------------------------->

<div class="container rowcolor">
  <div class="row rowcolor">
    <div class="col-sm- cartname">
  
    <lable class="Shopping_Cart">Shopping Cart </lable>

    </div>
  </div>
</div>

<!---------------------checkout Panel------------------------------->

<div class="col-sm-4 checkout">
  
  <div class="order">
  
     <lable>Order Summary </lable>

  </div>

  <div class="subtotal">
  
     <p class="spce" >Subtotal  : Rs. 15200.00 </p> <br/> 
     <p class="spce" >Shipping  : Free </p>
  </div>

  <div class="line"></div>

  <div class="subtotal total">
  
     <p  >Total  : Rs. 15200.00 </p>

  </div>

  <div class="checkoutbtn">
     
      <button type="button" class="btn btn-default btn-block checkout_btn">PROCEED TO CHECKOUT</button>

  </div>
  



</div>

<!-------------------------Item details--------------------------->


<?php
//$sql = "SELECT `item_code`, `quantity` FROM tbl_cart";
//$sql = "SELECT d.name, s.subject FROM staff d INNER JOIN subject s ON d.staff_id = s.staff_id;";
$sql = "SELECT i.brand, i.item_code, i.description, i.item_name, i.discount_price, c.quantity FROM tbl_items i INNER JOIN tbl_cart c ON i.item_code = c.item_code;";
$stmt = mysqli_prepare($conn, $sql);


$res = mysqli_stmt_execute($stmt);
if($res){
  mysqli_stmt_bind_result($stmt, $brand, $item_code, $description, $item_name, $discount_price, $quantity); ?>


<?php
while(mysqli_stmt_fetch($stmt)){    
?>
          
<div class="container rowcolor">  
  <div class="row">

    <div class="col-sm- uitem"> 

        <div  class="uimg">

        <img class="uitemimg" width="130px" height="130px" alt="N/A" src="images/<?php echo $item_name?>.PNG">

        </div>     
   
    </div>

    <div class="col-3 udec"><a class="itemlink" href="item.php? itemid=<?php echo $item_code;?>">
      
      <p class="udectxt"> <?php echo $item_name ?> <?php echo $description ?></p></a>

      <lable class="udectxtbrand" > Brand :  <?php echo $brand ?></lable>

</div>

    <div class="col-sm- uitem-price">

      <div class="cpricedel">
        <div class="iprice uiprice">

          <lable type = "number" class ="discount" > Rs. <?php echo $discount_price ?></lable> 

                       
        </div>

        <center><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor"> 
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
        </svg></center> 

      </div>
    </div>

    <div class="col-2 uque">
        


        <button id="button1"  class="btn btn-default ciquen cque " type="submit"> + </button>
        <input id="button1" class="form-control mr-sm-2 uqnt cque" type="numbers" value=<?php echo $quantity ?>>
        <button  id="button1" class="btn btn-default ciquen btn2 cque " type="submit"> + </button>

    </div>




    <div class="col-sm-4 nothing">

    </div>

    </div> 
  </div>

  <?php  
    }
}
?>


<?php

include('footer.php');

?>