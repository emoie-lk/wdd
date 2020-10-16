<?php
    session_start();
    require_once('dbconn.php');
    include('header.php');
    


if(isset($_SESSION["email"])){
    echo "Email is : ".$_SESSION["email"];
} else {
    echo "Ivalid access";
}


    include('footer.php');
    
?>