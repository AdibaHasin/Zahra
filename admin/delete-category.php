<?php

//include constants file
include('../config/constants.php');


//check whether image_name and id is set or not
if(isset($_GET['id']) and isset($_GET['image_name'])){

    //get the value and Delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image file
    if($image_name!=''){


        //image is available so remove it
        $path = "../images/category/".$image_name;
        //remove the image
        $remove = unlink($path);

        //IF failed to remove the physical image 
        if($remove==FALSE){


            //show error message
            $_SESSION['remove'] = "<div class = 'error'> Failed to remove the image.</div>";
            //redirect to manage category page
            header("location:".SITEURL.'admin/delete-category.php');
            //end the process
            die();
        }
    }

    //delete data from database

    //Select data from database
    $sql = "DELETE FROM tbl_category WHERE id =$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //check whether the query is executed or not 
    if($res==TRUE){

        //show success message
        $_SESSION['success'] = "<div class = 'success text-center'> Category Deleted Successfully. </div>";

        //redirect to manage  category page
        header("location:".SITEURL.'admin/manage_category.php');
    }

    else{


        //show error message

                //show failed message
                $_SESSION['delete'] = "<div class = 'error text-center'> Failed to delete category. </div>";

                //redirect to manage  category page
                header("location:".SITEURL.'admin/manage_category.php');

    }

}


else{

    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage_category.php');
}

?>
