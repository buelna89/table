<?php 
include('adminPartials/header.php')
?>
      <div class="dashboard container">
      <?php 
       include('adminPartials/sideMenuU.php')
       ?>


        <div class="dashboardBody">
          <div class="topSection flex">
            <div class="title">
            <h3>Welcome to the Restaurant Dashboard </h3>
            </div>
            <div class="notifications">
            <a href=""><i class="uil uil-user-check icon"></i></a>
            </div>
          </div>

          <div class="bodyContainer flex">

            <div class="mainSection flex">
              <div class="optionMenu flex">
                <div class="grid option">
                  <img src="../assests/french-fries.png" alt="Food">
                  <small>Fries</small>
                </div>
                <div class="grid option">
                  <img src="../assests/apple-juice.png" alt="Food">
                  <small>Juice</small>
                </div>
                <div class="grid option">
                  <img src="../assests/pizza.png" alt="Food">
                  <small>Pizza</small>
                </div>
                <div class="grid option">
                  <img src="../assests/burger.png" alt="Food">
                  <small>Burger</small>
                </div>
                <div class="grid option">
                  <img src="../assests/coke.png" alt="Food">
                  <small>Drinks</small>
                </div>
              </div>
              <div class="salesDiv">
                <div class="flex">
                  <i class="uil uil-usd-circle icon"></i>
                  <span class="divTitle">Total Sales</span>
                </div>
                <div> <h1><i class="uil uil-dollar-sign-alt"></i>N/A</h1></div>
                <small>Incl. All sales report</small>
              </div>
            </div>

           <div class="bottomSection flex">
            <div class="popularItems">
              <div class="title">Popular Item</div>
              <div class="itemsContainer flex">
              <?php 
                 $sql = "SELECT * FROM food  order by RAND() LIMIT 0,3 " ;
                 $res = mysqli_query($conn, $sql);
                 if ($res == true){
                   $count = mysqli_num_rows($res);
                   if($count>0){
                     while($row = mysqli_fetch_assoc($res)){
                      $id = $row['id'];
                      $img = $row['foodImage'];
                      $foodName = $row['foodName'];
                      $foodDesc = $row['foodDesc'];
                      $foodPrice = $row['foodPrice'];
                      $category = $row['category'];

                      ?>
                      <div class="singleItem">
                      <?php 
                        
                        if($img!=""){   
                          ?>
                          <div class="imgDiv">
                          <img src="<?php echo SITEURL;?>restImages/dimasRest<?php echo $img;?>">
                          </div>
                            

                          <?php
                        }
                        else{
                          echo '<span class="fail" style="color:red; margin: 0px 10px;">No Image 1</span>';
                        }

                      ?>

                        <div class="itemInfo">
                          <span class="itemName"><?php echo $foodName;?></span>
                          <p class="desc"><?php echo $foodDesc;?></p>
                          <div class="itemBottom flex">
                            <span class="price">$<?php echo $foodPrice?></span>
                            <a href="menuU.php"><i class="uil uil-newspaper icon"></i></a>
                          </div>
                        </div>
                      </div>
                      <?php
                     }
                   }
                 }
                ?>
              </div>
              
            </div>
            <div class="liveOrdersSection">
              <div class="title">Recent Orders</div>
              <div class="ordersDiv grid">

                <?php 
                  $sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 0,4";
                  $res = mysqli_query($conn, $sql);
                  $orderID = 1;
                  if($res == TRUE){
                    $count = mysqli_num_rows($res);
                    if($count > 0){
                      while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $userName = $row['userName'];
                        $tableNumber = $row['tableNumber'];
          
                        $total = $row['totalPrice'];
                        $status = $row['orderStatus'];
                        ?>
                          <div class="order flex">
                            <img src="../assests/man.png" alt="Avatar Image">
                            <div class="itemInfor">
                              <span class="itemName"><?php echo $userName?></span>
                              <span> Order Status:<?php echo $status?> 
                              Price: $<?php echo $total ?></span>
                            </div>
                          </div>
                        <?php
                      }
                    }
                  }
                ?>    
              </div>
            </div>
           </div>
          </div>
        </div>
      </div>

<?php 
include('adminPartials/footer.php')
?>