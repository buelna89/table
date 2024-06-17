<?php 
include('./adminPartials/header.php');
ob_start();
?>
      <div class="dashboard container">
      <?php 
       include('adminPartials/sideMenu.php')
       ?>




        <div class="dashboardBody">
          <div class="topSection flex">
            <div class="title">
              <h3>Settings</h3>
             
            </div>
           
            <?php 
              if(isset($_SESSION['settings'])){
                echo $_SESSION['settings'];
                unset($_SESSION['settings']);
              }
             ?>

           <div class="notifications">
            <a href="subscriptions.php"><i class="uil uil-user-check icon"></i></a>
            </div>
          </div>

          <?php 
            // Get the values from the database=========>
            $fstName = $_SESSION['firstName'];
            $sql = "SELECT * FROM admins WHERE firstName = '$fstName'";
            $res = mysqli_query($conn, $sql);
            if($res==TRUE){
                $count = mysqli_num_rows($res);
                if($count==1){
                    while($row = mysqli_fetch_assoc($res)){
                      $ID = $row['id'];
                      $firstName = $row['firstName'];
                      $secondName = $row['secName'];
                      $adminEmail = $row['adminEmail'];
                      $phoneNumbr = $row['phone'];
                      $adminRole = $row['role'];
                      $adminPassword = $row['password'];
                      $image = $row['image'];
                    }

                }
                else{
                    header('location:' .SITEURL. 'admin/settings.php');
                    exit();
                }
            }
          
          ?>

         

          <div class="settingsContainer">
            <div class="title">Manage your profile</div>

                  <div class="mainItems">
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="fieldsContainer flex">
        
                    <div class="rowsDiv">
                      <div class="row">
                        <label for="firstName">First Name <small>Click to change</small></label>
                        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName;?>" placeholder="Enter First Name" >
                       </div>
                      <div class="row">
                        <label for="secondName">Second Name <small>Click to change</small></label>
                        <input type="text" id="secondName" name="secondName" value="<?php echo $secondName;?>" placeholder="Enter Second Name " >
                       </div>

                       <div class="row">
                        <label for="currentPassword">Current Password <small>Click to change</small></label>
                        <input type="text" id="currentPassword" name="currentPassword"  placeholder="Enter Your Current Password" required>
                        <input type="hidden" id="currPassword" name="currPassword" value="<?php echo $adminPassword;?>" placeholder="Enter Your Current Password">
                       </div>

                       <div class="row">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="<?php echo $phoneNumbr ?>"  placeholder="Enter Admin Phone Number" >
                       </div>
                      
                      
                    </div>
                    <div class="rowsDiv">
                    <div class="row">
                        <label for="email">Admin Email</label>
                        <input type="text" id="email" name="email" value="<?php echo $adminEmail ?>"  placeholder="Enter Admin email" >
                       </div>

                      <div class="row">
                        <label for="newPassword">New Password <small>Click to change</small></label>
                        <input type="password" id="newPassword" name="newPassword" placeholder="Enter New Password">
                       </div>

                       <div class="row">
                          <label for="adminPic">Profile Picture</label>
                          <input type="file" id="adminPic" name="adminPic">
                        </div>
                       
                       <div class="row">
                        <label for="roles">My Role <small>Click to change</small></label>
                        <select id="roles" name="role">
                          <option value="admin" selected>Admin</option>
                          <option value="manager" >Manager</option>
                        </select>
                       </div>

                       <div class="row">
                       <input type="hidden" name="targetAdmin" value="<?php echo $fstName; ?>">
                        <input type="submit" name="submit" id="submitBtn" value="Update">
                        </div>
                    </div>
        
                    </div>
                  </div>
                  </form>

           
          </div>

        </div>
      </div>


<?php 
include('adminPartials/footer.php')
?>


<?php 
          if(isset($_POST['submit'])){
            echo $targetAdmin = $_POST['targetAdmin'];
            $currPassword = $_POST['currPassword'];
            $firstName = $_POST['firstName'];
            $secondName = $_POST['secondName'];
            $phoneNumbr = $_POST['phone'];
            $adminEmail = $_POST['email'];
            $adminRole = $_POST['role'];
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];

            //  Uploading Image 1 to the database =======================>
     
            if(isset($_FILES['adminPic']['name'])){
              //To upload the image we need the image name, source and destination.
              $image = $_FILES['adminPic']['name'];
              // Source ================>
              $imageSource = $_FILES['adminPic']['tmp_name'];
              // Destination ================>
              $imageDestination = "../restImages/dimasRest".$image; 
              // Finally upload the image ========>
              $uploadImage = move_uploaded_file($imageSource, $imageDestination);

              if($uploadImage == false){
                $_SESSION['imgUpload']  = '<span class="fail">Failed to upload image!</span>';
                      // header('location:' .SITEURL. '.php');
            
              }
            }
            else{
              
              $image ="";
            }


            if($currPassword == $currentPassword){
              $sql = "UPDATE admins SET
              firstName = '$firstName',
              secName = '$secondName',
              adminEmail = '$adminEmail',
              phone = '$phoneNumbr',
              role = '$adminRole',
              password = '$newPassword',
              image = '$image'
              WHERE firstName = '$fstName'";
    
          $res = mysqli_query($conn,$sql);
            if($res == TRUE){
                      $_SESSION['settings']  = '<span class="success">Updates successful!</span>';
                      header('location:' .SITEURL. 'clientSide/loginPage.php');
                      exit();
                    }
                    else{
                      $_SESSION['settings']  = '<span class="fail">Something wrong!</span>';
                      header('location:' .SITEURL. 'admin/settings.php');
                      exit();
                    }
      }
      else{
        $_SESSION['settings']  = '<span class="fail">Either Emp ID or Current Password is wrong!</span>';
        header('location:' .SITEURL. 'admin/settings.php');
        exit();
      }

              
            }
            
 ?>

