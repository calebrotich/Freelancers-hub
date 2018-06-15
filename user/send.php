<?php
include '../login/auth.php';
require '../login/db.php';
  $_SESSION['jobid'] = $_POST['jobid'];
  $_SESSION['sender'] = $_POST['sender'];
if ($_SESSION['sender'] == $_SESSION['id']) {
  header('location:availablejobs.php?page=1&search=');
  exit();
} else {
  header('location:propose.php');
}

 ?>
