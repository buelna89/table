<?php 
include('../config/config.php');
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- link to css -->
    <link rel="stylesheet" href="./main.css">
        <!--  link to icons  -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    
<header class="header flex">
    <div class="logoDiv">
        <h2 class="logo" style="text-align: center; font-size: 18px">Dimas Administrator Page</h2>
    </div>
</header>

 <div class="loginBody">
 
    <div class="form_container">
    <?php 
            if(isset($_SESSION['noAdmin'])){
                echo $_SESSION['noAdmin'];
                unset($_SESSION['noAdmin']);
            }

            if(isset($_SESSION['notLoggedIn'])){
                echo $_SESSION['notLoggedIn'];
                unset ($_SESSION['notLoggedIn']);
            }
 
            if(isset($_SESSION['settings'])){
              echo $_SESSION['settings'];
              unset($_SESSION['settings']);
            }
           
        ?> 
        <div class="overlay">
            <!-- this will have not content -->
        </div>
    
        <div class="titleDiv">
            <h1 class="title">Login</h1>
            <span class="subTitle">Welcome back!</span>
        </div>
        
    
        
    
        <!-- formSection -->
        <form action="" method="POST">
    
            <div class="rows grid">
                <!-- User Name -->
                <div class="row">
                    <label for="username">First Name</label>
                    <input type="text" id="username" name="userName" placeholder="Enter First Name" required>
                </div>
                <!-- Password -->
                <div class="row">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <!-- Submit Button -->
                <div class="row">
                    <input type="submit" id="submitBtn" name="submit" value="Login" required>
    
                    <span class="registerLink">Don't have an account? Contact Admin!</span>
                </div>
            </div>
    
    
        </form>
    </div>
 </div>

<?php 
include('partials/footer.php');
?>

<?php 

if(isset($_POST['submit'])){

     $firstName = $_POST['userName'];
     $loginPassword = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE firstName='$firstName' AND password= '$loginPassword'";

    $res = mysqli_query($conn,$sql);
 
        $count = mysqli_num_rows($res);
        $row = mysqli_fetch_assoc($res);
        if($count==1 && $row['role']=='manager'){
            $_SESSION['loginMessage'] = '<span class="success">Welcome ' .$firstName. '!</span>';
            $_SESSION['firstName'] = $firstName;
            header('location:' .SITEURL. 'admin/dashboard.php');
            exit();
            
        }
        
        else if($count==1 && $row['role']=='admin'){
            $_SESSION['loginMessage'] = '<span class="success">Welcome ' .$firstName. '!</span>';
            $_SESSION['firstName'] = $firstName;
            header('location:' .SITEURL. 'admin/dashboardU.php');
            exit();
    
        }
        else{
            $_SESSION['noAdmin'] = '<span class="fail" style="color: red;"> Name or Password is incorrect!</span>';
            $_SESSION['firstName'] = $firstName;
            header('location:' .SITEURL. 'clientSide/loginPage.php');
            exit();
        }
    
}


?>