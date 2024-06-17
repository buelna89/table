<?php 
include('adminPartials/header.php');
$orderID = $_GET['id'];
?>

<div class="prevIcon flex">
    <a href="<?php echo SITEURL?>admin/orderDetails.php?id=<?php echo $orderID?>"><i class="uil uil-angle-left icon"></i></a>
</div>
<div class="receiptDiv">
    <div class="printDiv" id="printDiv">
        <span class="businessName grid">
            <h4>My Restaurant Name</h4>
            <small>Serving the best!</small>
            <span class="phone">
                +784-900-954-32
            </span>
        </span>
        <span class="title grid">
            <h4 class="line"></h4>
            <h1>Receipt</h1>
            <h4 class="line"> </h4>
        </span>

        <?php           
            $orderID = $_GET['id'];
            $sql = "SELECT * FROM orders WHERE id = $orderID";
            $res = mysqli_query($conn, $sql);
            if($res == TRUE){
                $count = mysqli_num_rows($res);
                if($count == 1){
                    while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $cartID = $row['cartID'];
                    $userName = $row['userName'];
                    $tableNumber = $row['tableNumber'];
                    $totalPrice = $row['totalPrice'];
                    $phoneNumber = $row['phoneNumber'];
                    $orderStatus = $row['orderStatus'];
                    }
                }

                else{
                echo 'Something is wrong :)';
                }
            }
        ?>

        <div class="cutomerDetails grid">
            <span>Customer Name: <?php echo $userName?></span>
            <span>Table Number: <?php echo $tableNumber?></span>
            <span>Order Number: #<?php echo $id?></span>
        </div>

        <div class="cartItems grid">
            <div class="singleItem flex">
                <span class="itemName">
                    Item Name
                </span>
                <span class="itemQty">
                    Quantity
                </span>
                <span class="itemName">
                    Price ($)
                </span>
            </div>

            <?php           
                // Select item from the cart table ====> 
                $sql = "SELECT * FROM cart where id = $cartID";
                $res = mysqli_query($conn, $sql);
        
                if($res == TRUE){
                    $count = mysqli_num_rows($res);
                    if($count > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $sessionID = $row['sessionID'];

                        ?>
                            <?php 
                                // Get the values from the database=========>
                                $sql = "SELECT * FROM cart WHERE sessionID = '$sessionID'";
                                $res = mysqli_query($conn, $sql);
                                $subTotal = 0;
                                if($res==TRUE){
                                    $currentOrders = mysqli_num_rows($res);
                        
                                    if($currentOrders > 0){
                                        while($eachRow = mysqli_fetch_assoc($res)){
                                            $cartID = $eachRow['id'];
                                            $foodID = $eachRow['selectedItemID'];
                                            $sessionID = $eachRow['sessionID'];
                                            $qty = $eachRow['qty'];
                                            $foodPrice = $eachRow['foodPrice'];
                                            $subTotal += $foodPrice;

                                            ?>
                                                <?php 
                                                    $sql = "SELECT * FROM food WHERE id =$foodID";
                                                    $result = mysqli_query($conn, $sql);
                
                                                    if($result ==TRUE){
                                                        $foodDetails = mysqli_num_rows($result);
                                                        if($foodDetails > 0){
                                                            while($eachRow = mysqli_fetch_assoc($result)){
                                                                $food_ID = $eachRow['id'];
                                                                $img = $eachRow['foodImage'];
                                                                $foodName = $eachRow['foodName'];
                                                                $foodPrice = $eachRow['foodPrice'];
                                                                ?>
                                                                <div class="singleItem flex">
                                                                    <span class="itemName">
                                                                        <?php echo $foodName?>
                                                                    </span>
                                                                    <span class="itemQty">
                                                                        <?php echo $qty?>
                                                                    </span>
                                                                    <span class="itemName">
                                                                        $<?php echo $foodPrice * $qty?>
                                                                    </span>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                            <?php
                                        }
                                    } 
                                }
                            ?>
                        <?php

                        }
                    }

                    else{
                    echo 'Something is wrong :)';
                    }
                }
            ?>

            <span class="totalDiv grid">
                <h4 class="line"></h4>
                <span class="total flex">
                    <h4>Total Amount</h4>
                    <h4>$<?php echo $subTotal?></h4>
                </span>
                <h4 class="line"></h4>
            </span>
        </div>

        <span class="title grid">
            <h1>THANK YOU</h1>
            <h4 class="line"></h4>
        </span>
    </div>
    <button class="downloadBtn btn flex" onClick="window.print()">Print <i class="uil uil-print icon"></i></a></button>
</div>

<?php 
include('adminPartials/footer.php')
?>