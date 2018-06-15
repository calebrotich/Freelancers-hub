<?php
include("../login/auth.php"); //include auth.php file on all secure pages
require '../login/db.php';
$session=$_SESSION['username'];
$id = $_SESSION['id'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Post Job</title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">



  </head>
  <body>
    <?php include 'nav.php'; ?>
    <div class="container">
      <div class="form_div">
        <form class="" action="jobs.php" method="post">
          <div class="form-group">
            <label for="job">Job title</label>
            <input type="text" id="job" class="form-control" name="jobName" value="" required="">
          </div>
          <br>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" rows="4" cols="40" placeholder="Give a description of the job. Highlight what the job entails." required=""></textarea>
          </div>
        <br>
        <div class="form-group">
          <label for="jobtype">Type Of Job</label>
          <select class="form-control" name="type" id="jobtype" required="">
            <option>Full time</option>
            <option>Part time</option>
            <option>Contract</option>
            <option>Freelancer</option>
            <option>Intern</option>
          </select>
        </div>
        <br>
        <div class="form-group">
          <label for="qualification">Least Qualification</label>
          <select class="form-control" name="qualification" id="qualification" required="">
            <option>Open</option>
            <option>Under-graduate</option>
            <option>Degree</option>
            <option>Masters</option>
            <option>PHD</option>
          </select>
        </div>
        <div class="form-group">
          <label for="req">Enter required Skills</label>
          <textarea name="reqskills" id="req" rows="3" cols="40" class="form-control" placeholder="You can list several skills by separating each skill with a comma. N/B: Do not space" required=""></textarea>
        </div>
        <div class="form-group">
          <label for="duration">Job duration (in days)</label>
          <input type="number" class="form-control" name="duration" value="" required="">
        </div>
        <div class="form-group">
          <label for="budget">Budget</label>
          <input type="number" class="form-control" name="budget" id="budget" value="">
        </div>
        <div class="form-group">
          <label for="budget">How many people do you need</label>
          <input type="number" class="form-control" name="needed" id="needed" value="">
        </div>


                <input type="submit" name="name" value="SUBMIT" class="btn btn-default" required="">

              </form>
      </div>
    </div>
  </body>
</html>
