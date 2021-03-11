<?php include("partials-front/menu.php");?>




<section class="container">
 <div class="item-container">
 <?php

if(isset($_SESSION['upload'])){
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}

?>


   <?php
   if(isset($_GET['category_id'])){
     $category_id = $_GET['category_id'];

    //Create SQL query to get items based on selected category
    $sql = "SELECT * FROM tbl_item WHERE category_id = $category_id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //Count the rows
    $count = mysqli_num_rows($res);


    if($count>0){
       //Item available
     while($row = mysqli_fetch_assoc($res)){

      //Get all the values
      $id = $row['id'];
      $title = $row['title'];
      $price = $row['price'];
      $image_name = $row['image_name'];
      $description = $row['description'];
      ?>
          <div class="item">
          <div class="item-image img-responsive">

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
            
          }
            ?>
          
            
          </div>

          <div class="item-description">
            <h1  name = 'title' class = 'card-title' type = 'submit'> <?php echo $title;?> </h1>
            
            <p> <?php echo $description;?> </p>
            <h1 class='cost'name = 'price' type= 'submit'> <?php echo $price;?> </h1>
            
            <button class = "btn btn-primary shop-item-button" type="button" type = 'submit' name = 'Shop-item-button' ><?php?>Add to cart </button>
            
            <?php

           
          }
        }


          else{
            $_SESSION['upload'] = "<div class = 'error'> no item. </div>";

            header("location:".SITEURL.'jewellery.php');
          }
        }

        else{
          $_SESSION['upload'] = "<div class = 'error'> no id. </div>";

            header("location:".SITEURL.'jewellery.php');
        }



        
        
              

            
            ?>

           
          </div>

          
        </div>
        </div>





<div class="clearfix"></div>


</div>
</section>


    


<div class="container">

<div class="row total-row">
    <div class="col-md-4"><h3> <b>ITEM</b></h3></div>
    <div class="col-md-4"><h3><b>PRICE</b></h3></div>
    <div class="col-md-4"><h3><b>QUANTITY</b></h3></div>
</div>


<div class="cart-row">

    


</div>

<div class="cart-container">

<div class="row ">
  <div class="col-md-6 text-left"> 
  <a href = "confirmOrder.php" type = button> add now </a></div>
    
  
  <div class="col-md-6 text-center">  <strong class="total-button">Total </strong>
        <span class="total-price">$0</span> </div>
        
      
</div>
<!--
<div class="row total-row">
    
    <div class="col-md-4">
        <strong class="total-button">Total </strong>
        <span class="total-price">$0</span> 
        <div class="col-md-4">
        <a href = "confirmOrder.php" type = button> add now </a>
      </div>
    </div>
      -->
 
   

 
      </div>
      
 </div>
 
    
</div>

<?php include("partials-front/footer.php");?>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="store.js" async  >  </script> 
</body>
</html>



      
 