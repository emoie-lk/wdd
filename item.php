<?php

require_once('dbconn.php');
include('header.php');


?>


<!--Item page-->
<div class="container itempage">
    <div class="row">

        <?php
        if(isset($_GET["itemid"])){

            $id = $_GET["itemid"];

            $sql = "SELECT `item_code`, `brand`, `item_name`,`description`, `warrenty`, `quantites`, `price`,`discount_price` FROM tbl_items WHERE item_code = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            $result = mysqli_stmt_execute($stmt);

                if($result){
                    mysqli_stmt_bind_result($stmt, $item_code, $brand_name, $item_name,  $description, $warrenty, $quantites, $price, $discount_price);

                    while(mysqli_stmt_fetch($stmt)){   
        ?>

                        <div  class="col-sm-4 ipic">
                            <div  class="iimage">
                                <img class="ipic" width="300px" height="300px" alt="N/A" src="images/<?php echo $item_name;?>.png">                                  
                            </div>                                
                        </div>

                        <div class="col-sm-5 idec">
                        <!--------------------------------------------->
                            <div class="idescription">
                                <p id = "inamedescription"><?php echo $item_name ?>  <?php echo $description ?>  <?php echo $warrenty ?> Company warrenty</p>
                            </div>                    
                        <!--------------------------------------------->
                            <div class="star istar">
                                <span class="fa fa-star checked" ></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        <!--------------------------------------------->
                            <div class="ibrand">
                                <lable> Brand : <?php echo $brand_name ?> </lable> 
                            </div>
                        <!--------------------------------------------->

                            <div class="iprice">
                                <lable type = "number" class ="discount" > Rs. <?php echo $discount_price ?></lable>
                            </div>
                        <!--------------------------------------------->
                            <div class="idesprice">
                                <lable class ="rprice"><del>Rs. <?php echo $price ?></del></lable>
                            </div>

                    

                        <!--------------------------------------------->
                            <div class="iquentity">
                                <button id="btn-" class="btn btn-default iquen" type="submit"> - </button>
                                <input id="qnt" class="form-control mr-sm-2" type="numbers" value="1" min="1" max=<?php echo $quantites?>>
                                <button id ="btn+" class="btn btn-default iquen btnq2" type="submit"> + </button>      
                            </div>

                            <script>

                                document.getElementById("btn-").onclick = function(){

                                    var x = document.getElementById("qnt").value;
                                    let y = eval(x)
                                    var z = 1;                                  
                                    
                                    txt = (y - z);

                                        if( txt <= 0){
                                        
                                        }else{
                                            document.getElementById("qnt").value = txt;
                                        }
                                }

                                document.getElementById("btn+").onclick = function(){

                                    qnt = document.getElementById("qnt").max;
                                    var x = document.getElementById("qnt").value;
                                    let y = eval(x)
                                    var z = 1;

                                    txt = (y + z);                                    

                                        if( txt > qnt){
                                        
                                        }else{
                                            document.getElementById("qnt").value = txt;
                                        }
                                }

                            </script>

                    <?php
                    }
                }
        }
        ?>

                        <!--------------------------------------------->
                            <div class="ibuy">
                                <button id="buy" class="btn btn-default ibuynow" type="submit"> Buy Now </button>
                                <button id="cart" class="btn btn-default iaddtocart" type="submit"> Add to Cart </button>
                            </div>

                
                        </div>

                        <div class="col-sm-3 iadd">
                            <p>Oshadha Induwara </p>   
                        </div>         

    </div>
</div><br/> 



<?php

include('footer.php');

?>