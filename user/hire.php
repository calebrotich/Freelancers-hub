<?php
require '../login/db.php';
include '../login/auth.php';
$pid = $_POST['pid'];
$status = $_POST['status'];
$q = "UPDATE proposal SET hired = $status WHERE propId = $pid";
$qr = mysqli_query($connection,$q) or die(mysqli_error($connection));
header('location:profile.php');
 ?>
