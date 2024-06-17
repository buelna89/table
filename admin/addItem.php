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
              <h3>New Item</h3>
            </div>
            <div class="notifications">
            <a href="subscriptions.php"><i class="uil uil-user-check icon"></i></a>
            </div>
          </div>

          <div class="settingsContainer">
            <div class="title">Add new item</div>

            <?php 
            if(isset($_SESSION['addedFood'])){
              echo $_SESSION['addedFood'];
              unset ($_SESSION['addedFood']);
            }
            ?>

                  <div class="mainItems">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <div class="fieldsContainer flex">
                      <div class="rowsDiv">
                        <div class="row">
                          <label for="itemName">Item Name</label>
                          <input type="text" id="itemName" name="itemName"  placeholder="Enter item name">
                        </div>
                        
                        <div class="row">
                          <label for="desc">Description</label>
                          <textarea type="text" id="desc" name="desc" placeholder="Describe the item."></textarea>
                        </div>
          
                        <div class="row">
                          <label for="price">Item Price</label>
                          <input type="number" id="price" name="price" placeholder="Enter Price">
                        </div>
                        
                        
                      </div>
                      <div class="rowsDiv">
                        
                        <div class="row">
                          <label for="itemImage">Image</label>
                          <input type="file" id="itemImage" name="itemImage">
                        </div>
                        <div class="row">
                          <label for="roles">Category </label>
                          <select id="roles" name="category">
                            <option value="pizza" selected>Pizza</option>
                            <option value="burger" selected>Burger</option>
                            <option value="fries" selected>Fries</option>
                            <option value="juice" selected>Juice</option>
                            <option value="soda" selected>Soda</option>
                          
                          </select>
                        </div>
                        <div class="row">
                                <input type="submit" name="submit" id="submitBtn" value="Add Item">
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

  $foodName = $_POST['itemName'];
  $foodDesc = $_POST['desc'];
  $foodPrice = $_POST['price'];
  $category = $_POST['category'];


   //  Uploading Image 1 to the database =======================>
     
   if(isset($_FILES['itemImage']['name'])){
    //To upload the image we need the image name, source and destination.
    $image = $_FILES['itemImage']['name'];
    // Source ================>
    $imageSource = $_FILES['itemImage']['tmp_name'];
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

  $sql = "INSERT INTO food SET
  foodImage = '$image',
  foodName = '$foodName',
  foodDesc = '$foodDesc',
  foodPrice = '$foodPrice',
  category = '$category'
  ";

  $result = mysqli_query($conn, $sql);

  if($result == TRUE){
    $_SESSION['addedFood'] = '<span class="success">Item Added Successfully!</span>';
      header('location:'.SITEURL. '/admin/addItem.php');
      exit();
  }
  else{
    
  die('Failed to connect to database!');
  } 

}



?>
