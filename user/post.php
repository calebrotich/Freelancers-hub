<?php
include '../login/auth.php';
require '../login/db.php';

$posttext = $_POST['postText'];
$topic = $_POST['topic'];
$sender=$_SESSION['id'];


$query="INSERT INTO post (post,topic,id) VALUES ('$posttext','$topic','$sender')";
$result=mysqli_query($connection,$query) or die(mysqli_error());
mysqli_close($connection);
 ?>
