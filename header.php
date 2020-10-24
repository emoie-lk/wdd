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



<!--search bar -->

<div id="search" class="container fixed ">
  <div class="row">
    <div class="col-sm">

      <a href="index.php"> <img  class="item-img" width="208px" height="57px" alt="N/A" src="images/logo.png"> </a>

    </div>
    <div class="col-sm-6">

          <form class="form-inline my-2 my-lg-0">
            <input id = "textfield" class="form-control mr-sm-2 searchtext" type="search" placeholder="Search" aria-label="Search">
            <button id = "btn" class="btn btn-outline-success my-2 my-sm-0 searchbtn" type="submit">Search</button>
          </form>

    </div>
    <div class="col-sm mn">
  

      <a class="cart" href="cart.php"><svg width="40" height="40" viewBox="0 0 24 24"><path d="M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm9.804-16.5l-3.431 12h-2.102l2.542-9h-5.993c.113.482.18.983.18 1.5 0 3.59-2.91 6.5-6.5 6.5-.407 0-.805-.042-1.191-.114l1.306 3.114h13.239l3.474-12h1.929l.743-2h-4.196zm-6.304 15c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm-4.5-10.5c0 2.485-2.018 4.5-4.5 4.5-2.484 0-4.5-2.015-4.5-4.5s2.016-4.5 4.5-4.5c2.482 0 4.5 2.015 4.5 4.5zm-2-.5h-2v-2h-1v2h-2v1h2v2h1v-2h2v-1z"/></svg> </a>
      
      <img class="securelogo" class="item-img" width="145px" height="65px" alt="N/A" src="images/payment.png">

    
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
        $sql = "SELECT `category_name` FROM tbl_cate";
        $stmt = mysqli_prepare($conn, $sql);

        $res = mysqli_stmt_execute($stmt);
        if($res){
          mysqli_stmt_bind_result($stmt, $category_name); ?>

          <?php
          while(mysqli_stmt_fetch($stmt)){    
          ?>

                    <a class="dropdown-item"  href="#"><?php echo $category_name;?></a>

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