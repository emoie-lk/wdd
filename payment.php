<?php

include('header.php');
require_once('dbconn.php');

echo $_SESSION["uemail"];
echo $_SESSION["order_id"];

?>






<div class="col-lg-9 loginform welcomeloin headpay">
    <p class="singinmg payheadtext">Select Payment Method</p>
</div>





<div class="container">
  <div class="row">
     
    <div class="col-md-5 offset-md-2  order-md-2 mb-4 ">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Order Summary</span>
      </h4>
      <ul class="list-group mb-3">

            <!-------------------------Item details--------------------------->
            <?php
            $sql = "SELECT i.discount_price, c.quantity FROM tbl_items i INNER JOIN tbl_cart c ON i.item_code = c.item_code;";
            $stmt = mysqli_prepare($conn, $sql);
            $res = mysqli_stmt_execute($stmt);
            if($res){
            mysqli_stmt_bind_result($stmt, $discount_price, $quantity); ?>

                <?php
                while(mysqli_stmt_fetch($stmt)){    

                @$tot += $discount_price * $quantity; 
                }
            } ?>  
        
            <li class="list-group-item d-flex justify-content-between lh-condensed lefert">
            <div>
                <h6 class="my-0">Sub total</h6>
            </div>
            <span class="text-muted">Rs.<?php echo $tot?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed lefert">
            <div>
                <h6 class="my-0">Shipping</h6>
            </div>
            <span class="text-muted">Free</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
            <span>Total (LKR)</span>
            <strong>Rs.<?php echo $tot?></strong>
            </li>
      </ul>
    </div>

<!------------------------------------------------>  





<div class="col-md-5 ">

<nav>
    <div class="nav nav-tabs paymethod" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active paymethod" id="nav-card-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Credit/Debit Card</a>
        <a class="nav-item nav-link paymethod" id="nav-cod-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Cash On Delivery</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active paymethoddiv" id="nav-home" role="tabpanel" aria-labelledby="nav-card-tab">

        <form class="needs-validation" validate action="payment.php" method="post"> 
            <div class=" mb-3">
                <label for="cc-name">Name on card</label>
                <input name="cardname" type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
            </div>
            <div class=" mb-3">
                <label for="cc-number">Credit card number</label>
                <input name="cardnum" type="text" class="form-control" id="cc-number" placeholder="" required>

            </div>
            <div class="row">
            <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input name="expir" type="text" class="form-control" id="cc-expiration" placeholder="" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="cc-cvv">CVV</label>
                <input name="cvv" type="text" class="form-control" id="cc-cvv" placeholder="" required>
            </div>
            </div>
            
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>

        </form>
    </div>

    <div class="tab-pane fade khfgdg" id="nav-profile" role="tabpanel" aria-labelledby="nav-cod-tab">
        You can pay in cash to our courier when you receive the goods at your doorstep.
    
        <hr class="mb-4">

        <form class="form-signin" action="payment.php" method="post">
        <button name="cod" class="btn btn-primary btn-lg btn-block" type="submit">Confirm Order</button>
        </form>
    
    </div>

</div>

</div>
</div>
</div>


<?php



if(isset($_POST["cod"])){
    //DB Connection.
    $order_id = $_SESSION["order_id"];
    $total_price = $_SESSION["total_price"];
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $uemail = $_SESSION["uemail"];
    $uadd = $_SESSION["uadd"];
    $ucontry = $_SESSION["ucontry"];
    $ustate = $_SESSION["ustate"];
    $uzip = $_SESSION["uzip"];
    $pay_method = "COD";
    $status = 1;
    $time = "";

   
    
    $sql = @"INSERT INTO `tbl_delivery` (`id`, `company_name`,`postal_code`, `weight`, `dimensions`, `description`, `price`)  VALUES 
         (?,?,?,?,?,?,?);";
    
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, 'issssss', $order_id, $fname, $uemail,  $order_id, $pay_method, $status, $ucontry);
    
    $res = mysqli_stmt_execute($stmt);

    if($res){
        
        $num_rows = mysqli_stmt_affected_rows($stmt);

        if($num_rows > 0){
            echo "Record has been added";
            echo $order_id;

            unset($_SESSION['order_id']);
            unset($_SESSION['total_price']);
            unset($_SESSION['fname']);
            unset($_SESSION['lname']);
            unset($_SESSION['uemail']);
            unset($_SESSION['uadd']);
            unset($_SESSION['ucontry']);
            unset($_SESSION['ustate']);
            unset($_SESSION['uzip']);

            ob_start();
            header("Location:index.php");
            ob_clean();
            ob_end_flush();

        }  else {
            echo "Invalid data. please check your data";
        }
    } else {
        echo mysqli_stmt_errno($stmt)." : Database error ".mysqli_stmt_error($stmt);
    }
   
}
?>





<?php

include('footer.php');

?>