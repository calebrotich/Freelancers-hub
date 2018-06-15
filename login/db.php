
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$connection = mysqli_connect('localhost', 'root','');
if (!$connection){
    die("Database Connection Failed" . mysqli_error());
}
$select_db = mysqli_select_db($connection,'register');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error());
}
?>
