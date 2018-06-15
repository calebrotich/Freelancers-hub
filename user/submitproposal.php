<?php
include '../login/auth.php';
require '../login/db.php';

$proposal = $_POST['propose'];
$id = $_SESSION['id'];
$jobId = $_SESSION['jobid'];

$query = "INSERT INTO proposal(proposal,id,jobId) VALUES('$proposal','$id','$jobId')";
$res = mysqli_query($connection,$query) or die(mysqli_error($connection));
if ($res) {
  
  header('location:availablejobs.php?page=1&search=');
}
 ?>
