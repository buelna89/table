<?php 
include('./config/config.php');
$sessionID = session_id();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dimas Menu</title>
    <!-- link to css -->
    <link rel="stylesheet" href="./clientSide/main.css">
        <!--  link to icons  -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

  <?php 
    $currentSession = session_id(); 
    $sql = "SELECT * FROM cart WHERE sessionID ='$currentSession'";
    $res = mysqli_query($conn, $sql);
        if($res == TRUE){
          $count = mysqli_num_rows($res);
    }
  ?> 
    
<header class="header flex">
    <div class="logoDiv">
        <h2 class="logo">Table Menu</h2>
    </div>

    <span class="phone flex">
        <i class='bx bxs-phone icon' ></i>
        +(6) 444 000 000
        </span>

        <span class="cartBtn flex">
      <a href="clientSide/cart.php">
      <i class='bx bxs-shopping-bag icon'></i>
      </a>
      <span class="count"><?php echo $count?></span>
    </span>

  
    <div class="toggleNav">
        <i class='bx bx-menu icon' ></i>
    </div>

    <div class="navBar">
        <p>Welcome to <strong>Dimas Restaurant</strong>, this is where you matter most!</p>
    </div>
</header>

    <section class="container section menus">
        <div class="sectionIntro">
            <span class="introText">Welcome, to our restaurant</span>
            <h2 class="heading">TODAY'S SPECIAL MENU</h2>
            <img src="./assests/titleDesign.png" alt="Title Design">
        </div>
        <?php 
                  if(isset($_SESSION['order'])){
                    echo $_SESSION['order'];
                    unset ($_SESSION['order']);
                  }
        ?>
        <div class="clientMenu">
            <div class="optionMenu flex">
                <div class="grid option" data-filter="fries">
                  <img src="./assests/french-fries.png" alt="Food">
                  <small>Fries</small>
                </div>
                <div class="grid option" data-filter="juice">
                  <img src="./assests/apple-juice.png" alt="Food">
                  <small>Juice</small>
                </div>
                <div class="grid option categoryActive" data-filter="pizza">
                  <img src="./assests/pizza.png" alt="Food">
                  <small>Pizza</small>
                </div>
                <div class="grid option" data-filter="burger">
                  <img src="./assests/burger.png" alt="Food">
                  <small>Burger</small>
                </div>
                <div class="grid option"  data-filter="drinks">
                  <img src="./assests/coke.png" alt="Food">
                  <small>Drinks</small>
                </div>
              </div>

              <div class="menuItems ">
                 <div class="categoryWrapper grid hide" data-target="burger">
                  <?php 
                    $sql = "SELECT * FROM food WHERE category ='burger'";
                    $res = mysqli_query($conn, $sql);
                        if($res == TRUE){
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
                              <div class="item">
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
                              <div class="itemInfor">
                                  <span class="itemNamePriceDiv flex">
                                        <span class="itemName"><?php echo $foodName?></span>
                                        <h1 class="price">$<?php echo $foodPrice?></h1>
                                  </span>

                                  <p class="description"><?php echo $foodDesc?></p>
                                  <div class="qty_btn">
                                    <form method="POST">
                                      <input type="hidden" name="sessionID" value="<?php echo $sessionID ?>">
                                      <input type="hidden" name="selectedItemID" value="<?php echo $id ?>">
                                      <input type="hidden" name="foodPrice" value="<?php echo $foodPrice ?>">
                                      <div class="qty_flex flex">
                                          <label for="qty">Quantity:</label>
                                          <input type="number" name="qty" id="qty" value="1">
                                      </div>
                                      <button class="cartBtn flex" name="submit">        
                                        <i class='bx bxs-cart-alt icon'></i>
                                        Add To Cart          
                                      </button>
                                    </form>
                                  </div>      
                                </div>
                            </div>
                              <?php
                          }
                      }
                    }
                  ?>               
                 </div>
                 <div class="categoryWrapper grid hide" data-target="juice">
                 <?php 
                    $sql = "SELECT * FROM food WHERE category ='juice'";
                    $res = mysqli_query($conn, $sql);
                    if($res == TRUE){
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
                        <div class="item">
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
                          <div class="itemInfor">
                            <span class="itemNamePriceDiv flex">
                                  <span class="itemName"><?php echo $foodName?></span>
                                  <h1 class="price">$<?php echo $foodPrice?></h1>
                            </span>

                            <p class="description"><?php echo $foodDesc?></p>
                            <div class="qty_btn">
                            <form method="POST">
                                <input type="hidden" name="sessionID" value="<?php echo $sessionID ?>">
                                <input type="hidden" name="selectedItemID" value="<?php echo $id ?>">
                                <input type="hidden" name="foodPrice" value="<?php echo $foodPrice ?>">
                                <div class="qty_flex flex">
                                    <label for="qty">Quantity:</label>
                                    <input type="number" name="qty" id="qty" value="1">
                                </div>
                                <button class="cartBtn flex" name="submit">        
                                  <i class='bx bxs-cart-alt icon'></i>
                                  Add To Cart          
                                </button>
                              </form>
                            </div>      
                          </div>
                        </div>
                      <?php
                    }
                 }
                 }
                  ?>
                 </div>
                 <div class="categoryWrapper grid live" data-target="pizza">
                 <?php 
                    $sql = "SELECT * FROM food WHERE category ='pizza'";
                    $res = mysqli_query($conn, $sql);
                    if($res == TRUE){
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
                        <div class="item">
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
                        <div class="itemInfor">
                             
                          <span class="itemNamePriceDiv flex">
                                <span class="itemName"><?php echo $foodName?></span>
                                <h1 class="price">$<?php echo $foodPrice?></h1>
                          </span>

                          <p class="description"><?php echo $foodDesc?></p>
                          <div class="qty_btn">
                          <form method="POST">
                                <input type="hidden" name="sessionID" value="<?php echo $sessionID ?>">
                                <input type="hidden" name="selectedItemID" value="<?php echo $id ?>">
                                <input type="hidden" name="foodPrice" value="<?php echo $foodPrice ?>">
                                <div class="qty_flex flex">
                                    <label for="qty">Quantity:</label>
                                    <input type="number" name="qty" id="qty" value="1">
                                </div>
                                <button class="cartBtn flex" name="submit">        
                                  <i class='bx bxs-cart-alt icon'></i>
                                  Add To Cart          
                                </button>
                              </form>
                          </div>
                               
                        </div>
                      </div>
                        <?php
                    }
                 }
                 }
                  ?>
                 </div>
                 <div class="categoryWrapper grid hide" data-target="fries">
                 <?php 
                    $sql = "SELECT * FROM food WHERE category ='fries'";
                    $res = mysqli_query($conn, $sql);
                    if($res == TRUE){
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
                        <div class="item">
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
                          <div class="itemInfor">
                             
                             <span class="itemNamePriceDiv flex">
                                   <span class="itemName"><?php echo $foodName?></span>
                                   <h1 class="price">$<?php echo $foodPrice?></h1>
                             </span>
 
                             <p class="description"><?php echo $foodDesc?></p>
                             <div class="qty_btn">
                             <form method="POST">
                                <input type="hidden" name="sessionID" value="<?php echo $sessionID ?>">
                                <input type="hidden" name="selectedItemID" value="<?php echo $id ?>">
                                <input type="hidden" name="foodPrice" value="<?php echo $foodPrice ?>">
                                <div class="qty_flex flex">
                                    <label for="qty">Quantity:</label>
                                    <input type="number" name="qty" id="qty" value="1">
                                </div>
                                <button class="cartBtn flex" name="submit">        
                                  <i class='bx bxs-cart-alt icon'></i>
                                  Add To Cart          
                                </button>
                              </form>
                             </div>
                               
                          </div>
                        </div>
                        <?php
                    }
                 }
                 }
                  ?>
                 </div>
                 <div class="categoryWrapper grid hide" data-target="drinks">
                 <?php 
                    $sql = "SELECT * FROM food WHERE category ='soda'";
                    $res = mysqli_query($conn, $sql);
                    if($res == TRUE){
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
                        <div class="item">
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
                          <div class="itemInfor">
                             
                            <span class="itemNamePriceDiv flex">
                                  <span class="itemName"><?php echo $foodName?></span>
                                  <h1 class="price">$<?php echo $foodPrice?></h1>
                            </span>

                            <p class="description"><?php echo $foodDesc?></p>
                            <div class="qty_btn">
                              <form method="POST">
                                <input type="hidden" name="sessionID" value="<?php echo $sessionID ?>">
                                <input type="hidden" name="selectedItemID" value="<?php echo $id ?>">
                                <input type="hidden" name="foodPrice" value="<?php echo $foodPrice ?>">
                                <div class="qty_flex flex">
                                    <label for="qty">Quantity:</label>
                                    <input type="number" name="qty" id="qty" value="1">
                                </div>
                                <button class="cartBtn flex" name="submit">        
                                  <i class='bx bxs-cart-alt icon'></i>
                                  Add To Cart          
                                </button>
                              </form>
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

       
    </section>

    <!-- <div class="introPage">
      <div class="imageAnimation">
        <img src="./assests/p1.png" alt="">
      </div>
    </div> -->

 <!-- link to main.js -->
 <script src="./clientSide/main.js"></script>

 <!-- <script>
  
  //INTRO PAGE ================================>
const introPage = document.querySelector('.introPage')

function showIntroPage(){
    setTimeout(()=> introPage.classList.add('removeIntro'), 2900)
}
showIntroPage()

function displyNone(){
    setTimeout(()=> introPage.classList.add('displayNone'), 3100)
}
displyNone()
 </script> -->
 
<?php 
include('./clientSide/partials/footer.php')
?>

<?php

if(isset($_POST['submit'])){
  $sessionID = $_POST['sessionID'];
  $selectedItemID = $_POST['selectedItemID'];
  $qty = $_POST['qty'];
  $eachFoodPrice = $_POST['foodPrice'];
  $totalCost = $qty * $eachFoodPrice;
  
  
  if($qty > 0){
    $sql = "INSERT INTO cart set
    sessionID = '$sessionID',
    qty = '$qty',
    foodPrice = '$totalCost',
    selectedItemID = '$selectedItemID'
    ";

    $runQuerry = mysqli_query($conn, $sql);
    if($runQuerry == TRUE){
        header('location:' .SITEURL. 'clientSide/cart.php');
        exit();
    } 
  }
  else{
    echo '<script>alert("Item Quantity Cannot be Zero")</script>';;
  }

};

?>