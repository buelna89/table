<?php 
include('adminPartials/header.php');
ob_start();
?>
      <div class="dashboard container">
      <?php 
       include('adminPartials/sideMenu.php')
       ?>


        <div class="dashboardBody">
          <div class="topSection flex">
            <div class="title">
              <h3>Update Order</h3>
            </div>
            <div class="notifications">
            <a href="subscriptions.php"><i class="uil uil-user-check icon"></i></a>
            </div>
          </div>

          <div class="settingsContainer">
            <div class="title">You can only update order status from this form</div>

           

       <?php 
        //   Get individaul case id====>
        $updateOrderBtnID = $_GET['id'];
          $sql = "SELECT * FROM orders WHERE id=$updateOrderBtnID";
          $res = mysqli_query($conn, $sql);
          if($res == TRUE){
        $count = mysqli_num_rows($res);
        if($count == 1){
             while($row = mysqli_fetch_assoc($res)){
                $id = $row['id'];
                $userName = $row['userName'];
                $tableNumber = $row['tableNumber'];
                $itemName = $row['foodName'];
                $qty = $row['foodQuantity'];
                $total = $row['totalPrice'];
                $status = $row['orderStatus'];  

             }

        }else{
            header('location:' .SITEURL. 'admin/orders.php');
                    exit();
        }
          }
          else{
              die('Failed to connect to the database!');
          }
          
          ?>

                   <div class="mainItems">
                    <form action="" method="POST">
                    <div class="fieldsContainer flex">
                    <div class="rowsDiv">
                      <div class="row">
                        <label for="orderID">Order ID</label>
                        <input type="text" id="orderID" readonly name="orderID" value="<?php echo $id ?>" >
                       </div>

                      <div class="row">
                        <label for="userName">User Name</label>
                        <input type="text" id="userName" readonly name="userName" value="<?php echo $userName ?>" >
                       </div>

                      <div class="row">
                        <label for="tableNumber">Table Number</label>
                        <input type="text" id="tableNumber" readonly name="tableNumber" value="<?php echo $tableNumber ?>" >
                       </div>

                      <div class="row">
                        <label for="itemName">Item Name</label>
                        <input type="text" id="itemName" readonly name="itemName" value="<?php echo $itemName ?>" >
                       </div>
                    </div>


                    <div class="rowsDiv">
                    
                    <div class="row">
                        <label for="qty">Quantity</label>
                        <input type="text" id="qty" readonly name="qty" value="<?php echo $qty ?>" >
                       </div>
                     
                       <div class="row">
                        <label for="total">Total Fees</label>
                        <input type="text" id="total" readonly name="total" value="<?php echo $total ?>" >
                       </div>

                       <div class="row">
                        <label for="roles">Status <small>Click to change</small></label>
                        <select  id="stat" name="status">
                          <option value="On the Way">On the Way</option>
                          <option value="Delivered">Delivered</option>
                          <option value="Canceled" >Canceled</option>
                          <option value="Ordered" >Ordered</option>
                        </select>
                       </div>
                       <div class="row">
                            <!-- <input type="hidden" name="updatedID" value="<?php echo $id; ?>"> -->
                              <input type="submit" name="submit" id="submitBtn" value="Update Order">
                            </div>
                    </div>
                    </form>
        
                    </div>
                  </div>

           
          </div>

        </div>
      </div>
   
<?php 
include('adminPartials/footer.php')
?>


<?php 
if(isset($_POST['submit'])){

  $userName = $_POST['userName'];
  $tableNumber = $_POST['tableNumber'];
  $itemName = $_POST['itemName'];
  $qty = $_POST['qty'];
  $total = $_POST['total'];
  $status = $_POST['status'];
 


  $sql = "UPDATE orders SET
  userName = '$userName',
  tableNumber = '$tableNumber',
  foodName = '$itemName',
  foodQuantity = '$qty',
  totalPrice = '$total',
  orderStatus = '$status'
  WHERE id=$updateOrderBtnID
  ";

  $result = mysqli_query($conn, $sql);

  if($result == TRUE){
    $_SESSION['orderUpdated'] = '<span class="success">Item Updated Successfully!</span>';
      header('location:'.SITEURL. 'admin/orders.php');
      exit();
  }
  else{
    
  die('Failed to connect to database!');
  } 

}



?>
