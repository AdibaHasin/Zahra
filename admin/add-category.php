<?php include("partials/menu.php");?>

<div class="main-content">

<div class="wrapper">
    <h1> Add category </h1>

    <br><br>

    <?php

    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    ?>

    <!-- add category form starts-->
    <form action=' ' method = 'POST' enctype = 'multipart/form-data'> 
        <table class = "tbl-30">
        <tr class = 'tbl-row'>
            <td>Title: </td> 
            <td>
                <input type = 'text' name='title' placeholder = 'Category title'> 
</td> 
</tr> 


<tr>
    <td> Select Image: </td>
    <td> <input type = 'file' name = 'image'></td>
</tr>

<tr class = 'tbl-row'>
    <td> Featured: </td>
    <td> <input type = 'radio' name = 'featured' value = 'yes'> Yes
         <input type = 'radio' name = 'featured' value = 'no'> No
</td>
</tr> 

<tr>
    <td> Active: </td>
    <td> <input type = 'radio' name = 'active' value = 'yes'> Yes
         <input type = 'radio' name = 'active' value = 'no'> No
    </td>
</tr>


<tr> 
    <td colspan= '2'>
        <input type = 'submit' name = 'submit' value=' Add category' class = 'btn-secondary'>
</td>
</tr>
</table>
</form>
    <!--add category form ends-->


    <?php 
    //check whether the submit button is clicked or not 
    if(isset($_POST['submit'])){

        //1. get the value from form
        $title = $_POST['title'];

        //for radio input, we need to check whether the button is clicked or not
        if(isset($_POST['featured'])){

            //get the value from form
            $featured  = $_POST['featured'];
        }
        else{
            
            //set the default values
            $featured='NO';
        }

        if(isset($_POST['active'])){

            //get the value from form
            $active = $_POST['active'];
        }
        else{

            //set the default values
            $active = 'NO';
        }

        //check whether the image is selected or not and set the value for image name accordingly
        if(isset($_FILES['image']['name'])){


            //upload the image
            //to upload we need imagename, source path and destination path
            $image_name = $_FILES['image']['name'];
            

            //upload the image only if image is selected
            if($image_name!="")
            {
                //auto rename image
                //get the extension of our img e.g. .jpg, .png
                $ext = end(explode('.', $image_name));
                

                //rename the image

                $image_name = "item_category_".rand(0000, 9999).'.'.$ext; //item_category_001.jpg


                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/".$image_name;

                //upload the image

                $upload=move_uploaded_file($source_path, $destination_path);

                //check whether the image is uploaded or not
                //and if it is uploaded then we will stop the process and redirect with error message

                if($upload == false){
                    $_SESSION['upload'] = "<div class = 'error'> Failed to upload</div>";
                    //redirect to add category page
                    header("location:".SITEURL.'admin/add-category.php');
                    //Stop the process
                    die();
                }
            }
        }
        else{
            //don't upload the image and set image_name value as blank
            $image_name = '';
        }
        //2. create sql query to insert into categories
        $sql = "INSERT INTO tbl_category SET
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
        ";

        //3. Execute the query and save the data
        $res=mysqli_query($conn, $sql);

        //4. Check whether the data is added or not
        if($res == TRUE){


            //query executed and category added
            $_SESSION['add'] = '<div class = "success"> Category Added Successfully </div>';

            //redirect to manage-category page
            header("location:".SITEURL.'admin/manage_category.php');
        }
        else{
            
            //failed to add category
            $_SESSION['add'] = '<div class = "success"> Category could not be added </div>';

            //redirect to add category page
            header("location:".SITEURL.'admin/add-category.php');

        }
    }
    ?>

</div>
</div>



<?php include('partials/footer.php');?>