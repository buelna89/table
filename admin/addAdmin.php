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
              <h3>New Admin</h3>
            </div>
            <div class="notifications">
            <a href="subscriptions.php"><i class="uil uil-user-check icon"></i></a>
            </div>
          </div>

          <div class="settingsContainer">
            <div class="title">Register a new administrator</div>

                  <div class="mainItems">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <div class="fieldsContainer flex">
                    <div class="rowsDiv">
                      <div class="row">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName"  placeholder="Enter First name" >
                       </div>
                      <div class="row">
                        <label for="secondName">Second Name</label>
                        <input type="text" id="secondName" name="secondName"  placeholder="Enter Second Name">
                       </div>
                       <div class="row">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" placeholder="Enter Admin Phone Number" >
                       </div>
                       <div class="row">
                        <label for="email">Admin Email</label>
                        <input type="text" id="email" name="email" placeholder="Enter Admin email" >
                       </div>
                     

                    </div>
                    <div class="rowsDiv">
                    
                    <div class="row">
                        <label for="password">Password</label>
                        <input type="text" id="password" name="password"  placeholder="Password">
                       </div>
                     
                       <div class="row">
                          <label for="adminPic">Prfile Picture</label>
                          <input type="file" id="adminPic" name="adminPic">
                        </div>

                       <div class="row">
                        <label for="roles">Admin Role <small>Click to change</small></label>
                        <select id="roles" name="role">
                          <option value="admin" selected>Admin</option>
                          <option value="manager" >Manager</option>
                        </select>
                       </div>
                       <div class="row">
                            <!-- <input type="hidden" name="updatedID" value="<?php echo $id; ?>"> -->
                              <input type="submit" name="submit" id="submitBtn" value="Add Admin">
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

            $sql = "INSERT INTO admins SET
                 firstName = '$firstName',
                 secName = '$secondName',
                 adminEmail = '$adminEmail',
                 phone = '$phoneNumbr',
                 role = '$adminRole',
                 password = '$adminPassword',
                 image = '$image'
            ";

            $result = mysqli_query($conn, $sql);

            if($result == TRUE){
              $_SESSION['adminAdded']  = '<span class="success">Administrator added successfully!</span>';
              header('location:' .SITEURL. 'admin/admins.php');
              exit();
            }
            else{
              $_SESSION['adminAdded']  = '<span class="fail">Failed to adminstrator!</span>';
              header('location:' .SITEURL. '/admin/addAdmin.php');
              exit();
            }
          
          }
          
          ?>