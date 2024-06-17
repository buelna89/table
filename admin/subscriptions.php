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
              <h3>Subscriptions</h3>
            </div>

            <?php 
                  if(isset($_SESSION['deletedSub'])){
                    echo $_SESSION['deletedSub'];
                    unset ($_SESSION['deletedSub']);
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
                            <th>Email Adress</th> 
                            <th>Action</th>
                        </tr>

                        <?php 
                            $sql = "SELECT * FROM subscriptions ORDER BY id DESC";
                            $res = mysqli_query($conn, $sql);
                            $subID = 1;
                            if($res == TRUE){
                              $count = mysqli_num_rows($res);
                              if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                  $id = $row['id'];
                                  $email = $row['emailAddress'];
                                  
                                  ?>
   
                                  <tr class="tblRow orderRow">
                                      <td><?php echo $subID++?></td>
                                      <td><?php echo $email?></td>
                                      <td><a href="<?php echo SITEURL ?>admin/deleteSub.php?id= <?php echo $id;?>"><i class="uil uil-times-circle deleteIcon icon"></i></a>
                                    </td>
                                     
                              
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