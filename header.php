<?php

session_start();
require_once('dbconn.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiliam - Online Shopping for Electronic Items</title>

    <!---icon--->
    <link rel="icon" type="image/icon type" href="images/icon.jpg"> 
              
    <!---bootstrap--->
    <link rel="stylesheet"  href="css/bootstrap.css">
    <link rel="stylesheet"  href="css/search_bar.css">
    <link rel="stylesheet"  href="css/navigation_bar.css">
    <link rel="stylesheet"  href="css/item_panel.css">
    <link rel="stylesheet"  href="css/item_page.css">
    <link rel="stylesheet"  href="css/footer.css">
    <link rel="stylesheet"  href="css/cart.css">
    <link rel="stylesheet"  href="css/login.css">

    <!----------Themes----------->
    <?php if(isset($_SESSION['greentheme'])){ ?>  
      <link rel="stylesheet"  href="css/greentheme.css">        
    <?php } ?>

    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<!----------------------Checking loging details in cookies------------------------------>
<?php
    if(isset($_COOKIE["u-password"])) {
        
        $email = $_COOKIE["u-email"];
        $password = $_COOKIE["u-password"];
        
        $sql = "SELECT * FROM `tbl_customer` WHERE `email`=? AND `password`=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        $res = mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $customer_id, $email, $password, $full_name, $phone, $gender);
        if($res){
            mysqli_stmt_store_result($stmt);
            $num_rows = mysqli_stmt_affected_rows($stmt);
            if($num_rows > 0){

                while(mysqli_stmt_fetch($stmt)){
                    $_SESSION["customer_id"] = $customer_id;
                    $_SESSION["email"] = $email;
                    $_SESSION["password"] = $password;
                    $_SESSION["full_name"] = $full_name;
                    $_SESSION["phone"] = $phone;
                    $_SESSION["gender"] = $gender;
                    $_SESSION["gender"] = $gender;
                    $_SESSION["logged_in"] = true;
                    $_SESSION["greentheme"] = $gender;;
                }
            } else {
                $_SESSION["logged_in"] = false;
            }
        } else {
            $_SESSION["logged_in"] = false;
        }
    }
?>
<!---------------------------------------------------------------------------------------->

<!--search bar -->

<div id="search" class="container fixed ">
  <div class="row justify-content-center">
    <div class="col-3 col-md-3 col-lg col-xl-3">

      <a href="index.php"> <img  class="item-img" width="90%" height="auto" alt="N/A" src="images/logo.png"> </a>

    </div>
  <!--  <div class="col-sm-6">
      <form class="form-inline my-2 my-lg-0">
        <input id = "textfield" class="form-control mr-sm-2 searchtext" type="search" placeholder="Search" aria-label="Search">
        <button id = "btn" class="btn btn-outline-success my-2 my-sm-0 searchbtn" type="submit">Search</button>
      </form>        
    </div> -->

    <div class="col-6 col-md-6 col-lg- col-xl-6">
      <form class="form-inline my-2 my-lg-0" method="get" action="searchproducts.php">
        <input name="searchbar" id = "textfield" class="form-control mr-sm-2 searchtext" type="search" placeholder="Search">
        <button id = "btn" class="btn btn-outline-success my-2 my-sm-0 searchbtn" type="submit">Search</button>
      </form>
    </div>

    <div class="col-1 col-md-1 col-lg col-xl-1 cart">

      <a href="cart.php"><img  class="item-img" width="50%" height="auto" alt="N/A" src="images/cart.png"></a>

    </div>

    <div class="col-2 col-md-2 col-lg col-xl-2 seclogo">
  
      <img class="securelogo" class="item-img" width="80%" height="auto" alt="N/A" src="images/payment.png">
    
    </div>

  </div>
</div>

<!--Navigation bar -->
  
<nav id="ss" class="navbar navbar-expand-lg navbar-light bg-light">
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item categiri">

      <div class="dropdown">
     
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">CATEGORIES</a>
            
            <div class="dropdown-menu">


              <?php
              $sql = "SELECT `category_id`,`category_name` FROM tbl_cate";
              $stmt = mysqli_prepare($conn, $sql);
              $res = mysqli_stmt_execute($stmt);
              if($res){
                mysqli_stmt_bind_result($stmt, $category_id, $category_name); 
              ?>

                <?php
                while(mysqli_stmt_fetch($stmt)){    
                ?>

                  <a class="dropdown-item"  href="searchproducts.php? categoriyid=<?php echo $category_id?>"><?php echo $category_name;?></a>

                <?php  
                }
              }
              ?>               

            </div>
      </div>

      </li>

      <li class="nav-item">
        <a class="nav-link colo" href="#">HOT DEALS</a>
      </li>

      <li class="nav-item">
        <a class="nav-link colo" href="#">SERVICE CENTRES</a>
      </li>


        <?php
        if(isset($_SESSION["email"])){ ?>
        
        <li class="nav-item categiri maxwidth ">
          
        <div class="dropdown">

          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION ["full_name"]?></a>

           <div class="dropdown-menu">

              <a class="dropdown-item"  href="#">hi</a>
              <a class="dropdown-item"  href="#">hi</a>
              <a class="dropdown-item"  href="#">hi</a>

              

           </div>
        </div>

        </li>
                   

        <?php
        } else { ?>
      

      <li class="nav-item">
        <a class="nav-link colo" href="login.php">LOGIN</a>
      </li> <!--&nbsp;&nbsp;&nbsp;-->

      <li class="nav-item">
        <a class="nav-link colo" href="#">SIGNUP</a>
      </li>

      <?php
        } ?>
      
    </ul>
     </div>
</nav> <br/>
    



<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>