<?php 
include('../config/config.php');
ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dimas Menu</title>
    <!-- link to css -->
    <link rel="stylesheet" href="./main.css">
     <!--  link to icons  -->
     <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php 
    $currentSession = session_id();
    $sql = "SELECT * FROM cart WHERE sessionID ='$currentSession'";
    $res = mysqli_query($conn, $sql);
        if($res == TRUE){
          $count = mysqli_num_rows($res);
    }
?> 
    
<header class="header flex">
    <div class="logoDiv">
        <h2 class="logo">Table Menu</h2>
    </div>

    <span class="phone flex">
        <i class='bx bxs-phone icon' ></i>
        +(6) 444 000 000 000
        </span>

    <span class="cartBtn flex">
      <a href="cart.php">
      <i class='bx bxs-shopping-bag icon'></i>
      </a>
      <span class="count"><?php echo $count?></span>
    </span>

  
   

   
</header>

     <!--cart section starts ==================================-->
<section class="section container cartSection">
    <div class="cartContent">
           
        <h1 class="cartTitle">Cart Details</h1>
        
        <div class="cartItems grid">
            <form method="POST">
                <?php 
                    $currentSession = session_id();
                    $sql2 = "SELECT * FROM cart WHERE sessionID = '$currentSession'";
                    $res2 = mysqli_query($conn, $sql2);
                    $bill = 0;
                    if($res2 == TRUE){
                        $count2 = mysqli_num_rows($res2);

                        if($count2 > 0){
                            while($row2 = mysqli_fetch_assoc($res2)){
                                $cartID = $row2['id'];
                                $selectedItemID = $row2['selectedItemID'];
                                $qty = $row2['qty'];
                                $totalCost = $row2['foodPrice'];
                                $bill += $totalCost;

                                ?>
                                    <?php
                                        $sql3 = "SELECT * FROM food WHERE id = '$selectedItemID'";
                                        $res3 = mysqli_query($conn, $sql3);
                                        
                                        if($res3 == TRUE){
                                        $count3 = mysqli_num_rows($res3);
                                            if($count3 > 0){
                                                while($row3 = mysqli_fetch_assoc($res3)){
                                                    $itemID = $row3['id'];
                                                    $foodImage = $row3['foodImage'];
                                                    $foodName = $row3['foodName'];
                                                    $foodPrice = $row3['foodPrice'];
                                                    
                                                    ?>
                                                    
                                                        <div class="singleItem flex">
                                                
                                                                <?php 
                                                                        
                                                                    if($foodImage!=""){   
                                                                    ?>
                                                                        <div class="itemImage">
                                                                    <img src="<?php echo SITEURL;?>restImages/dimasRest<?php echo $foodImage;?>">
                                                                    </div>

                                                                    <?php
                                                                    }
                                                                    else{
                                                                    echo '<span class="fail" style="color:red; margin: 0px 10px;">No Image 1</span>';
                                                                    }

                                                                    

                                                                ?>

                                                            <div class="itemDetails flex">

                                                                    <input type="text" name="itemName" readonly class="itemName" value="<?php echo
                                                                        $foodName ?>">
                                                                        <div class="qty_flex flex">
                                                                            <label for="qty">Quantity:</label>
                                                                            <span><?php echo
                                                                        $qty ?></span>
                                                                        </div>

                                                                

                                                                    <div class="itemPrice">
                                                                        <input type="number" readonly name="cartPrice" value="<?php echo  $totalCost ?>">
                                                                    </div>

                                                                    <div class="deleteIcon">
                                                                        <a href="<?php echo SITEURL?>clientSide/deleteCartItem.php?id=<?php echo $cartID?>"><i  class='bx bxs-x-circle icon'></i></a>
                                                                    </div>
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

                        else{
                            ?>
                            <span style="text-align:center; color:red">Cart is currently empty!</span>
                            <?php
                        }
                    }  
                ?>

                <div class="grandTotal">
                <div class="priceDiv flex">
                    <span class="total flex">
                        Checkout bill: <strong>$<?php echo $bill?></strong> 
                    </span>
                    
                </div>

                    <div class="newCustomer flex">
                    <div class="cutomerForm">
                     <small>Please fill the fields below</small>                    
                            <div class="userName">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="customerUserName" placeholder="Any name e.g; My best" required>
                            </div>
                            <div class="userName">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="customerPhone" placeholder="Enter Phone Number" required>
                            </div>
                            <div class="tableNo">
                                <label for="tbN">Table Number</label>
                                <input type="number" id="tbN" name="tableNumber" placeholder=" E.g; 6" required>
                            </div>
                        
                    
                        <div id="closeIconForm">
                            <a href="<?php echo SITEURL?>index.php"><i class='bx bx-x-circle icon' ></i></a>
                        </div>
                    </div>
                    </div>
                    <button >
                        <a href="<?php echo SITEURL?>index.php" class="flex"><i class='bx bxs-shopping-bag icon' ></i> Continue Shopping</a>
                    </button>
                    <button id="checkOutbtn">
                        <input type="hidden" name="status" value="Ordered">
                        <input type="hidden" name="cartID" value="<?php echo $cartID?>">
                        <input type="hidden" name="bill" value="<?php echo $bill?>">
                        <i class='bx bx-money-withdraw icon' ></i> 
                        <input type="submit" name="submit" value="Chech Out">
                    </button>

                </div>
            </form>
        </div> 
        
    </div>
</section>
<!--cart section ends ==================================-->


<?php 
include('partials/footer.php');
?>


<?php 

if(isset($_POST['submit'])){
    $itemName = $_POST['itemName'];
    $cartID = $_POST['cartID'];
    $customerUserName = $_POST['customerUserName'];
    $phoneNumber = $_POST['customerPhone'];
    $tableNumber = $_POST['tableNumber'];
    $totalBill = $_POST['bill'];
    $status = $_POST['status'];

    $sql = "INSERT INTO orders SET
    userName = '$customerUserName',
    cartID = '$cartID',
    phoneNumber = '$phoneNumber',
    tableNumber = '$tableNumber',
    orderStatus = '$status',
    totalPrice = '$totalBill'
    ";

    $res = mysqli_query($conn, $sql);
    if($res == TRUE){
         $_SESSION['order']  = '<span class="success">Order made successfully!</span>';
         header('location:' .SITEURL. 'clientSide/closeSession.php');
         exit();
    }
    else{
        $_SESSION['adminAdded']  = '<span class="fail">Order failed!</span>';
        header('location:' .SITEURL. 'clientSide/cart.php');
        exit();

      }
}

?>

