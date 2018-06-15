<?php
session_start();
require 'db.php';

$description = $_POST['desc'];
$skills = $_POST['skills'];
$interests = $_POST['interests'];
$id = $_SESSION['id'];
$q = "SELECT * FROM skills WHERE id = '$id'";
$res = mysqli_query($connection,$q);
$num = mysqli_num_rows($res);
if ($num == 0) {
  $query = "INSERT INTO skills(description,skills,interests,id) VALUES('$description','$skills','$interests','$id')";

} else {
  $query ="UPDATE skills SET description = '$description', skills = '$skills', interests = '$interests' WHERE id = '$id'";
}

$result = mysqli_query($connection,$query) or die(mysqli_error($connection));
if ($result) {
  header('location:../user/account.php?page=10&topic=technology');
}
 ?>
