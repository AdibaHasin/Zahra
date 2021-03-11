<?php 


if (!isset($_SESSION['user'])){

//if user session is not set, redirect to login page

$_SESSION [ 'no-login-message'] = '<div class = "error text-center"> Login to access the Admin panel </div>';

//redirect to login page

header("location:".SITEURL.'admin/login.php');
}
?>