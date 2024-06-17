<?php 

include('../config/config.php');

// get individual ID ====================>
$deleteSubBtn = $_GET['id'];

$sql = "DELETE FROM subscriptions WHERE id= $deleteSubBtn";
$result = mysqli_query($conn, $sql);
if($result==TRUE){
    $_SESSION['deletedSub'] = '<span class="success">Subscriber deleted successfully!</span>';
    header('location:' .SITEURL. 'admin/subscriptions.php');
}
else{
    $_SESSION['deletedSub'] = '<span class="fail">Failed to delete Item</span>';
    header('location:' .SITEURL. 'admin/subscriptions.php');
}

?>