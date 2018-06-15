<?php
include("../login/auth.php"); //include auth.php file on all secure pages
require '../login/db.php';
$id = $_SESSION['id'];
$postid = $_POST['postid'];

$querylk = "SELECT * FROM likes INNER JOIN users ON likes.liker = users.id WHERE likes.postId = '$postid'";
$resqlk = mysqli_query($connection,$querylk) or die(mysqli_error($connection));

while ($likers = mysqli_fetch_array($resqlk)) {
  echo
  $likers['firstName']." ".$likers['lastName']."
  </br>
  ";

}


 ?>
