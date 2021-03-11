<?php include("partials/menu.php"); ?>

<div class="main-content">

    <div class="wrapper">
    
    <h1> Update Item </h1>

    <br><br>


<?php 

        //check whether the id is set or not
        if(isset($_GET['id'])){


        //Get all the details
        $id = $_GET['id']; 

        //SQL query to get the Selected item 
        $sql2 = "SELECT * FROM tbl_item WHERE id=$id";

        //Execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //get the value based on query executed in an array
        $row2 = mysqli_fetch_assoc($res2);

        //Get the values of Selected Items

        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active']; 
    }

    else{

        $_SESSION['update'] = "<div class = 'error'> did not get id. </div>";
        //Redirect to manage items
        header("location:".SITEURL.'admin/manage_item.php');
        die();
    }
    ?>

<form action = "" method = 'POST' enctype='multipart/form-data'>

    <table class = 'tbl-30'>
        <tr>
            <td> Title: </td>
            <td>
                <input type= 'text' name='title' value='<?php echo $title;?>'>
            </td>


        </tr>


        <tr>
            <td> Current Image: </td> <!--image name from form-->
            <td>

                <?php

                if($current_image==""){

                    //Display ERROR message
                    echo "<div class='error'> Image not added. </div>";
                }
                else{

                    //DISPLAy the current image
                    ?>
                    <img src = "<?php echo SITEURL;?>images/items/<?php echo $current_image; ?>" width='100px'>
                    <?php                  
                }
                ?>
            </td>
        </tr>

       
        <tr>


            <td>Category:</td>
                
                <td>
                    
                    <select name = "category">

                    <!--Displaying categories-->
                    <?php 

                    //Query to get active categories
                    $sql = "SELECT * FROM tbl_category Where active='Yes'";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);
                    //Count rows
                    $count  = mysqli_num_rows($res);

                    //Check whether the categories are available or Not
                    if($count>0){
                        //Category available
                        while($row=mysqli_fetch_assoc($res)){
                             $category_title= $row['title'];
                             $category_id = $row['id'];
                    ?>
                    <option <?php if($current_category==$category_id){echo 'selected';}?>value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                    <?php
                            }
                        }

                    else{
                        //Category not available
                        echo "<option value = '0'> Category not available. </option>";
                    }
                    ?>
                        <option value = "0"> Test Category </option>
                </select>
                </td>
            </tr>

        
        <tr>

            <td> New Image: </td>
            <td> 
                <input type = 'file' name='image'>
            </td>
        </tr>

        <tr>

                <td>Price: </td>
                <td><input type = 'number' name='price'></td>
                
        </tr>


        <tr>
            <td> Featured: </td>

            <td> 
            <input <?php if($featured=='Yes'){ echo 'checked';}?> type="radio" name='featured' value = 'Yes'> Yes
            <input  <?php if($featured=='No'){ echo 'checked';}?> type="radio" name='featured' value = 'No'> No
            </td>

        </tr>


        <tr>
            <td> Active: </td>
            <td> 
            <input <?php if($featured=='Yes'){ echo 'checked';}?> type="radio" name='active' value = 'Yes'> Yes
            <input <?php if($featured=='No'){ echo 'checked';}?> type="radio" name='active' value = 'No'> No
            </td>
        </tr>


        <tr>
                
            <td>
                <input type = 'hidden' name = 'id' value="<?php echo $id; ?>">
                <input type = 'hidden' name = 'current_image' value="<?php echo $current_image; ?>">

                <input type = 'submit' name = 'submit' value='update item' class = 'btn-secondary'>
        
            </td>
        </tr>


    </table>

    </form>
    
    
    <?php

        if(isset($_POST['submit'])){
            
            //1. Get all the details from the form
              $id = $_POST['id'];
              $title = $_POST['title'];
              $description = $_POST['description'];

              $price = $_POST['price'];
              $current_image = $_POST['current_image'];
              $category = $_POST['category'];

              $featured = $_POST['featured'];
              $active = $_POST['active'];


             //2. Upload the image if selected

             //Check whether 'select image'button is clicked or not
             if(isset($_FILES['image']['name'])){

                $image_name = $_FILES['image']['name']; //new image name

                //Check whether the file is available or not
                if($image_name!= ""){

                //Image is available
                //rename the image
                    $ext = end(explode('.', $image_name));

                    $image_name = "add_item_".rand(0000, 9999).'.'.$ext; //item_category_001.jpg

                    //get the source path and the destination path

                    $source_path = $_FILES['image']['tmp_name']; //source path

                    $destination_path = "../images/items/".$image_name; //destination path

                    //Upload the image
                    $upload  = move_uploaded_file($source_path, $destination_path);


                    //check whether the image is uploaded or not
                        if($upload == false){
                            //Fails to upload
                            $_SESSION['upload'] = "<div class = 'error'> Failed to Upload New Image. </div>";

                            //Redirect to manage item
                            header("location:".SITEURL.'admin/manage_item.php');

                            //STop the process
                            die(); 
                        }

                        //B. remove current image iif available
                        if($current_image!=""){

                            //current image is available

                            //Remove the image
                            $remove_path = "../images/items/".$current_image;
                            $remove = unlink($remove_path);


                            //Check whether image is deleted or not
                            if($remove==FALSE){

                                //error message and redirect to manage_item page
                                $_SESSION['remove-failed'] = "<div class = 'error'> Failed to remove Image. </div>";
                                header("location:".SITEURL.'admin/manage_item.php');

                                //Stop the process
                                die();
                            }
                    }
                }
             }
                                
                                
         else{
            
            $image_name=$current_image;
        }
                                            
                                            

    //4. Update item in database

    $sql3 = "UPDATE tbl_item SET
                    title = '$title',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                    ";

     //execute the SQL query
     $res3 = mysqli_query($conn, $sql3);


    //Check whether the query is executed or not
    if($res3==TRUE){

        //Query Executed and item uploaded
        $_SESSION['update-text'] = "<div class = 'success'> Item uploaded successfully. </div>";
        header("location:".SITEURL.'admin/manage_item.php');
    }
    else{

         //Failed uploading

        $_SESSION['update-text'] = "<div class = 'error'> Failed to upload the Item </div>";
        header("location:".SITEURL.'admin/manage_item.php');
    }

                                   

  }
                                    
     ?>



</div>

 </div>

<?php include('partials/footer.php')?>






