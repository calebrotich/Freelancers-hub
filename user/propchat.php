<?php
include '../login/auth.php';
require '../login/db.php';

$reply = $_POST['reply'];
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$propId = $_POST['propid'];

$q = "INSERT INTO propchat(message,sender,receiver,propId) VALUES('$reply','$sender','$receiver','$propId')";
$qres = mysqli_query($connection,$q) or die(mysqli_error($connection));


$chatq = "SELECT * FROM propchat WHERE propId = '$propId'";
$chatr = mysqli_query($connection,$chatq);
$chatrw = mysqli_num_rows($chatr);

while ($chata = mysqli_fetch_array($chatr)) {
  if ($chatrw == 0) {
    echo "<div class='jumbotron'>Type below to begin Interviewing </div>";
  } else {
    $send = $chata['sender'];
    echo "<div class='row'>";
    echo "<div class='c$sender well col-sm-12'>";
    echo $chata['message']."<br>";
    $time_ago = $chata['time'];
    echo "<span style='font-size:12px'>";
    include 'timer.php';
    echo "</span>";
    echo "</div>";
    echo "</div>";
      }

}

 ?>
