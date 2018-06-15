<?php
//Process the above form
include("../login/auth.php");
require '../login/db.php';
$loggedin = $_SESSION['id'];




if (isset($_POST['addrep'])) {
  $postreplypro = $_POST['reply'];
  $postidagain = $_POST['idcarrier'];
  $q = "INSERT INTO postcomments(comment,postId,id) VALUES('$postreplypro','$postidagain','$loggedin')";
}
if (isset($_POST['deleterep'])) {
  $postidagain = $_POST['carrier'];
  $cid = $_POST['cid'];
  $q="DELETE FROM postcomments WHERE commentId='$cid'";
}



$qres = mysqli_query($connection,$q) or die(mysqli_error($connection));

  
 ?>
