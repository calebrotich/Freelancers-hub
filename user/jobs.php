<?php
include '../login/auth.php';
require '../login/db.php';
$session=$_SESSION['username'];
$nation = $_SESSION['nationality'];

$type=$_POST['type'];
$jobName=$_POST['jobName'];
$qualification = $_POST['qualification'];
$description = $_POST['description'];
$duration = $_POST['duration'];
$reqskills = $_POST['reqskills'];
$budget = $_POST['budget'];
$needed = $_POST['needed'];

$creator=mysqli_query($connection,"SELECT * FROM users WHERE username = '$session'") or die(mysqli_error());
$array=mysqli_fetch_array($creator);
$theId=$array['id'];
$query="INSERT into jobs(type,jobName,qualification,id,description,duration,budget,reqskills,needed)
 VALUES ('$type','$jobName','$qualification','$theId','$description','$duration','$budget','$reqskills','$needed')";
$success=mysqli_query($connection,$query) or die(mysqli_error($connection));
if ($success) {
  header("location:jobsuccess.php");
}
 ?>
