<?php
//Process the above form
include("../login/auth.php");
require '../login/db.php';
//$loggedin = $_SESSION['id'];

$vid = $_POST['vid'];


$q="DELETE FROM post WHERE postId='$vid'";
$qres = mysqli_query($connection,$q) or die(mysqli_error($connection));
if ($qres) {
  echo "brilliant";
  # code...
} else {
  echo "dm";
}
?>
