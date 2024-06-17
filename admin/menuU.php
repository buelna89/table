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
              <h3>All Menus </h3>
            </div>
            
          </div>




          <div class="menuContainer">
            <div class="allItems">
                <div class="title flex">Food items from different categories
                <?php 
                  if(isset($_SESSION['updated'])){
                    echo $_SESSION['updated'];
                    unset ($_SESSION['updated']);
                  }

                  if(isset($_SESSION['addedFood'])){
                    echo $_SESSION['addedFood'];
                    unset ($_SESSION['addedFood']);
                  }

                  if(isset($_SESSION['deleteItem'])){
                    echo $_SESSION['deleteItem'];
                    unset ($_SESSION['deleteItem']);
                  }
                ?>
                  <div class="addBtn"><a href="" title="Only managers can add food item!"><i class="uil uil-plus-circle icon"></i></a></div>
                 </div>
                <div class="itemsContainer grid">
                  
                <?php 
                $sql = "SELECT * FROM food";
                $res = mysqli_query($conn, $sql);
                if($res == TRUE){
                  $count = mysqli_num_rows($res);
                  if($count > 0){
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
                            <span class="price">$<?php echo $foodPrice;?></span>
                          <div>
                            <a href="<?php echo SITEURL?>admin/updateItemU.php?id=<?php echo $id?>"><i class="uil uil-edit icon"></i></a>

                            <a href="" title="Only Manager can deleted this item!"><i class="uil uil-times-circle deleteIcon icon"></i></a>
                          </div>
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
          </div>

        </div>
      </div>
   

    

<?php 
include('adminPartials/footer.php')
?>