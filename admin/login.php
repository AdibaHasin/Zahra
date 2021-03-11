<?php include('../config/constants.php');?>
<html> 
    <head>
        <title> Login - Order system </title>
        <link rel = 'stylesheet' href = "../admin/admin.css">

</head>
<body>
    <div class="login-section">
        <h1 class='text-center'> Login </h1>

        <br><br>

        <?php

        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>

        <br><br>
        
        <!--login form starts here-->
        <form action = "" method  = 'POST' class='text-center'>
        Username: <br>
        <input type = 'text' name='username' placeholder = 'Enter username'> <br> <br>
        Password: <br>
        <input type = 'password' name = 'password' placeholder= 'Enter password'> <br><br>

        <input type = 'submit' name = 'submit' value = 'Login' class ='btn-primary'> <br><br>
</form>
<!--login form ends-->

        <p class = 'text-center'> created by Zahra </p>
</div>
</body>
</html>

<?php

//check whether the login button is clicked or not
if(isset($_POST['submit'])){
    //process for login

    //1. Get data from login form

    $username =$_POST['username'];
    $password = md5($_POST['password']);

    //2. SQL to check whether the user exists or not

    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password' ";


    //3. Execute the query
    $res = mysqli_query($conn, $sql);

    //4. count rows to check whether user exists or not
    $count = mysqli_num_rows($res);

    if($count ==1){
        //User availale and login success
        $_SESSION['login'] = '<div class = "success"> Login Successful. </div>';

        $_SESSION['user'] = $username; //to Check whether the user is logged in or not
        //redirection to Home page/dashboard
        header("location:".SITEURL.'admin/');

    }
    else{
        //User not availale and login failed
        $_SESSION['login'] = '<div class = "error text-center"> Login failed </div>';
        
        //redirection to login page
        header("location:".SITEURL.'admin/login.php');

    }
}
?>