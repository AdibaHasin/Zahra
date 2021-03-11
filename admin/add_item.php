<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">

    <h1> Add Item </h1>

    <br><br>


    <?php

        if(isset($_SESSION['upload'])){

            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    
    
    
    
    ?>

    <form action = "" method = "POST" enctype = "multipart/form-data">

    <table class = "tbl-30">


        <tr>
            <td> Title:  </td>
            <td>
                <input type ='text' name="title" placeholder="title of the item">
            </td>
        </tr>


        <tr>
            <td>Description: </td>
            <td>
                <textarea name="description" id="" cols="30" rows="5" placeholder='Description of the item'></textarea>
            
            </td>
        </tr>

        <tr>
            <td>Price:</td>
            <td>
                <input type = "number" name="price">
            </td>
        </tr>

        <tr>
            <td>Select Image: </td>
            <td>
                <input type = "file" name= "image">
            </td>
        </tr>

        <tr>
            <td>Category: </td>
            <td>
                <select name='category'>

                    <!--DIsplaying category-->
                    <?php

                        //Create PHP code to display categories from database
                        //1. CReate SQL to get all active categories from database ('active' categories are shown on the page)
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        //EXecuting QUERY
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have categories or not
                        $count = mysqli_num_rows($res);

                        //IF count is greater than zero, we have categories else we don't have categories 
                        if($count>0){


                            //We have categories 
                            while($row=mysqli_fetch_assoc($res)){


                                //get the details of the categories
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value = "<?php echo $id;?>"> <?php echo $title;?> </option>
                                <?php

                            }
                        }

                        else{


                            //We do not have categories

                            ?>
                            <option value='0'> No category found </option>
                            <?php
                        }
                    
                            //2. Display category
                    
                    
                    ?>
               
            
            </select>
        
        </tr>

        <tr>
            <td>Featured:</td>
            <td>
                <input type="radio" name="featured" value="Yes"> Yes
                <input type="radio" name="featured" value="No"> No
            </td>
        
        </tr>

        <tr>
            <td>Active:</td>
            <td>
                <input type="radio" name="active" value="Yes"> Yes
                <input type="radio" name="active" value="No"> No
            </td>
        
        </tr>

        <tr>
            <td colspan="2">
                <input type = 'submit' name='submit' value='Add item' class='btn-secondary'>
            </td>
        </tr>
        </table>

        </form>
    <!--add category form ends-->


    <?php 
    //check whether the submit button is clicked or not 
    if(isset($_POST['submit'])){

        //1. get the value from form
          //1. Get the data from the form
          $title = $_POST['title'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $category = $_POST['category'];

        //for radio input, we need to check whether the button is clicked or not
        if(isset($_POST['featured'])){

            //get the value from form
            $featured  = $_POST['featured'];
        }
        else{
            
            //set the default values
            $featured='No';
        }

        if(isset($_POST['active'])){

            //get the value from form
            $active = $_POST['active'];
        }
        else{

            //set the default values
            $active = 'No';
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

                $image_name = "add_item_".rand(0000,9999).'.'.$ext; //item_category_001.jpg


                $source = $_FILES['image']['tmp_name'];
                $destination = "../images/items/".$image_name;

                //upload the image

                $upload = move_uploaded_file($source, $destination);

                //check whether the image is uploaded or not
                //and if it is uploaded then we will stop the process and redirect with error message

                if($upload == FALSE){
                    $_SESSION['upload'] = "<div class = 'error'> Failed to upload</div>";
                    //redirect to add category page
                    header("location:".SITEURL.'admin/add_item.php');
                    //Stop the process
                    die();
                }
            }
        }
        else{
            //don't upload the image and set image_name value as blank
            $image_name = ' ';
        }
        //2. create sql query to insert into categories
        $sql2 = "INSERT INTO tbl_item SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                   
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                    ";

        //3. Execute the query and save the data
        $res2=mysqli_query($conn, $sql2);

        //4. Check whether the data is added or not
        if($res2 == TRUE){


            //query executed and category added
            $_SESSION['upload'] = '<div class = "success"> Category Added Successfully </div>';

            //redirect to manage-category page
            header("location:".SITEURL.'admin/manage_item.php');
        }
        else{
            
            //failed to add category
            $_SESSION['upload'] = '<div class = "error"> Category could not be added </div>';

            //redirect to add category page
            header("location:".SITEURL.'admin/add_item.php');

        }
    }
    ?>

</div>
</div>



<?php include('partials/footer.php');?>