<?php include("partials/menu.php"); ?>
             <!---menu section ends--->

             <!--main content starts--->
             <div class="main-content">
             <div class="wrapper">
                 <h1> Manage Item </h1>
                 <br/>
                 <br/>
                <a href = '<?php echo SITEURL;?>admin/add_item.php' class = 'btn-primary'> Add item </a>
                <br/><br/> <br>


                <?php 


                    if(isset($_SESSION['add'])){

                        echo ($_SESSION['add']);
                        unset($_SESSION['add']);
                    }
                   
                    
                    if(isset($_SESSION['upload'])){

                        echo ($_SESSION['upload']);
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['delete'])){

                        echo ($_SESSION['delete']);
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['unauthorise'])){

                        echo ($_SESSION['unauthorise']);
                        unset($_SESSION['unauthorise']);
                    }
                    if(isset($_SESSION['update'])){

                        echo ($_SESSION['update']);
                        unset($_SESSION['update']);
                    }
                
                if(isset($_SESSION['update-text'])){

                    echo ($_SESSION['update-text']);
                    unset($_SESSION['update-text']);
                }
                
                
                
                ?>

                <table class = 'tbl-full'>
                     <tr>
                         <th>S.n</th>
                         <th>Title</th>
                         <th>Price</th>
                         <th>Image</th>
                         <th>Active</th>
                         <th>Featured</th>
                         <th>Actions</th>
                 </tr>

                 <?php 

                 //Create a SQL query to get all the items

                 $sql = "SELECT * FROM tbl_item";

                 //Execute the QUERY
                 $res = mysqli_query($conn, $sql);

                 //Count rows to check whether we have items or not
                 $count = mysqli_num_rows($res);
                 $sn = 0;
                 if($count>0){


                    //we have items

                    //GET the items from database
                    while($row=mysqli_fetch_assoc($res)){

                        //GET the values for individual ITEMS
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];

                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>

                        <tr>
                            <td> <?php echo $sn++;?> </td>
                            <td> <?php echo $title; ?></td>
                            <td> <?php echo $price; ?></td>
                            <td> <?php 
                                        //Check whether we have image or NOT
                                        if($image_name==""){

                                            //WE do not have image,  Display error message
                                            echo "<div class= 'error'> Image not Added. </div>";
                                        }
                                        else{

                                            //We have image, Display image
                                            ?>
                                            <img src = "<?php echo SITEURL; ?>images/items/<?php echo $image_name?>" width=100px>
                                            <?php

                                        }
                                        ?>
                            
                            
                           
                            </td>
                            <td> <?php echo $featured; ?> </td>
                            <td><?php echo $active; ?></td>

                        <td>
                        
                        <a href = "<?php echo SITEURL; ?>admin/update_item.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class = 'btn-secondary'> Update Item </a>
                        <a href = "<?php echo SITEURL; ?>admin/delete_item.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class= 'btn-danger'> Delete Item </a>
                        
                        </td>
                        </tr>
                        <?php
                    }
                 }
                

                 else{

                    //WE do not have data
                    echo "<tr> <td colspan = '7' class ='error' > Items not added. </td> </tr>";
                 }
                 ?>
               
              

                </table>

               
             <!---main content ends-->
             </div>  

             <!---footer section starts-->
            <?php include("partials/footer.php");?>