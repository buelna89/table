<?php 
include('adminPartials/header.php');
ob_start();
$orderID = $_GET['id'];
?>
      <div class="dashboard container">
      <?php 
       include('adminPartials/sideMenu.php');
       ?>


        <div class="dashboardBody">
          <div class="topSection flex">
            <div class="title">
              <h3>Single Order Details</h3>
            </div>
            <div class="notifications">
            <a href="<?php echo SITEURL?>admin/printPage.php?id=<?php echo $orderID?>"><i class="uil uil-print icon"></i></a>
            </div>
          </div>

            <div class="title flex">This is a single order details and status can be updated here!
            </div>

            <div class="grid">

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
                <div class="orderDetails flex">
                    <div class="cartDiv grid">

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
                                                                        <div class="singleCart flex">
                                                                            <?php 
                                                                                if($img!=""){   
                                                                                    ?>
                                                                                    <img src="<?php echo SITEURL;?>restImages/dimasRest<?php echo $img;?>">
                                                                                    <?php
                                                                                }
                                                                                else{
                                                                                    echo '<span class="fail" style="color:red; margin: 0px 10px;">No Image 1</span>';
                                                                                }
                                                                            ?>
                                                                            <div class="foodDetails">
                                                                                <span class="name_closeIcon flex">
                                                                                    <?php echo $foodName?>
                                                                                    <i class="uil uil-check-circle icon"></i>
                                                                                </span>
                                                                                <span class="qty_price flex">
                                                                                    <span>Quantity: <?php echo $qty?></span>
                                                                                    <span>$<?php echo $foodPrice * $qty?></span>
                                                                                </span>
                                                                            </div>
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

                    </div>
                    <div class="amountDiv">
                        
                
                        <span class="cartList flex">
                            <span class="subTitle">
                                Subtotal:
                            </span>
                            <span class="cost">
                                $<?php echo $subTotal;?>
                            </span>
                        
                        </span>
        
                        <span class="cartList flex">
                            <span class="subTitle">
                                Total:
                            </span>
                            <span class="gradCost">
                                $<?php echo $subTotal;?>
                            </span>
                        </span>



                        <div class="updateOrderDiv">
                            <h3 class="updateOrderTitle flex">
                                Upadate Order
                            </h3>
    
                            <form method="post">
                                <div class=" inputDiv flex">
                                    <label>Status</label>
                                    <select name="status">
                                        <option value="ordered" selected>Ordered</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="canceled">Canceled</option>
                                        <option value="on the way">On the way</option>
                                    </select>
                                </div>
                                <button name="submit" class="btn">Update Order</button> 
                            </form>
                        </div>
        
                    </div>
                    
                </div>
            </div>

            <div class="customerDetails grid">
                <div class="heading flex">
                    <span>Customer Details</span>
                </div>
                <div class="singleDetail flex">
                    <span class="dTitle">CustomerName:-</span>
                    <span class="detail"><?php echo $userName;?></span>
                </div>

                <div class="singleDetail  flex">
                    <span class="dTitle">Customer Phone:-</span>
                    <span class="detail" ><?php echo $phoneNumber;?></span>
                </div>

                <div class="singleDetail  flex">
                    <span class="dTitle">Table Number:-</span>
                    <span class="detail" ><?php echo $tableNumber;?></span>
                </div>
            </div>

        </div>
      </div>
   

    

<?php 
include('adminPartials/footer.php')
?>


<?php
if(isset($_POST['submit'])){

    $Status = $_POST['status'];

    $sql = "UPDATE orders SET
    orderStatus = '$Status'
    WHERE id = $orderID
    ";
  
    $result = mysqli_query($conn, $sql);
  
    if($result == TRUE){
      $_SESSION['orderUpdated'] = '<span class="success">Order Updated Successfully!</span>';
        header('location:'.SITEURL. 'admin/orders.php');
        exit();
    }
    else{
      
    die('Failed to connect to database!');
    } 
  }
?>
