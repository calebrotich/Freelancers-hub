<?php
include '../login/auth.php';
include '../login/db.php';

$_SESSION['profuser'] = $_POST['ses'];
$_SESSION['pid'] = $_POST['pid'];
header('location: profile.php');
 ?>
