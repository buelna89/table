<?php 
include('adminPartials/header.php');
ob_start();
?>
      <div class="dashboard container">
        
      <?php 
       include('adminPartials/sideMenu.php');
       ?>


        <div class="dashboardBody">
          <div class="topSection flex">
            <div class="title">
              <h3>Update Admin</h3>
            </div>
            <div class="notifications">
            <a href="subscriptions.php"><i class="uil uil-user-check icon"></i></a>
            </div>
          </div>

          <?php 
        //   Get individaul case id====>
        $updateAdminBtn = $_GET['id'];
          $sql = "SELECT * FROM admins WHERE id=$updateAdminBtn";
          $res = mysqli_query($conn, $sql);
          if($res == TRUE){
        $count = mysqli_num_rows($res);
        if($count == 1){
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

        }else{
            header('location:' .SITEURL. 'admin/menu.php');
                    exit();
        }
          }
          else{
              die('Failed to connect to the database!');
          }
          
          ?>

          <div class="settingsContainer">
            <div class="title">Update current administrator</div>

                  <div class="mainItems">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <div class="fieldsContainer flex">
                    <div class="rowsDiv">
                      <div class="row">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName ?>"  placeholder="Enter First name" >
                       </div>
                      <div class="row">
                        <label for="secondName">Second Name</label>
                        <input type="text" id="secondName" name="secondName" value="<?php echo $secondName ?>"   placeholder="Enter Second Name">
                       </div>
                       <div class="row">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="<?php echo $phoneNumbr ?>"  placeholder="Enter Admin Phone Number" >
                       </div>
                       <div class="row">
                        <label for="email">Admin Email</label>
                        <input type="text" id="email" name="email" value="<?php echo $adminEmail ?>"  placeholder="Enter Admin email" >
                       </div>

                    </div>
                    <div class="rowsDiv">
                    
                    <div class="row">
                        <label for="password">Password</label>
                        <input type="text" id="password" name="password" value="<?php echo $adminPassword ?>"  placeholder="Password">
                       </div>
                     
                       <div class="row">
                          <label for="adminPic">Prfile Picture</label>
                          <input type="file" id="adminPic" name="adminPic">
                        </div>

                       <div class="row">
                        <label for="roles">Admin Role <small>Click to change</small></label>
                        <select id="roles" name="role" value="<?php echo $adminRole ?>" >
                          <option value="admin" selected>Admin</option>
                          <option value="manager" >Manager</option>
                        </select>
                       </div>
                       <div class="row">
                            <!-- <input type="hidden" name="updatedID" value="<?php echo $id; ?>"> -->
                              <input type="submit" name="submit" id="submitBtn" value="Update Admin">
                            </div>
                    </div>
                    </form>
        
                    </div>
                  </div>

           
          </div>

        </div>
      </div>
   


<?php 
include('adminPartials/footer.php');
?>

<?php 
          if(isset($_POST['submit'])){
          
            $firstName = $_POST['firstName'];
            $secondName = $_POST['secondName'];
            $phoneNumbr = $_POST['phone'];
            $adminEmail = $_POST['email'];
            $adminPassword = $_POST['password'];
            $adminRole = $_POST['role'];

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
            }else{
              
              $image ="";
              }

            $sql = "UPDATE admins SET
                 firstName = '$firstName',
                 secName = '$secondName',
                 adminEmail = '$adminEmail',
                 phone = '$phoneNumbr',
                 role = '$adminRole',
                 password = '$adminPassword',
                 image = '$image'
                 WHERE id= $updateAdminBtn
            ";

            $result = mysqli_query($conn, $sql);

            if($result == TRUE){
              $_SESSION['adminUpdated']  = '<span class="success">Administrator updated successfully!</span>';
              header('location:' .SITEURL. 'admin/admins.php');
              exit();
            }
            else{
              $_SESSION['adminAdded']  = '<span class="fail">Failed to update adminstrator!</span>';
              header('location:' .SITEURL. '/admin/addAdmin.php');
              exit();
            }
          
          }
          
          ?>