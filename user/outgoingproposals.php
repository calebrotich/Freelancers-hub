<?php
require '../login/db.php';
include '../login/auth.php';
$id = $_SESSION['id'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Eagle Lens | Outgoing Proposals</title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
<style media="screen">
  .badge {
    background-color: #f4511e;
  }
</style>
  </head>
  <body>
<?php include 'nav.php' ?>
<br><br><br>
<div class="container">
  <?php
  $oq = "SELECT * FROM proposal INNER JOIN jobs ON proposal.jobId = jobs.jobId WHERE proposal.id = $id";
  $oqres = mysqli_query($connection,$oq) or die(mysqli_error($connection));
  $oqrow = mysqli_num_rows($oqres);
  if ($oqrow != 0) {
    while ($oqa = mysqli_fetch_array($oqres)) {
      $uq = "SELECT * FROM users WHERE id=$oqa[10]";
      $uqres = mysqli_query($connection,$uq);
      $uqarray = mysqli_fetch_array($uqres) or die(mysqli_error($connection));
      echo "
      Proposal to:<b>". $uqarray['firstName'].' '.$uqarray['lastName']."</b> for job titled <b>".$oqa['jobName']."</b>
      <div class='well'>
      <pre><code>
      "
      .$oqa['proposal'].
      "
      </code></pre>
      <br>
      <form class='' action='outgoingproposals.php' method='post'>
        <input type='text' name='propId' value='".$oqa['propId']."' hidden='hidden'>
        <input type='submit' class='btn' name='' value='Delete'>
      </form>
      </div>";
    }
  } else {
    ?>
    <div class="container jumbotron text-center">
      <p>
        <h3>
          No proposal made currently. View <a href="availablejobs.php?page=1&search=">available jobs.</a>
        </h3>
      </p>
    </div>
    <?php
  }

   ?>
</div>
<?php
if (isset($_POST['propId'])) {
  $propId = $_POST['propId'];
  $q = "DELETE FROM proposal WHERE propId = $propId";
  $r = mysqli_query($connection, $q);
  if ($r) {
    echo "<script>window.location.replace('outgoingproposals.php')</script>";
  }
}
 ?>

  </body>
</html>
