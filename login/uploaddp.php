<?php
require 'db.php';
session_start();

if (isset($_FILES['file']['type'])) {
  $session=$_SESSION['username'];
  $idquery="SELECT id FROM users WHERE username='$session'";
  $idresult=mysqli_query($connection,$idquery) or die(mysqli_error());
  $idarray=mysqli_fetch_array($idresult);
  $idvalue=$_SESSION['id'];
  $displayPic = /*rand(10000,100000)."-".*/$_FILES['file']['name'];
  $location = $_FILES['file']['tmp_name'];
  $type = $_FILES['file']['type'];
  $size=$_FILES['file']['size'];
  $folder="../user/displaypic/";
  move_uploaded_file($location,$folder.$displayPic);
  $query="UPDATE displaypic SET displayPic='$displayPic',type='$type',size='$size' WHERE id = '$idvalue'";
  $res = mysqli_query($connection,$query) or die(mysqli_error($connection));

}
if (isset($_POST['load_pic'])) {
  $id=$_SESSION['id'];
  $q = "SELECT displayPic FROM displaypic WHERE id='$id'";
  $qres = mysqli_query($connection,$q);
  $row = mysqli_fetch_array($qres);
  $row['displayPic'];
  echo '<img class="img-circle" src="../user/displaypic/'.$row['displayPic'].'" alt="default image" width="200" height="200" />';

}
   ?>
