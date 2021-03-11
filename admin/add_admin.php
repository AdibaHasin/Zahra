<?php include("partials/menu.php"); ?>
             <!---menu section ends--->

             <!--main content starts--->
             <div class="main-content">
             <div class="wrapper">


             <?php 
             if (isset($_SESSION['add'])){
                 echo $_SESSION['add'];
                 unset($_SESSION['add']);
             }
             
             ?>
                 <h1> Add Admin </h1>
                 <form action='' method='POST'>
                     <table class = 'tbl-30'>



                         <tr  >
                             <td> fullName: </td>
                            
                             <td> <input type = 'text' name='full_name' placeholder="Enter your Name"> </td>
                            
                        </tr>
                       
                      
                             <tr>
                                 <td> Username: </td>
                                 <td> <input type = 'text' name='Username' placeholder="Enter username"> </td>

                            </tr>
                      
                            <tr >
                                <td> Password: </td>
                                <td> <input type = 'password' name='password' placeholder="Enter password"> </td>
                            </tr>       
                    
                            <tr>
                                <td colspan  = '2'> <!--merging two columns--> 
                                <input type = 'submit' name="submit" value = 'Add Admin' class  = 'btn-secondary'>
                            </td>
                            </tr>


</table>
</form>
</div>
</div>
<?php include("partials/footer.php");?>




<?php
//process value from form and save it in database

//check weather the submit button is clicked or not
if(isset($_POST['submit'])){
   //get data from form
  $full_name = $_POST['full_name'];
  $user_name = $_POST['Username'];
  $password = md5 ($_POST['password']);




  //sql query to save the data in data base
  $sql = "INSERT INTO tbl_admin SET
  fullname = '$full_name',
  username = '$user_name',
  password = '$password'
  
  ";
//Execute Query and save data in database

$res = mysqli_query($conn, $sql) or die(mysqli_error()); 

//weather the data is inserted or not and display message

if ($res == true){
    //data is inserted
   // echo 'data inserted successfully';
   //create a session variable to display message
   $_SESSION['add'] = 'Admin added successfully';
   //redirect page
   //echo $_SESSION['add'];
   header("location:" .SITEURL. "admin/manage_admin.php");
}
else{
    $_SESSION['add'] = 'Failed to add admin';
    //redirect page
    header('location:' .SITEURL.'admin/add_admin.php');
 }
}
?>


