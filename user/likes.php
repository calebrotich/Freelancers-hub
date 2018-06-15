<?php
 //include auth.php file on all secure pages
require '../login/db.php';

$postid = $_POST['postid'];


if (isset($_POST['number_of_likes'])) {
  $querylk = "SELECT * FROM likes INNER JOIN users ON likes.liker = users.id WHERE likes.postId = '$postid'";
  $resqlk = mysqli_query($connection,$querylk) or die(mysqli_error($connection));
  $numlikes = mysqli_num_rows($resqlk);
  if ($numlikes == 1) {
    echo $numlikes." like";
  } else {
    echo $numlikes." likes";
  }

}

if (isset($_POST['number_of_comments'])) {
  $counterq = "SELECT COUNT(*) FROM postcomments WHERE postId = $postid";
  $counterresult = mysqli_query($connection,$counterq);
  $counterrowresult = mysqli_fetch_array($counterresult);
  if ($counterrowresult[0] == 1) {
    echo $counterrowresult[0]." Comment";
  } else {
    echo $counterrowresult[0]." Comments";
  }
}

 ?>
