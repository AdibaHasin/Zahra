<?php 
include('../config/constants.php');

//1. get the ID of Admin to be deleted
 $id = $_GET['id'];

//2. create SQL query to delete the admin
$sql = "DELETE FROM tbl_admin WHERE id =$id";

//execute query
$res = mysqli_query($conn, $sql);


//check weather the query executed successfully or not 

if ($res == TRUE){
    $_SESSION['delete'] = 'Admin deleted Successfully';
    header("location:".SITEURL.'admin/manage_admin.php');
}
else{
    $_SESSION['delete'] = 'Failed to Delete admin';
    header('location:'.SITEURL.'admin/manage_admin.php');
}
//3. redirect to admin page with message










?>

