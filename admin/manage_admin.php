<?php include("partials/menu.php"); ?>
             <!---menu section ends--->

             <!--main content starts--->
             <div class="main-content">
             <div class="wrapper">
                 <h1> Manage Admin </h1>
                 <br/>
                 <br/>


                 <?php 
                     if(isset($_SESSION['add'])){
                         echo $_SESSION['add'];
                         unset($_SESSION['add']); //removing message
                     }

                     if(isset($_SESSION['delete'])){
                         echo $_SESSION['delete'];
                         unset($_SESSION['delete']);

                     }

                     if(isset($_SESSION['update'])){
                         echo $_SESSION['update'];
                         unset($_SESSION['update']);
                     }

                     if(isset($_SESSION['change-pwd'])){
                         echo $_SESSION['change-pwd'];
                         unset($_SESSION['change-pwd']);
                     }

                     if(isset($_SESSION['user-not-found'])){
                         echo $_SESSION['user-not-found'];
                         unset($_SESSION['user-not-found']);
                     }
                 
                 
                 ?>

                 <br/><br/> <br/>
                <a href = 'add_admin.php' class = 'btn-primary'> Add admin </a>
                <br/><br/>
                <table class = 'tbl-full'>
                     <tr>
                         <th>S.n</th>
                         <th>fullName</th>
                         <th> Username</th>
                         <th> Actions </th>
                 </tr>
                 <?php 
                 //query to get all admin
                 $sql = "SELECT *FROM tbl_admin";
                 //execute the query
                 $res = mysqli_query($conn, $sql);
                 if ($res == TRUE ){
                     $count = mysqli_num_rows($res); //function to check all the rows in the database

                     if ($count>0){
                     $sn = 1;
                        //we have data in database 
                        while ($rows=mysqli_fetch_assoc($res)){

                         //get indiivdual data
                         $id = $rows['id'];
                         $full_name = $rows['fullname'];
                         $username = $rows['username'];      
                         ?>
                         
                         <tr>
                         <td><?php echo $sn++ ?></td>
                         
                         <td><?php echo $full_name; ?></td>
                         <td><?php echo $username; ?></td>
                         <td> 
                         <a href = "<?php echo SITEURL;?>admin/update-pass.php?id=<?php echo $id;?>" class = 'btn-secondary'> Change Password</a>
                         <a href = "<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id;?>" class = 'btn-secondary'> Update Admin</a>
                       
                         <a href = "<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class = 'btn-danger'> Delete Admin </a>

                          </td>
                 </tr>
                 <?php
                        }
                     }

                 }
                 

                
                 ?>
              

                </table>

               
             <!---main content ends-->
             </div>  

             <!---footer section starts-->
            <?php include("partials/footer.php");?>