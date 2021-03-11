<?php include("partials/menu.php"); ?>
             <!---menu section ends--->

             <!--main content starts--->
             <div class="main-content">
             <div class="wrapper">
                 <h1> Update password </h1>
                 <br/> <br/>
                <?php


                    //get id 


                    if (isset($_GET['id'])){
                        $id = $_GET['id'];
                    }
                    ?>
                 <form action='' method='POST'>
                     <table class = 'tbl-30'>
                         <tr>
                             <td> Old Password: </td>
                             <td>
                                 <input type="password" name='old_password' placeholder='Old password'>
</td>
</tr>


<tr>
    <td> New password: </td>
    <td> <input type='password' name='new_password' placeholder='new password'>
</td>
</tr>


<tr>
    <td>Confirm Password: </td>
    <td>
        <input type  = 'password' name='confirm_password' placeholder = 'confirm password'>
</td>
</tr>

<tr>
    <td colspan ='2'>
        <input type = 'hidden' name = 'id' value = "<?php echo $id; ?>">
        <input type = 'submit' name='submit' value='change password' class='btn-secondary'>
</td>
</tr>

</table>

<?php

//Check whether the submit button is clicked or not

if(isset($_POST['submit'])){
    //1.get the data from form

    $id = $_POST['id'];
    $current_password = md5 ($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_pass = md5($_POST['confirm_password']);



    //2. check whether the id and pass is valid or not
    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'
    ";

    //execute the query
    $res = mysqli_query($conn, $sql);

    if($res == TRUE){
        

        //check whether the data is available or not
        $count = mysqli_num_rows($res);
        if($count == 1){
            //user exists and pass can be changed
            if($new_password == $confirm_pass){
                //1. update password
                //create query

                $sql2 = "UPDATE tbl_admin SET
                password = '$new_password'
                WHERE id=$id
                ";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whether the query executed or not
                if($res2==TRUE){
                    //display success message

                    $_SESSION['change-pwd'] = "<div class = 'success'> Password changed successfully .</div>";
                    //redirect the user
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }
                else{
                    //User is not found. set message and redirect
                    $_SESSION['user-not-found'] = "<div class = 'error'> User not found. </div>";
                    //redirect the user
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }
            }
       
            else{
                $_SESSION['change-pwd'] = "<div class = 'error'> Your password does not match .</div>";
                //redirect the user
                header('location:'.SITEURL.'admin/manage_admin.php');
            }

        }
    }

    //3. check whether the new pass and confirm pass match or not

    //4. change pass if all above is true
}