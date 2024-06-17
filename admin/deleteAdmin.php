<?php 

include('../config/config.php');

// get individual ID ====================>
$deleteAdminBtn = $_GET['id'];

$sql = "DELETE FROM admins WHERE id= $deleteAdminBtn";
$result = mysqli_query($conn, $sql);
if($result==TRUE){
    $_SESSION['deleteAdmin'] = '<span class="success">Admin deleted successfully!</span>';
    header('location:' .SITEURL. 'admin/admins.php');
}
else{
    $_SESSION['deleteAdmin'] = '<span class="fail">Failed to delete Item</span>';
    header('location:' .SITEURL. 'admin/admins.php');
}

?>