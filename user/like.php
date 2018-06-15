<?php
//Process the above form
include("../login/auth.php");
require '../login/db.php';
$loggedin = $_SESSION['id'];

$postId = $_POST['postidcarrier'];

$queryunlk = "SELECT * FROM likes WHERE postId = '$postId' AND liker = '$loggedin'";
$resqunlk = mysqli_query($connection,$queryunlk) or die(mysqli_error($connection));
$arrayunlk = mysqli_fetch_array($resqunlk);
$numunlike = mysqli_num_rows($resqunlk);
if ($numunlike == 0) {
  $query = "INSERT INTO likes(postId,liker) VALUES('$postId','$loggedin')";
  echo " <span class='glyphicon glyphicon-thumbs-down'></span> Unlike";

} else {

  $query = "DELETE FROM likes WHERE postId = '$postId' AND liker = '$loggedin'";
  echo " <span class='glyphicon glyphicon-thumbs-up'></span> Like";

}


$res = mysqli_query($connection,$query) or die(mysqli_error($connection));

?>
