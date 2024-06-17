<?php 
ob_start();
?>

<!-- Footer Section Starts  -->
   <section class="footer">
    <div class="sectionContainer container">
      <div class="sectionContent grid">
          <div class="footerCol">
           <div class="logoDiv">
            <h2 class="logo">Menu..</h2>
           </div>
           <span class="location">
            71 Pennington Lane Vernon Rockville, CT 06066 (Dammy Location)
         </span>
           <span class="phone flex">
            <i class='bx bxs-phone icon' ></i>
            +0000000000
         </span>
         <div class="socialDiv flex">
             <a href="#"><i class='bx bxl-facebook-circle icon'></i></a>
             <a href="#"><i class='bx bxl-instagram-alt icon' ></i></a>
             <a href="#"><i class='bx bxl-whatsapp icon' ></i></a>
             <a href="#"><i class='bx bxl-twitter icon' ></i></a>
         </div>
          </div>

          <div class="footerCol">
              <span class="footerTitle">
                  NEWSLETTER SIGN UP
              </span>
              <p class="description">
                 Subscribe to our newsletters now and stay up to date with exclusive offers.
              </p>
              <form action="" method="POST">
                  <input type="emial" name="newsletter" placeholder="Your Email Address.." class="emialInput" required>
                  <input type="submit" name="newsletterBtn" value="Subscribe" class="newsLetterBtn">
              </form>
          </div>
          <div class="footerCol">
             <span class="footerTitle">
                 QUICK LINKS
             </span>
             <div class="links">
                 <a href="#">Inquiries</a>
                 <a href="<?php echo SITEURL?>">Today's Menu</a>
                 <a href="<?php echo SITEURL?>clientSide/loginPage.php">Admininstrator</a>
                
             </div>

          </div>
        
      </div>
      <div class="copyright flex">
        &copy; Binas  <script> document.write(new Date().getFullYear())</script>  - All Rights Reserved.
    </div>
    </div>

    </section>
    <!-- Footer Section Ends  -->

    <!-- link to main.js -->
    <script src="./main.js"></script>
</body>
</html>



<?php 
if(isset($_POST['newsletterBtn'])){
  $emailAddress = $_POST['newsletter'];

  $sql = "INSERT INTO subscriptions SET
  emailAddress = '$emailAddress'
  ";

  $result = mysqli_query($conn, $sql);

  if($result == TRUE){
    $_SESSION['subscribed'] = '<span class="success">Subscribed to our Newsletter!</span>';
      // header('location:'.SITEURL. 'clientSide/index.php');
      exit();
  }
  else{
    
  die('Failed to connect to database!');
  } 

}

?>
