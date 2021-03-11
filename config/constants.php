<?php 
//start session

session_start();
//create constants to store non-repeating values


define ('SITEURL', "http://localhost/zahra/");
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'customer_order');

$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error()); //connecting to the database
$db_select = mysqli_select_db($conn, 'customer_order') or die(mysqli_error()); //selecting database

?>