<?php

include('header.php');
require_once('dbconn.php');

?>


<div class="container">
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>

        <?php
        $query = "SELECT  `item_code` FROM `tbl_cart`"; 
        $result = mysqli_query($conn, $query);   
        if ($result) 
        { 
            $row = mysqli_num_rows($result); 
                if ($row) { 
                    $tot = 0;
                    $rowse = $row; 
                    $count = $tot + $rowse;
                } 
        } 
        ?>


        <span class="badge badge-secondary badge-pill"><?php echo $count?></span>

      </h4>
      <ul class="list-group mb-3">


        <!-------------------------Item details--------------------------->
        <?php
        $sql = "SELECT i.description, i.item_name, i.discount_price, c.quantity FROM tbl_items i INNER JOIN tbl_cart c ON i.item_code = c.item_code;";
        $stmt = mysqli_prepare($conn, $sql);
        $res = mysqli_stmt_execute($stmt);
        if($res){
        mysqli_stmt_bind_result($stmt, $description, $item_name, $discount_price, $quantity); ?>

            <?php
            while(mysqli_stmt_fetch($stmt)){    

            ?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0"><?php echo $item_name?></h6>
                    <small class="text-muted"><?php echo $description?></small>
                </div>&nbsp;
                <span class="text-muted"><?php echo $quantity?></span>&nbsp;
                <span class="text-muted">Rs.<?php echo $discount_price*$quantity?></span>
                </li>

            <?php
            @$tot += $discount_price * $quantity; 
            $_SESSION["total_price"]=$tot;
            }
        } ?>       
        
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (LKR)</span>
          <strong>Rs.<?php echo $tot?></strong>

          
          
        </li>

        
      </ul>
    </div>

<!------------------------------------------------>    

    <div class="col-md-8 order-md-1">
    <form class="form-signin" action="checkout.php" method="post">
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input name="fname" type="text" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input name="lname" type="text" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        
        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input name="uemail" type="email" class="form-control" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input name="uadd"type="text" class="form-control" id="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select name="ucontry" class="custom-select d-block w-100" id="country" required>
              <option value="">Choose...</option>
              <option>Sri Lanka</option>
            </select>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select name="ustate" class="custom-select d-block w-100" id="state" required>
              <option value="">Choose...</option>
              <option>Colombo</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input name="uzip" type="text" class="form-control" id="zip" placeholder="" required>
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>
        
        <hr class="mb-4">
        <button name="btn-checkout" class="btn btn-primary btn-lg btn-block" type="submit" >Continue to checkout</button>
    </form>
    </div>
  </div>
</div>

<?php

if(isset($_POST["btn-checkout"])){
    //DB Connection.
    $_SESSION["fname"] = $_POST["fname"];
    $_SESSION["lname"] = $_POST["lname"];
    $_SESSION["uemail"] = $_POST["uemail"];
    $_SESSION["uadd"] = $_POST["uadd"];
    $_SESSION["ucontry"] = $_POST["ucontry"];
    $_SESSION["ustate"] = $_POST["ustate"];
    $_SESSION["uzip"] = $_POST["uzip"];

    ob_start();
    header("Location:payment.php");
    ob_clean();
    ob_end_flush();
}
?>




<?php

include('footer.php');

?>