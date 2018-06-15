<?php
include("../login/auth.php");
require '../login/db.php';
$loggedin = $_SESSION['id'];

$postId = $_POST['postidcarrier'];
$current = $_POST['current'];
$newlike = $current - 1;


$query = "DELETE FROM likes WHERE postId = '$postId' AND liker = '$loggedin'";
$res = mysqli_query($connection,$query) or die(mysqli_error($connection));
$q="UPDATE post SET likes = '$newlike' WHERE postId = '$postId'";
$qres = mysqli_query($connection,$q) or die(mysqli_error($connection));
if ($res) {
  echo "deleted";
  # code...
} else {
  echo "dm";
}
?>
