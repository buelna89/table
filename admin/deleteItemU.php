<?php 

include('../config/config.php');

// get individual ID ====================>
$deleteBtnId = $_GET['id'];

$sql = "DELETE FROM food WHERE id= $deleteBtnId";
$result = mysqli_query($conn, $sql);
if($result==TRUE){
    $_SESSION['deleteItem'] = '<span class="success">Food deleted successfully!</span>';
    header('location:' .SITEURL. 'admin/menuU.php');
}
else{
    $_SESSION['deleteItem'] = '<span class="fail">Failed to delete Item</span>';
    header('location:' .SITEURL. 'admin/menuU.php');
}

?>