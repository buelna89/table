<?php 
include('../config/config.php');
session_regenerate_id(); //remove all sessions and more importantly  $_SESSION['username'] for authentication purposes!
header('location:' .SITEURL. 'index.php')
?>