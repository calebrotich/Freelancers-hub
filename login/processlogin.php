
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
$query = "SELECT username,password,id FROM `users` WHERE username='$username' and password='".md5($password)."'";
$result = mysqli_query($connection,$query) or die(mysqli_error());
$idarray=mysqli_fetch_array($result);
$view=$idarray['id'];

$rows = mysqli_num_rows($result);
if($rows==1){
//$_SESSION['username'] = $username;
$_SESSION['user']= $view;
echo "Correct";
header("Location: ../user/account.php?page=10&topic=technology"); // Redirect user to account.php
    }else{

      echo "Wrong credentials!";
}


 ?>









<?php
/*	require('db.php');
	session_start();
    // If form submitted, insert values into the database.

    //if (isset($_POST['username'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
		$username = stripslashes($username);
		$username = mysqli_real_escape_string($connection,$username);
		$password = stripslashes($password);
		$password = mysqli_real_escape_string($connection,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
		$result = mysqli_query($connection,$query) or die(mysqli_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){

			$_SESSION['username'] = $username;
			echo "log";
			//header("Location: ../user/account.php"); // Redirect user to account.php
            }else{
              echo "Wrong credentials!";
				}
    //  }*/
?>
