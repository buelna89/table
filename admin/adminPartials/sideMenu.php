
<div class="sideMenu">
            <div class="divContainer">
                <div class="adminDiv">
                <?php 
                  $firstName = $_SESSION['firstName'];
                  $sql = "SELECT image from admins where firstname = '$firstName'";
                  $res = mysqli_query($conn, $sql);
                  if($res == TRUE){
                    $count = mysqli_num_rows($res);
                      if($count==1){
                        while($row = mysqli_fetch_assoc($res)){
                           $adminImage = $row['image'];
                        }
                      }
                    
                  }
                  ?>
                    <?php 
                        
                        if($adminImage!=""){   
                          ?>
                            <div class="imgDiv">
                          <img src="<?php echo SITEURL;?>restImages/dimasRest<?php echo $adminImage;?>">
                          </div>

                          <?php
                        }
                        else{
                          echo '<span class="fail" style="color:red; margin: 0px 10px;">No Image 1</span>';
                        }

                      ?>
                    <small>Manager</small>
                    <span class="adminName">
                     <?php 
                     if(isset($_SESSION['firstName'])){
                      echo $_SESSION['firstName'];
                     
                    }
                     ?>
                    </span>
                    <span class="logOut">
                    <a href="logOut.php" ><i class="uil uil-sign-out-alt icon"></i><span>Log Out</span></a>
                    
                   </span>
                </div>
    
                <!-- menu -->
                <div class="menuDiv">
                  <ul class="menuList grid">
                      <li class="listItem ">
                          <a href="dashboard.php" class="navLink flex">
                            <i class="uil uil-estate icon"></i>
                              Dashboard
                          </a>
                      </li>
                      <li class="listItem ">
                          <a href="menu.php" class="navLink flex">
                            <i class="uil uil-crockery icon"></i>
                              All Menus
                          </a>
                      </li>
                      <li class="listItem ">
                          <a href="orders.php" class="navLink flex">
                            <i class="uil uil-crockery icon"></i>
                              Orders
                          </a>
                      </li>
                      <li class="listItem ">
                          <a href="admins.php" class="navLink flex">
                            <i class="uil uil-chat-bubble-user icon"></i>
                              Administrators
                          </a>
                      </li>
                      <li class="listItem ">
                          <a href="subscriptions.php" class="navLink flex">
                          <i class="uil uil-newspaper icon"></i>
                              Subscriptions
                          </a>
                      </li>
                      <li class="listItem">
                          <a href="settings.php" class="navLink flex">
                            <i class="uil uil-cog icon"></i>
                              Settings
                          </a>
                      </li>
                      
                  </ul>
                </div>
            </div>
        </div>