<?php 
include('adminPartials/header.php')
?>
      <div class="dashboard container">
       <?php 
       include('adminPartials/sideMenu.php')
       ?>


        <div class="dashboardBody">
          <div class="topSection flex">
            <div class="title">
              <h3>Customer Orders</h3>
            </div>

            <?php 
                  if(isset($_SESSION['orderUpdated'])){
                    echo $_SESSION['orderUpdated'];
                    unset ($_SESSION['orderUpdated']);
                  }
            ?>
            <div class="notifications">
            <a href="subscriptions.php"><i class="uil uil-user-check icon"></i></a>
            </div>
          </div>

          <div class="adminContainer">
            <div class="allAdmins">
                <div class="title flex">All Orders </div>
                <div class="adminContainer">
                    <table>
                        <tr class="tblHeader">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Table No</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                            <th>Action</th>
                           
                        </tr>

                        <?php 
                            $sql = "SELECT * FROM orders ORDER BY id DESC";
                            $res = mysqli_query($conn, $sql);
                            $orderID = 1;
                            if($res == TRUE){
                              $count = mysqli_num_rows($res);
                              if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                  $id = $row['id'];
                                  $userName = $row['userName'];
                                  $tableNumber = $row['tableNumber'];
                                  $phoneNumber = $row['phoneNumber'];
                                  $total = $row['totalPrice'];
                                  $status = $row['orderStatus'];
                                  ?>
   
                                  <tr class="tblRow orderRow">
                                      <td><?php echo $orderID++?></td>
                                      <td><?php echo $userName?></td>
                                      <td><?php echo $phoneNumber?></td>
                                      <td><?php echo $tableNumber?></td>
                                      <td>$<?php echo $total?></td>
                                      <td><?php echo $status?></td>
                                      <td><a href="<?php echo SITEURL?>admin/orderDetails.php?id=<?php echo $id?>"><i class="uil uil-edit icon"></i></a></td>
                                  </tr>
                                  
                                  <?php
                                }
                              }
                            }
                            ?>
                    </table>
                
                </div>
                
              </div>
          </div>

        </div>
      </div>
   

    

<?php 
include('adminPartials/footer.php')
?>