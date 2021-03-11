<?php 

include("../config/constants.php");

//Delete item page

if(isset($_GET['id'])and isset($_GET['image_name'])) //&& or and
{

//Process to Delete 


//1. Get Id and Image name
$id = $_GET['id'];
$image_name = $_GET['image_name'];


//2. Remove the image if available
//check whether the image is available or not and delete if available

if($image_name != ''){


    //it has image and need to be removed from the folder
    //Get the image path

    $path = "../images/items/".$image_name;

    //Remove the image from folder

    $remove = unlink($path);

    //check whether the image is removed or not
    if($remove==false){


        //Failed to remove image
        $_SESSION['upload']  = "<div class = 'error'> Failed to Remove image file. </div>"; 

        //Redirect to Manage item
        header("location:".SITEURL.'admin/manage_item.php');

        //STOP the process
        die();
    }
}


//3. Delete the food from database

$sql = "DELETE FROM tbl_item WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

//Check whether the query Executed or not and set the session the message respectively
if($res==true){

    //DELETE item
    $_SESSION['delete'] = "<div class = 'success'> ITem deleted successfully. </div>";
    header("location:".SITEURL.'admin/manage_item.php');
}


//4. Redirect to manage_item with Session message


}

else{

    //REdirect to Manage Item page
    $_SESSION['unauthorise'] = "<div class = 'error'> Unauthorised Access. </div>";
    header('location:'.SITEURL.'admin/manage_item.php');
}




?>