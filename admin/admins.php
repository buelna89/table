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
              <h3>Administrators</h3>
            </div>
            <div class="notifications">
            <a href="subscriptions.php"><i class="uil uil-user-check icon"></i></a>
            </div>
          </div>

          <div class="adminContainer">
            <div class="allAdmins">
                <div class="title flex">All Admin Details 
                <?php 
                  if(isset($_SESSION['adminAdded'])){
                    echo $_SESSION['adminAdded'];
                    unset ($_SESSION['adminAdded']);
                  }
                  
                  if(isset($_SESSION['deleteAdmin'])){
                    echo $_SESSION['deleteAdmin'];
                    unset ($_SESSION['deleteAdmin']);
                  }

                  if(isset($_SESSION['adminUpdated'])){
                    echo $_SESSION['adminUpdated'];
                    unset ($_SESSION['adminUpdated']);
                  }
                ?>
       
                  <div class="addBtn"><a href="addAdmin.php"><i class="uil uil-plus-circle icon"></i></a>
                 </div>
                 </div>
                <div class="adminContainer">
                    <table>
                        <tr class="tblHeader">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>

                        <?php 
                        $sql = "SELECT * FROM admins";

                        $result = mysqli_query($conn, $sql);
                        $adminID = 1;
                        if($result == TRUE){
                            if(mysqli_num_rows($result) > 0){
                              while($row = mysqli_fetch_assoc($result)){
                                   $ID = $row['id'];
                                   $firstName = $row['firstName'];
                                   $secondName = $row['secName'];
                                   $adminEmail = $row['adminEmail'];
                                   $phoneNumbr = $row['phone'];
                                   $adminRole = $row['role'];
                                   $adminPassword = $row['password'];
                                   $image = $row['image'];
                                   ?>
                                     
                                 

                                <tr class="tblRow">
                                    <td><?php echo $adminID++; ?></td>
                                    <td>
                                    <div class="imageDiv">
                                    <?php 
                        
                                        if($image!=""){   
                                          ?>
                                            <div class="imgDiv">
                                          <img src="<?php echo SITEURL;?>restImages/dimasRest<?php echo $image;?>">
                                          </div>

                                          <?php
                                        }
                                        else{
                                          echo '<span class="fail" style="color:red; margin: 0px 10px;">No Image 1</span>';
                                        }

                                      ?>
                                    </div>
                                    </td>
                                    <td><?php echo $firstName?></td>
                                    <td><?php echo $adminEmail?></td>
                                    <td><?php echo $phoneNumbr?></td>
                                    <td><?php echo $adminPassword?></td>
                                    <td><?php echo $adminRole?></td>
                                    <td><a href="<?php echo SITEURL?>admin/updateAdmin.php?id=<?php echo $ID?>"><i class="uil uil-edit editIcon icon"></i></a></td>
                                    <td><a href="<?php echo SITEURL ?>admin/deleteAdmin.php?id= <?php echo $ID;?>"><i class="uil uil-times-circle deleteIcon icon"></i></a>
                                    </td>
                                </tr>


                                   <?php
                              }
                            }

                            else{
                              $_SESSION['admins'] = '<span class="fail"> No single amdministrator!</span>';
                              header('location:' . SITEURL. 'administrators.php');
                              exit();
                            }
                        }

                        else{
                          die('Connection Failed');
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