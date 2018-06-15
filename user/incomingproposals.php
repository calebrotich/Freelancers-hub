<?php
include '../login/auth.php';
require '../login/db.php';
$id = $_SESSION['id'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Eagle Lens | inncoming Proposals</title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
    <style media="screen">
      .badge {
        background-color: #f4511e;
      }
      .content {
        width: 80%;
      }
    </style>
  </head>
  <body>

<?php
include 'nav.php';
  ?>
  <br><br><br>
  <div class="container content">
    <?php
  $incquery = "SELECT * FROM proposal INNER JOIN jobs ON proposal.jobId = jobs.jobId WHERE jobs.id = $id";
  $incresult = mysqli_query($connection,$incquery) or die(mysqli_error($connection));
  $incrow = mysqli_num_rows($incresult);
if ($incrow !=0) {
  while ($incarray = mysqli_fetch_array($incresult)) {

      $uq = "SELECT * FROM users WHERE id=$incarray[2]";
      $uqres = mysqli_query($connection,$uq);
      $uqarray = mysqli_fetch_array($uqres) or die(mysqli_error($connection));

      echo "<strong>".$uqarray['firstName']." ".$uqarray['lastName']."</strong>";
      ?>
      <div class="well">
        <?php echo $incarray['proposal'] ?>
        <form class="" action="ses.php" method="post">
          <input type="text" name="ses" value="<?php echo $incarray[2] ?>" hidden="hidden">
          <input type="text" name="pid" value="<?php echo $incarray['propId'] ?>" hidden="hidden">
          <br>
          <input type="submit" class="btn btn-danger btn-sm" name="" value="View Profile">
        </form>
      </div>
      <?php



  }
} else {
  ?>
  <div class="container jumbotron text-center">
    <p>
      <h3>
        No incoming bids yet. If you have a job which need to be done, just post it <a href="postjob.php">here.</a>
      </h3>
    </p>
  </div>
  <?php
}


     ?>

  </div>


  </body>
</html>
