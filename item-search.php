<?php include("partials-front/menu.php");?>

<!--Item Search section start here-->


<section class="container">
    <?php

    $search = $_POST['search'];

    //SQL query to get item based on search keyword
    $sql = "SELECT * FROM tbl_item WHERE title LIKE '%$search%' OR description LIKE '%$search% '";

    //Execute the Query 
    $res = mysqli_query($conn, $sql);

    //Count rows
    $count = mysqli_num_rows($res);

    //check whether item available or not
    if($count>0){

        //Item available
        while($row=mysqli_fetch_assoc($res)){

            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $image_name = $row['image_name'];
            ?>
                    
          <div class="item">
          <div class="item-image">

          <?php
          
          //Check whether Image available or not 
          if($image_name==""){

            //Image not available
            echo "<div class = 'error'> Image not available. </div>";
          }
          else{

            //Image available
            ?>
            <img src ="<?php echo SITEURL;?>images/items/<?php echo $image_name;?>" alt = "item-name" class = "img-responsive card-img-top img-curve">
            <?php
            
            
            ?>
          
            
          </div>

                <div class="item-description">
                <h1 class = 'card-title'> <?php echo $title;?> </h1>
                <p> <?php echo $description;?> </p>
                <p class='cost'> <?php echo $price;?> </p>
                <button class = "btn btn-primary shop-item-button" type="button">Add to cart</button>
                </div>


                </div>
            <?php
        }
    }
}
    else{

        //Item not available
        echo "<div class='error'> Item not found. </div>";
    }


    
    
    ?>
 


    

<div class="clearfix"></div>



<div class="social-box">
    <h3><b> Follow us on instagram</b></h3> 
</div>
<div class="instalogo">
    <img src="images/insta.png"  alt="instagram" style="width: 100%; height: 100%;">
</div>


<div class="contact">
<div class="row">
 <div class="col-md-4" class="about-us"><h3>About-us </h3> </div>
 <div class="col-md-4"> <h3>Contact-us</h3> </div>
 <div class="col-md-4"><h3>lore</h3></div>
</div>
</div>
<div class="row">
    <div class="col-md-4"><h3> <b>ITEM</b></h3></div>
    <div class="col-md-4"><h3><b>PRICE</b></h3></div>
    <div class="col-md-4"><h3><b>QUANTITY</b></h3></div>
</div>


<div class="cart-row">

    


</div>


<div class="row total-row">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <strong class="total-button">Total </strong>
        <span class="total-price">$0</span> 
    </div>
    <button class = "order-btn" type="button"><a href="confirmOrder.html"> Order now</a></button>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="store.js" async  >  </script> 
</body>
</html>