<?php
require '../login/auth.php';
require '../login/db.php';

$id = $_SESSION['id'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Propose</title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">

<style media="screen">
  label {
    color: #f4511e;
  }
</style>
  </head>
  <body>
    <?php include 'nav.php' ?>
<br><br><br>

<div class="container">

  <form class="" action="submitproposal.php" method="post">
    <div class="form-group">
      <label for="propose">Write your proposal below</label>
      <textarea name="propose" class="form-control" id="propose" rows="16" cols="80" required></textarea>
    </div>
    <input type="submit" name="" class="btn btn-danger" value="SUBMIT">
  </form>
</div>

  </body>
</html>
