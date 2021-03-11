<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1> Update Admin </h1>


        <?php
        //1. get the id of the selected admin
        $id = $_GET['id'];

        //2. create sql query
        $sql = "SELECT *FROM tbl_admin WHERE id = $id";

        //execute the query

        $res  = mysqli_query($conn, $sql);

        //check wether the query is executed or not
        if($res == TRUE){

            //check wether the data is available or not
            $count = mysqli_num_rows($res);
            //check wether we have admin data or not
            if($count == 1){
                //get the details
                //echo 'admin available'

                $row = mysqli_fetch_assoc($res);
                $full_name = $row['fullname'];
                $username = $row['username'];
            }
            else{
               
                //redirect to admin page
               header("location:".SITEURL.'admin/manage_admin.php');
            }
        }
        ?>
        <form action='' method='POST'>
            <table class = 'tbl-30'>
                <tr>
                    <td> Full Name : </td>
                    <td> <input type = 'text' name='full_name' value='<?php echo $full_name; ?>'> </td>
</tr>
<tr>
    <td> Username: </td>
    <td> <input type = 'text' name="Username" value = '<?php echo $username; ?>'> </td>

</tr>

<tr> <td colspan ='2'>
    <input type ='hidden' name='id' value = "<?php echo $id; ?>">
    <input type = 'submit' name="submit" value='update admin' class='btn-secondary'> </td>
</tr>
    </table>
    </form>
    </div>
    </div>


<?php
//check wether the submit button is clicked or not 

if(isset($_POST['submit'])){
    //Get all the values from form to update
    $id  = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['Username'];

    //create sql query to update

    $sql = "UPDATE tbl_admin SET
    fullname = '$full_name',
    username = '$username'
    WHERE id  ='$id'
    ";

    //Execute the query
    $res  = mysqli_query($conn, $sql);

    //check wether the query is executed or not
    if ($res == TRUE){
        //Query executed and Admin updated
        $_SESSION['update'] = "<div class = 'success'> Admin UPdated successfully.</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage_admin.php');
    }
    else{
        $_SESSION['update'] = "<div class = 'failed'> Admin Update failed.</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage_admin.php');

    }

}
?>



<?php include("partials/footer.php");?>


