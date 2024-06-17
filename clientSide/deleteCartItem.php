<?php 

include('../config/config.php');

// get individual ID ====================>
$deleteBtnId = $_GET['id'];

$sql = "DELETE FROM cart WHERE id= $deleteBtnId";
$result = mysqli_query($conn, $sql);
if($result==TRUE){
    $_SESSION['deleteItem'] = '<span class="success">Food deleted successfully!</span>';
    header('location:' .SITEURL. 'clientSide/cart.php');
}
else{
    $_SESSION['deleteItem'] = '<span class="fail">Failed to delete Item</span>';
    header('location:' .SITEURL. 'clientSide/cart.php');
}

?>