<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "tiger";
$dbname = "register";

error_reporting(E_ALL ^ E_DEPRECATED);
$connection = mysqli_connect('localhost', 'root', 'tiger');
if (!$connection){
    die("Database Connection Failed" . mysqli_error());
}
$select_db = mysqli_select_db($connection,'register');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

$username = stripslashes($username);
$username = mysqli_real_escape_string($connection,$username);
$password = stripslashes($password);
$password = mysqli_real_escape_string($connection,$password);
//Checking is user existing in the database or not
$query = "SELECT * FROM `users` WHERE (username='$username' or email = '$username' or phone = '$username') and password='".md5($password)."'";
$result = mysqli_query($connection,$query) or die(mysqli_error());
$fetcharray = mysqli_fetch_array($result);
$rows = mysqli_num_rows($result);
if($rows==1) {
$_SESSION['username'] = $username;
$_SESSION['id'] = $fetcharray['id'];
$_SESSION['fname'] = $fetcharray['firstName'];
$_SESSION['lname'] = $fetcharray['lastName'];
$_SESSION['nationality'] = $fetcharray['nationality'];
$_SESSION['priv'] = $fetcharray['priv'];
echo "Correct";
//header("Location: ../append.html"); // Redirect user to account.php
    } else {
      echo "Wrong credentials!";
}


 ?>
