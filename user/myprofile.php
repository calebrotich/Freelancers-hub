<?php
include '../login/auth.php';
require '../login/db.php';
$id = $_SESSION['id'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php include '../bootstrap.php'; ?>

    <link rel="stylesheet" href="../css/navbar.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="user.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
<?php
 include 'nav.php';
 include 'dpic.php';
  ?>
<br><br><br>
  <div class="col-sm-6">
    <p>Active Incoming Interviews</p>

    <?php
    $ccq = "SELECT * FROM proposal WHERE id = $id";
    $ccres = mysqli_query($connection, $ccq) or die(mysqli_error($connection));
    while ($ccrow = mysqli_fetch_array($ccres)) {
      $ans = $ccrow['propId'];
      $rcq = "SELECT * FROM propchat WHERE propId = $ans";
      $rcr = mysqli_query($connection,$rcq);
      $rca = mysqli_fetch_array($rcr);
      $rcrw = mysqli_num_rows($rcr);

      if ($rca['sender'] == $id) {
        $jobsender = $rca['receiver'];
      } else {
        $jobsender = $rca['sender'];
      }


        $jsq = "SELECT * FROM users WHERE id = '$jobsender'";
        $jsr = mysqli_query($connection,$jsq) or die(mysqli_error($connection));
        $jsrw = mysqli_num_rows($jsr);
        while ($jsa = mysqli_fetch_array($jsr)) {
        $fullName = $jsa['firstName']." ".$jsa['lastName'];
        ?>
        <form class="" action="ses.php" method="post">
          <input type="text" name="pid" value="<?php echo $ans ?>" hidden="hidden">
          <input type="text" name="ses" value="<?php echo $jobsender ?>" hidden="hidden">
          <input type="submit" class="form-control btn" name="" value="<?php echo $fullName ?>">
        </form>
        <?php
        }




        echo "<br>";

     }// End while loop
     ?>

     <p>Active Outgoing Interviews</p>
     <?php
     $outq = "SELECT * FROM jobs WHERE id = $id";
     $outr = mysqli_query($connection,$outq);
     while ($outa = mysqli_fetch_array($outr)) {
       $cw3 = $outa['jobId'];
      $innq = "SELECT * FROM proposal WHERE jobId= '$cw3'";
      $innr = mysqli_query($connection,$innq);
      while ($inna = mysqli_fetch_array($innr)) {
        $ww1 = $inna['propId'];
        $fnlq = "SELECT * FROM propchat WHERE propId = '$ww1'";
        $fnlr = mysqli_query($connection,$fnlq);
        $fnla = mysqli_fetch_array($fnlr);
          if ($fnla['sender'] == $id) {
            $jobsender2 = $fnla['receiver'];
          } else {
            $jobsender2 = $fnla['sender'];
          }

          $jsq2 = "SELECT * FROM users WHERE id = '$jobsender2'";
          $jsr2 = mysqli_query($connection,$jsq2) or die(mysqli_error($connection));
          $jsrw2 = mysqli_num_rows($jsr2);

          while ($jsa2 = mysqli_fetch_array($jsr2)) {
            $fullName2 = $jsa2['firstName']." ".$jsa2['lastName'];
            ?>
            <form class="" action="ses.php" method="post">
              <input type="text" name="pid" value="<?php echo $ww1 ?>" hidden="hidden">
              <input type="text" name="ses" value="<?php echo $jobsender2 ?>" hidden="hidden">
              <input type="submit" class="form-control btn" name="" value="<?php echo $fullName2 ?>">
            </form>
            <?php
          }


        echo "<br>";
      }

     }
      ?>
  </div>

<!--profile-->
<div class="text-center col-sm-6" id="sidenav">
  <div class="well">
    <p class="title">
      PROFILE
    </p>
<?php
echo $_SESSION['fname']." ".$_SESSION['lname'];
?>
<div class="" style="position:relative">
<img title="profile" src='displayPic/<?php echo $pic ?>'  alt='profile photo' height='100' width='130' data-toggle="modal" data-target="#prof" style="cursor: pointer" />
<span id="cam" class="glyphicon glyphicon-camera" data-toggle="modal" data-target="#prof"></span>
</div>

<div class="modal fade" id="prof">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <span>
      Edit Profile Picture
    </span>
    <span class="close" data-dismiss="modal">x</span>
  </div>
  <div class="modal-body">
    <form class="" action="changedp.php" method="post" enctype="multipart/form-data">
      <label for="fileup">
        <img src="displayPic/<?php echo $pic ?>" alt="" width="200" height="200" />

      </label>
      <input type="file" id="fileup" name="file" value="" required="">
      <input type="submit" name="name" value="CHANGE">
      <script type="text/javascript">

      </script>
    </form>
  </div>
  <div class="modal-footer">

  </div>
</div>
</div>
</div>
<div class="well">
<?php
$qs = "SELECT * FROM skills WHERE id = '$id'";
$res = mysqli_query($connection,$qs) or die(mysqli_error());
$row = mysqli_num_rows($res);
$array = mysqli_fetch_array($res);
?>
<p class="title">
Description
</p>
<?php
if ($row == 0) {
echo "No description yet <br>
<a href='../login/addphoto.php'>Edit</a>
";
} else {
echo $array['description'];
echo "<br><a href='../login/addphoto.php'>Edit</a>";

}

?>
</div>
<div class="well">
<p class="title">
Skills
</p>
<?php
if ($row == 0) {
echo "No Listed Skills <br>
<a href='../login/addphoto.php'>Edit</a>
";

} else {
$ss = $array['skills'];
$ssin = explode(",",$ss);
for ($i=0; $i < count($ssin) ; $i++) {
  echo $ssin[$i]."<br>";
}

echo "<br><a href='../login/addphoto.php'>Edit</a>";
}
?>
</div>

    <div class="well">
      <p class="title">
        INTERESTS
<div class="label label-danger">
Programming
</div></br>
<div class="label label-success">
Web
</div></br>
<div class="label label-default">
Android
</div>
      </p>
    </div>
  </div>
</div>

<!--myprofile-->

  </body>
</html>
