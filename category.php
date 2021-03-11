<?php include("partials-front/menu.php");?>
<section class="categories">

<div class="container">
    <h2 class = "text-center"> Explore-category</h2>

    <?php

    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
    $res = mysqli_query($conn, $sql);
    $conn = mysqli_num_rows($res);
    if($conn>0){

        while($row = mysqli_fetch_assoc($res)){

            $id = $row['id'];
            $title = $row['title'];
            $image_name = $row['image_name'];
            ?>
            
            <a href = "<?php echo SITEURL; ?>jewellery.php?category_id=<?php echo $id;?>"> 

             <div class="box-3 float-container">

             <?php

             if($image_name==""){
                 echo "<div class = 'error'> Image not available.</div>";


             }
             else{


?>
            <img src ="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"alt="items" class = "img-responsive img-curve">
               <?php
        }
        ?>
        <h4 class = "float-text "> <?php echo $title;?> </h4>
        </div>

           
           
        <?php
        }
    }
    else{

        echo "<div class = 'error'> Category not added. </div>";
    }
    
    
    
    ?>
     <div class="clearfix"></div>
        </div>
     </section>
     <?php include("partials-front/footer.php");?>
