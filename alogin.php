<?php

include('header.php');

?>

<div class="loginform welcomeloin">
    <p class="singinmg">Welcome to William Electronics! <br/> Please login.*</p>
</div>

<div class="loginform">
    <div class="logindiv">
            
        <form class="form-signin" action="alogin.php" method="post">
        <p class="signmg">Email*</p>
        <input type="email" name="u-email" id="inputEmail" class="form-control loginemail" placeholder="Email address" required autofocus>
        <p class="signmg">Password*</p>
        <input type="password" name="u-password" id="inputPassword" class="form-control loginemail" placeholder="Password" required>
        <div class="checkbox mb-3 size">
            <label>
            <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button name="btn-signin" class="btn btn-primary btn-block signinbtn" type="submit">Sign in</button>
        <p class="loginagree"><a  href="forgotpassword.php"> Forgot Password? </a></p>
        <p class="loginagree1"><a  href="forgotpassword.php"> New Member? </a></p>
        </form>

    </div>
</div>

<!----------------------Checking loging details------------------------------>

<?php
    if(isset($_POST["btn-signin"])){
        
        $email = $_POST["u-email"];
        $password = $_POST["u-password"];
        
        $sql = "SELECT * FROM `tbl_customer` WHERE `email`=? AND `password`=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        $res = mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $customer_id, $email, $password, $full_name, $phone, $gender);
        if($res){
            mysqli_stmt_store_result($stmt);
            $num_rows = mysqli_stmt_affected_rows($stmt);
            if($num_rows > 0){
                //echo "<h1>login success</h1>";
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

                    var_dump($uemail);

                }

                var_dump($_SESSION["uemail"]);

                header("Location:index.php");
                // ob_start();
                // header("Location:index.php");
                // ob_clean();
                // ob_end_flush();
            } else {
                echo "<h1>login failed</h1>";
                $_SESSION["logged_in"] = false;
            }
        } else {
            echo "<h1>login query failed</h1>";
            $_SESSION["logged_in"] = false;
        }
    }
   // echo "test";
    include('footer.php');
?>
